<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lot;
use App\Models\LotPurchase;
use App\Models\Offer;
use App\Models\Order;
use App\Models\User;
use EloquentBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class FreelanceController extends Controller
{
    public function index(Request $request) {
        $categories = Category::isRoot()->forFreelance()->withCount('freelancers')->get();

        $breadcrumbs = [
            [
                'link' => route('home'),
                'title' => 'Главная',
            ],
            [
                'link' => route('orders.index'),
                'title' => __('main.freelancers'),
            ],
        ];

        if($request->has('category')) {
            $category_ancestors = Category::forFreelance()->where('slug', $request->category)->first()->ancestorsAndSelf()->get()->reverse();
            $categories = Category::forFreelance()->where('slug', $request->category)->first()->descendants()->whereDepth(1)->withCount('orders')->get();

            foreach ($category_ancestors as $category) {
                $breadcrumbs[] = [
                    'link' => route('orders.index', $request->except(['category']) + ['category' => $category->slug]),
                    'title' => $category->name,
                ];
            }
        }

        $filters = EloquentBuilder::to(User::freelancers()->with('categories')->withCount([
            'reviews as positive_reviews_count' => function(Builder $query) {
                $query->positive();
            }, 'reviews as negative_reviews_count' => function(Builder $query) {
                $query->negative();
            }
        ]), $request->except(['q', 'page']));

        $search_results = Search::add($filters, ['first_name', 'last_name', 'username'])->paginate(12);

        $freelancers = $search_results->orderBy('rating')->orderByDesc()->search($request->filled('q') ? $request->q : '');

        return view('freelancers')->with([
            'freelancers' => $freelancers,
            'categories' => $categories,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function freelancer(User $user)
    {
        return view('freelance.freelancer', [
            'user' => $user->load('portfolios')->loadCount(['lots' => function($query) {
                $query->active();
            }, 'orders', 'reviews'])
        ]);
    }

    public function employer(Request $request, User $user)
    {
        return view('freelance.employer', [
            'user' => $user->load(['reviews', 'reviews' => function($query) use($request) {
                    if($request->reviews === 'positive') {
                        $query->positive();
                    } else if($request->reviews === 'negative') {
                        $query->negative();
                    }
                }])->loadCount(['lots' => function($query) {
                    $query->active();
                }, 'reviews' => function($query) use($request) {
                    if ($request->reviews === 'positive') {
                        $query->positive();
                    } else if ($request->reviews === 'negative') {
                        $query->negative();
                    }
                }, 'orders'])
        ]);
    }

    public function freelancerLots(User $user)
    {;
        return view('freelance.freelancer.lots', [
            'user' => $user->loadCount(['lots' => function($query) {
                $query->active();
            }, 'orders', 'reviews'])->load(['lots' => function($query) {
                $query->active();
            }]),
            'lots' => $user->lots->paginate(12)
        ]);
    }

    public function freelancerOrders(User $user)
    {
        return view('freelance.freelancer.orders', [
            'user' => $user->loadCount(['lots' => function($query) {
                $query->active();
            }, 'orders', 'reviews'])->load(['orders' => function($query) {
                $query->withCount('offers')->with('user');
            }]),
            'orders' => $user->orders->paginate(12)
        ]);
    }

    public function freelancerReviews(Request $request, User $user) {
        return view('freelance.freelancer.reviews', [
            'user' => $user->loadCount(['lots' => function($query) {
                $query->active();
            }, 'orders', 'reviews' => function($query) use($request) {
                if($request->reviews === 'positive') {
                    $query->positive();
                } else if($request->reviews === 'negative') {
                    $query->negative();
                }
            }])->load(['reviews' => function($query) use($request) {
                if($request->tag === 'positive') {
                    $query->positive();
                } else if($request->tag === 'negative') {
                    $query->negative();
                }

                $query->with([
                    'user' => function(BelongsTo $user) {
                        $user->withCount([
                            'reviews as positive_reviews_count' => function(Builder $query) {
                                $query->positive();
                            }, 'reviews as negative_reviews_count' => function(Builder $query) {
                                $query->negative();
                            }
                        ]);
                    }
                ]);
            }]),
            'reviews' => $user->reviews->paginate(12)
        ]);
    }

    public function safe(Order $order) {
        $user = auth()->user();

        if(!$order->isSafe) abort(401);

        return view('safe', [
            'order' => $order->load('safe'),
            'offer' => $order->offer(),
            'user' => $user,
        ]);
    }

    public function employerLots(User $user)
    {;
        return view('freelance.employer.lots', [
            'user' => $user->loadCount(['lots' => function($query) {
                $query->active();
            }, 'orders', 'reviews'])->load(['lots' => function($query) {
                $query->active();
            }]),
            'lots' => $user->lots->paginate(12)
        ]);
    }

    public function employerOrders(User $user)
    {
        return view('freelance.employer.orders', [
            'user' => $user->loadCount(['lots' => function($query) {
                $query->active();
            }, 'orders', 'reviews'])->load(['orders' => function($query) {
                $query->withCount('offers')->with('user');
            }]),
            'orders' => $user->orders->paginate(12)
        ]);
    }
}

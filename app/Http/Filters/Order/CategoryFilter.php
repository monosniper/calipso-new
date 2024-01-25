<?php

namespace App\Http\Filters\Order;

use App\Models\Category;
use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter extends Filter
{
    /**
     * Apply the condition to the query.
     *
     * @param Builder $builder
     * @param mixed $value
     *
     * @return Builder
     */
    public function apply(Builder $builder, $value): Builder
    {
        $categories = Category::where('slug', $value)->first()->ancestorsAndSelf();
        $slugs = $categories->pluck('slug');

        return $builder->whereHas('category', function (Builder $query) use($slugs) {
            $query->whereIn('slug', $slugs);
        });
    }
}

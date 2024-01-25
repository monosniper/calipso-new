@extends('layouts.dashboard')

@section('title')
    {{__('main.become_freelancer')}}
@endsection

@section('content')
    <div class="grey_block">
        <div class="profile_title">{{__('main.become_freelancer')}}</div>
        <div class="profile__description">
            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam delectus dignissimos dolorum eligendi
                eos error inventore itaque iure laborum minima nam nesciunt nostrum quam quibusdam repellat,
                repellendus, repudiandae totam veritatis.
            </div>
            <div>A assumenda, culpa excepturi explicabo itaque maxime mollitia neque nulla quo sit unde, velit, veniam
                voluptates! Dignissimos minus nostrum quae sunt. Amet cupiditate est magnam quos sint! Aliquam, numquam,
                recusandae!
            </div>
            <div>Commodi facilis non reprehenderit sint. Error, esse fugiat incidunt ipsam magni perspiciatis quaerat
                quod recusandae sapiente voluptate. Alias eum excepturi facere fugiat fugit magni nulla perferendis
                placeat? Atque exercitationem, laboriosam!
            </div>
            <div>Amet atque blanditiis facilis fugiat fugit illo inventore ipsum labore laborum maxime neque nisi nobis
                pariatur placeat, porro praesentium qui quisquam. At consequuntur facere incidunt iste laudantium, neque
                sint sit!
            </div>
        </div>
        <div class="profile__footer">
            <a href="{{ route('forms.become') }}" class="webz_btn">{{ __('main.become_freelancer') }}</a>
        </div>
    </div>
@endsection

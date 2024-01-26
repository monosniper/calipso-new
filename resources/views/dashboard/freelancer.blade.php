@extends('layouts.dashboard')

@section('title')
    {{__('main.become_freelancer')}}
@endsection

@section('content')
    <div class="grey_block">
        <div class="profile_title">{{__('main.become_freelancer')}}</div>
        <div class="profile__description">
            <div>{!! __('dashboard.become_text') !!}</div>
        </div>
        <div class="profile__footer">
            <a href="{{ route('forms.become') }}" class="webz_btn">{{ __('main.become_freelancer') }}</a>
        </div>
    </div>
@endsection

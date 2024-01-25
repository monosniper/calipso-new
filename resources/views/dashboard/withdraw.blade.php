@extends('layouts.dashboard')

@section('title')
    {{__('main.withdraw')}}
@endsection

@section('content')
    <div class="grey_block">
        <div class="profile_title">{{__('main.withdraw')}}</div>
        <div class="profile__description">{{__('dashboard.withdraw_text')}}</div>
        <form action="{{route('forms.withdraw')}}" method="post" class="profile_form">
            @csrf

            <label class="profile_form_label" for="amount">{{__('dashboard.amount')}}:</label>
            <input class="profile_form_field {{$errors->has('amount') ? 'error' : ''}}" name="amount" id="amount" type="number" required>
            @if($errors->has('amount'))
                @foreach($errors->get('amount') as $err)
                    <div class="profile_form_field_error">{{$err}}</div>
                @endforeach
            @endif

            <label class="profile_form_label" for="old_password">VISA | MasterCard:</label>
            <input class="profile_form_field {{$errors->has('card') ? 'error' : ''}}" name="card" id="card" type="text" required>
            @if($errors->has('card'))
                @foreach($errors->get('card') as $err)
                    <div class="profile_form_field_error">{{$err}}</div>
                @endforeach
            @endif

            <button type="submit" class="webz_btn d-inline-block">{{__('dashboard.to_withdraw')}}</button>
        </form>
    </div>
@endsection

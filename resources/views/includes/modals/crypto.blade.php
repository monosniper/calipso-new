<div class="modal_wrapper" id="crypto">
    <div class="modal">
        <div class="modal_title">{{__('main.replenish_by_crypto')}}</div>
        <form action="{{route('forms.crypto')}}" method="post" class="modal_form">
            @csrf
            <p>{{ __('main.min_crypto') }}</p>
            <input type="number" required name="amount" value="{{ request()->old('amount') }}"
                   placeholder="{{__('dashboard.amount')}}:" class="modal_field">
            <button class="submit" type="submit"></button>
        </form>
        <div class="modal_footer">
            <button class="webz_btn confirm_btn">{{__('main.replenish_by_crypto')}}</button>
            <button class="webz_btn webz_btn_outline dismiss_btn">{{__('main.cancel')}}</button>
        </div>
    </div>

    <div class="modal_overflow"></div>
</div>

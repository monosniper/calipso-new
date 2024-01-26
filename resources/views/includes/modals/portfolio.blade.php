<div class="modal_wrapper"  id="portfolio-{{$portfolio->id}}">
    <div class="modal animate__faster">
        <div class="modal_title small">
            <span>{{$portfolio->title}}</span>
            <span>
                <i class="fas fa-thumbs-o-up"></i>
            </span>
        </div>

        <div class="portfolio-img">
            <ul class="slider ">
                @foreach($portfolio->getMedia('preview') as $image)
                    <li>
                        <input type="radio" id="slide{{ $loop->index }}" name="slide" @checked(!$loop->index)>
                        <label for="slide{{ $loop->index }}"></label>
                        <img src="{{ $image->getFullUrl() }}" alt="{{ $portfolio->title }}">
                    </li>
                @endforeach
            </ul>
        </div>

        <p class="portfolio-description">{{$portfolio->description}}</p>

        @if($portfolio->link)
            <div class="portfolio-link">
                {{__('modals.add_portfolio.link')}}: <a target="_blank" href="{{$portfolio->link}}">{{$portfolio->link}}</a>
            </div>
        @endif

        <div class="modal_footer">
            <button class="webz_btn webz_btn_outline dismiss_btn">{{__('main.ok')}}</button>
            @if($portfolio->user_id === auth()->id())
                <button class="webz_btn webz_btn_outline delete_btn" data-link="{{route('portfolios.destroy', $portfolio->id)}}">{{__('main.delete')}}</button>
            @endif
        </div>
    </div>

    <div class="modal_overflow"></div>
</div>

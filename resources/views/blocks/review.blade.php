<hr class="uk-divider-icon">
<section id="uk-block-8"
         class="uk-block">
    <div class="uk-container" id="reviews">
        <h2 class="uk-h1 uk-title uk-text-center">
            Отзывы
        </h2>
        <div class="uk-grid owl-settings" uk-grid>
            {{--<div class="uk-width-1-6 text-block-center nav-owl-btn">--}}
            {{--<i class="fa fa-angle-left btn-prev" aria-hidden="true" style="font-size: 4em;"></i>--}}
            {{--</div>--}}
            <div class="{{--uk-width-expand--}} uk-width-1-1">
                <div class="uk-items-list owl-carousel owl-settings" id="comment-slider">
                    @foreach($reviews as $review)
                        <article class="uk-comment uk-comment-primary">
                            <header class="uk-comment-header uk-grid-medium uk-flex-middle" uk-grid>
                                <div class="uk-width-auto">
                                    @if(isset( App\Files::find($review->image)->filename))
                                        <div class="uk-comment-avatar"
                                             style="background: url(/storage/files/{{ App\Files::find($review->image)->filename }}) center center no-repeat;
                                                     background-size: contain;"></div>
                                    @endif
                                </div>
                                <div class="uk-width-expand">
                                    <h4 class="uk-comment-title uk-margin-remove">
                                        <a class="uk-link-reset" href="#">{!! $review->name !!}</a>
                                    </h4>
                                    @if(!is_null($review->url))
                                        <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                                            @foreach($review->url as $caption => $href)
                                                <li>
                                                    <a href="{{ $href }}">{{ $caption }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </header>
                            <div class="uk-comment-body">
                                <p>{!! $review->body !!}</p>
                            </div>
                            @if(isset($review->phone))
                                <div class="uk-comment-body">
                                    <p>{{ $review->phone }}</p>
                                </div>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
            {{--<div class="uk-width-1-6 text-block-center nav-owl-btn">--}}
            {{--<i class="fa fa-angle-right btn-next" aria-hidden="true" style="font-size: 4em;"></i>--}}
            {{--</div>--}}
        </div>
    </div>
</section>
<script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap"></script>
<script>
    $("#comment-slider").owlCarousel({
        items: 1,
        loop: true,
        singleItem: true,
        nav: true,
        navText: ["", ""],
        dots: true,
        autoPlay: true,
        autoHeight: true
    });
</script>


@extends('layouts.app')

@section('content')

sdfg

    <style>
        #map {
            width: 100%;
            height: 500px;
        }
    </style>

    <nav class="uk-navbar-container uk-margin" uk-navbar>
        <div class="uk-navbar-left">

            <a class="uk-navbar-item uk-logo" href="#">Logo</a>

            <ul class="uk-navbar-nav">
                <li>
                    <a href="#">
                        <span class="uk-icon uk-margin-small-right" href="#" uk-icon="icon: star"></span>
                        Features
                    </a>
                </li>
            </ul>

            <div class="uk-navbar-item">
                <div>Some <a href="#">Link</a></div>
            </div>

            <ul class="uk-navbar-nav">
                @forelse($menu as $item)
                    <li><a href="#{{ $item->class }}">{{ $item->title }}</a></li>
                @empty
                @endforelse
            </ul>

        </div>








        <div class="uk-navbar-right">
            <ul class="phone-navbar-nav">
                @foreach($title_phones as $title_phone)
                    @if($title_phone != null)<li>{{ $title_phone }}</li>@endif
                @endforeach
                <li><a uk-toggle="target: #contact" type="button">Заказать обратный звонок</a></li>

                    <div id="contact" uk-modal="center: true">
                        <div class="uk-modal-dialog uk-modal-body">

                            <form>
                                <div class="uk-margin">
                                    <input type="text" class="uk-input" placeholder="text">
                                </div>
                                <div class="uk-margin">
                                    <input type="text" class="uk-input" placeholder="text">
                                </div>
                                <button class="uk-button uk-button-primary">button</button>
                            </form>

                        </div>
                    </div>

            </ul>
        </div>
    </nav>
    <div class="front">
        <div class="uk-section uk-section-muted">
            <div class="uk-container">
                @if(isset($titleObj) && $titleObj != null)
                    <div class="container" @if(isset($titleObj->image))
                    style="background-image: url(/storage/files/{{ App\Files::find($titleObj->image)->filename  }})"
                            @endif>
                        @include("$titleObj->templates")
                    </div>
                @endif
            </div>
        </div>
        @forelse($texts as $text)
            <div @foreach($menu as $item)
                    @if( $item->block == $text->id) id="{{$item->class}}" @endif
                @endforeach class="uk-section uk-section-muted static-text">

                <div class="uk-container bacground"
                        @if(isset($text->background))
                        style="background-image: url(/storage/files/{{ App\Files::find($text->background)->filename }})"
                        @endif>
                    <p>{!! $text->title !!}</p>
                    <div class="uk-grid-match uk-child-width-1-2@m" uk-grid>
                        <div>
                            @if(isset(App\Files::find($text->image)->filename))
                                <img src="/storage/files/{{ App\Files::find($text->image)->filename }}"
                                     alt="advantages-scheme" class="advantages-scheme">
                            @endif
{{--
                            <div class="static-img" style="background-image: url('{{asset ('/img/ava.png')}}')"></div>
--}}
                        </div>
                        <div>
                            <p>{!! $text->bady !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        @endforelse

        <div class="uk-section uk-section-muted static-text adwantages">
            <div class="uk-container">
                <h2 class="uk-heading-primary uk-text-center uk-h2">Преимущества</h2>
                <div class="uk-grid-match uk-flex-center uk-child-width-1-3@m" uk-grid
                     uk-scrollspy="target: > div; cls:uk-animation-fade; delay: 500">

                   @foreach($advantages as $advantage)
                        <div>
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-body">
                                    <div class="parent">
                                        @if(isset( App\Files::find($advantage->image)->filename))
                                            <img src="/storage/files/{{ App\Files::find($advantage->image)->filename }}"
                                             alt="">
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-card-header">
                                    <p class="uk-heading-primary uk-card-title">{!! $advantage->title !!}</p>
                                </div>
                                <div class="uk-card-footer">
                                    <p>{!!  $advantage->sub_title !!}</p>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>

        <div class="uk-section uk-section-muted review">
            <div class="uk-container">
                <div uk-grid>
                    <div class="uk-width-1-6">
                        <a onclick="$('.comment-slider').slick('slickPrev');"><i class="fa fa-angle-left"
                                                                                 aria-hidden="true"></i></a>
                    </div>
                    <div class="uk-width-expand">
                        <div class="comment-slider">
                            @forelse($reviews as $review)
                            <div>
                                <header class="uk-comment-header uk-grid-medium uk-flex-middle" uk-grid>
                                    <div class="uk-width-auto">
                                        @if(isset( App\Files::find($review->image)->filename))
                                        <img class="uk-comment-avatar"
                                             src="/storage/files/{{ App\Files::find($review->image)->filename }}"
                                             width="80" height="80"
                                             alt="">@endif
                                    </div>
                                    <div class="uk-width-expand">
                                        <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset"
                                                                                         href="#">{{ $review->name }}</a>
                                        </h4>
                                        <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                                            <li><a href="#">{{ $review->created_at }}</a></li>
                                            <li><a href="#">{!! $review->title !!}</a></li>
                                        </ul>
                                    </div>
                                </header>
                                <div class="uk-comment-body">{!! $review->body !!}</div>
                            </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                    <div class="uk-width-1-6"><a onclick="$('.comment-slider').slick('slickNext');"><i
                                    class="fa fa-angle-right"
                                    aria-hidden="true"></i></a></div>
                </div>
            </div>
        </div>
        <div class="uk-section uk-section-muted">
            <div class="uk-container">
                <div uk-grid>

                    <div class="uk-width-1-3 uk-card uk-card-default uk-padding">
                        <dl>
                            <dt>Телефоны:</dt>
                            @forelse($phones as $phone)
                                <dd>{{ $phone }}</dd>
                            @empty
                            @endforelse
                            <dt>E-mail:</dt>
                            <dd>@if(isset($contacts['contact_email']) && $contacts['contact_email'] != null){{ $contacts['contact_email'] }}@endif</dd>
                            @if(! is_null($view_day7))
                                <dt>Ми працюємо без вихідних:</dt>
                                <dt>Время работы</dt>
                                <dd>{{ $view_day7[0] }} - {{ $view_day7[1] }}</dd>
                                <dd>Перерыв</dd>
                                <dd>{{ $view_day7[2] }} - {{ $view_day7[3] }}</dd>
                            @endif
                            @if(! is_null($view_day5))
                                <dt>Ми працюємо без вихідних:</dt>
                                <dt>Время работы</dt>
                                <dd>{{ $view_day7[0] }} - {{ $view_day7[1] }}</dd>
                                <dd>Перерыв</dd>
                                <dd>{{ $view_day7[2] }} - {{ $view_day7[3] }}</dd>
                            @endif
                            @for($i = 0; $i < count($alldays); $i+=5)
                                @if(! is_null($alldays[$i]) && ($alldays[$i+1] != $days7[0] || $alldays[$i+2] != $days7[1] ||
                                $alldays[$i+3] != $days7[2] || $alldays[$i+4] != $days7[3]))
                                    <dd>{{ $days_name[$alldays[$i]] }} : {{ $alldays[$i+1] }}
                                        - {{ $alldays[$i+2] }}
                                        <br><span style="font-size: 0.8em">Перерыв: </span>
                                        {{ $alldays[$i+3] }}
                                        - {{ $alldays[$i+4] }}</dd>
                                @endif
                            @endfor

                           {{-- @if(count($view_day7) != null)
                                @if(count($view_day5) == null)
                                    @if()
                                    <dt>Ми працюємо без вихідних:</dt>
                                    <dt>Время работы</dt>
                                    <dd>{{ $view_day7[0] }} - {{ $view_day7[1] }}</dd>
                                    <dd>Перерыв</dd>
                                    <dd>{{ $view_day7[2] }} - {{ $view_day7[3] }}</dd>
                                    @for($i = 0; $i < count($alldays); $i+=5)
                                        @if($alldays[$i] != null && ($alldays[$i+1] != $days7[0] || $alldays[$i+2] != $days7[1] ||
                                        $alldays[$i+3] != $days7[2] || $alldays[$i+4] != $days7[3]))
                                            <dd>{{ $days_name[$alldays[$i]] }} : {{ $alldays[$i+1] }}
                                                - {{ $alldays[$i+2] }}
                                                <br><span style="font-size: 0.8em">Перерыв: </span>
                                                {{ $alldays[$i+3] }}
                                                - {{ $alldays[$i+4] }}</dd>
                                        @endif
                                    @endfor
                                @else
                                    <dt>Ми працюємо з Пон-Птн:</dt>
                                    <dt>Время работы</dt>
                                    <dd>{{ $days5[0] }} - {{ $days5[1] }}</dd>
                                    <dd>Перерыв</dd>
                                    <dd>{{ $days5[2] }} - {{ $days5[3] }}</dd>
                                    @for($i = 0; $i < count($alldays)-10; $i+=5)
                                        @if($alldays[$i] != null && ($alldays[$i+1] != $days5[0] || $alldays[$i+2] != $days5[1] ||
                                        $alldays[$i+3] != $days5[2] || $alldays[$i+4] != $days5[3]))
                                            <dd>{{ $days_name[$alldays[$i]] }} : {{ $alldays[$i+1] }}
                                                - {{ $alldays[$i+2] }}
                                                <br><span style="font-size: 0.8em">Перерыв: </span>
                                                {{ $alldays[$i+3] }}
                                                - {{ $alldays[$i+4] }}</dd>
                                        @endif
                                    @endfor
                                @endif
                            @else
                                @if(count($days5) == 0)
                                    @for($i = 0; $i < count($alldays)-10; $i+=5)
                                        @if($alldays[$i] != null)
                                            <dd>{{ $days_name[$alldays[$i]] }} : {{ $alldays[$i+1] }}
                                                - {{ $alldays[$i+2] }}
                                                <br><span style="font-size: 0.8em">Перерыв: </span>
                                                {{ $alldays[$i+3] }} - {{ $alldays[$i+4] }}</dd>
                                        @endif
                                    @endfor
                                @else
                                    <dt>Ми працюємо з Пон-Птн:</dt>
                                    <dt>Время работы</dt>
                                    <dd>{{ $days5[0] }} - {{ $days5[1] }}</dd>
                                    <dd>Перерыв</dd>
                                    <dd>{{ $days5[2] }} - {{ $days5[3] }}</dd>
                                    @for($i = 0; $i < count($alldays)-10; $i+=5)
                                        @if($alldays[$i] != null && ($alldays[$i+1] != $days5[0] || $alldays[$i+2] != $days5[1] ||
                                        $alldays[$i+3] != $days5[2] || $alldays[$i+4] != $days5[3]))
                                            <dd>{{ $days_name[$alldays[$i]] }} : {{ $alldays[0] }} - {{ $alldays[1] }}
                                                <br><span style="font-size: 0.8em">Перерыв: </span>
                                                {{ $alldays[2] }} - {{ $alldays[3] }}</dd>
                                        @endif
                                    @endfor
                                @endif
                            @endif--}}
                            <dt>Адрес:</dt>
                            <dd>@if(isset($contacts['address']) && $contacts['address'] != null){!! $contacts['address'] !!}@endif</dd>

                        </dl>
                    </div>
                    <div class="uk-width-1-3"></div>
                    @if(isset($contacts['map_show']) && $contacts['map_show'] == 1)
                        <div class="uk-width-1-3 uk-card uk-card-default uk-padding-remove">
                            <div id="map"></div>


                            <script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap"></script>

                           {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d20346.8995365466!2d25.786890699999997!3d50.3970826!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1suk!2sua!4v1489957143218"
                                    frameborder="0" style="width: 100%; height: 100%;" allowfullscreen></iframe>--}}
                        </div>
                    @endif

                </div>
            </div>
        </div>
        <footer class="uk-section uk-section-muted">
            <div class="uk-container">
                <div class="uk-text-center" uk-grid>
                    <div class="uk-width-1-3">© 2017</div>
                    <div class="uk-width-1-3"><a href="#" uk-totop uk-scroll></a></div>
                    <div class="uk-width-1-3"><a href="http://site-devel.com"><img src="{{asset ('img/oleus.png')}}"
                                                                                   alt=""></a>
                    </div>
                </div>
            </div>
        </footer>

        @push('styles')
        <style>
            .static-img{
            margin: 0 auto;
            background-position: center center;
            background-size: contain;
                background-repeat: no-repeat;
            height: 202px;
            width: 392px;}
        </style>
        @endpush

        @endsection

        @push('script')
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap"></script>
        <script>
            $('.comment-slider').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000
            });

            @if(isset($contacts['latitude']) && isset($contacts['longitude']))
            var map;
            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: {{ $contacts['latitude'] }}, lng: {{ $contacts['longitude'] }} },
                    zoom: 17
                });
                var marker = new google.maps.Marker({
                    position: {lat: {{ $contacts['latitude'] }}, lng: {{ $contacts['longitude'] }}},
                    map: map,
                    title: ''
                });
            }
            @endif

            @if(Session::has('title'))
            UIkit.notification("{!! Session::get('title.message') !!}", {
                status: '{{ Session::get('title.status') }}',
                pos: 'top-right'
            });
            @endif
            @if(Session::has('contact'))
                    UIkit.notification("{!! Session::get('contact.message') !!}", {
                status: '{{ Session::get('contact.status') }}',
                pos: 'top-right'
            });
            @endif
            @if(Session::has('form'))
                    UIkit.notification("{!! Session::get('form.message') !!}", {
                status: '{{ Session::get('form.status') }}',
                pos: 'top-right'
            });
            @endif
            @if(Session::has('fields'))
                    UIkit.notification("{!! Session::get('fields.message') !!}", {
                status: '{{ Session::get('fields.status') }}',
                pos: 'top-right'
            });
            @endif
        </script>
    @endpush

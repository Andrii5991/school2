@extends('layouts.app')

@section('content')
    <section id="uk-header-navbar"
             class="uk-nav-header">
        <div class="uk-container">
            <nav class="uk-margin"
                 uk-navbar>
                <div class="uk-navbar-left">
                    <a class="uk-navbar-item uk-logo"
                       href="#">
                        @if(isset($titleObj) && $titleObj != null && isset(App\Files::find($titleObj->logotype)->filename))
                            <div style="width: 100px; height: 100px; background: url('/storage/files/{{ App\Files::find($titleObj->logotype)->filename }}') center center no-repeat;
                                    background-size: contain;"></div>
                        @endif
                    </a>
                    <ul class="uk-navbar-nav">
                        @forelse($menu as $item)
                            <li><a href="#{{ $item->class }}">{{ $item->title }}</a></li>
                        @empty
                        @endforelse
                    </ul>
                </div>
                <div class="uk-navbar-right">
                    <div class="uk-text-center">
                        <div class="uk-phones-list">
                            @forelse($title_phones as $title_phone)
                                <a href="tel:{{ $title_phone }}"
                                   class="uk-phone @if($title_phone == array_first($title_phones)) uk-show @endif">
                                    {{ $title_phone }}
                                </a>
                            @empty
                            @endforelse
                        </div>
                        <a href="#"
                           class="uk-callback-link"
                           uk-toggle="target: #modal-callback-form">Заказать обратный звонок</a>
                    </div>
                </div>
            </nav>
        </div>
    </section>

    @if(isset($titleObj) && $titleObj != null)
        <div class="container" @if(isset($titleObj->image))
        style="
                background: url(/storage/files/{{ App\Files::find($titleObj->image)->filename  }}) center center no-repeat;
                background-size: cover;
                "
                @endif>
            @include("$titleObj->templates")
        </div>
    @endif

    @if(isset($contacts['static_text']) && isset($contacts['static_text']) && isset($contacts['static_text']))
        @for($q = 1; $q <=3; $q++)
            @if($contacts['static_text'] == $q)
                @include('blocks.static_text')
            @elseif($contacts['advantage'] == $q)
                @include('blocks.advantage')
            @elseif($contacts['review'] == $q)
                @include('blocks.review')
            @endif
        @endfor
    @else
        @include('blocks.static_text')
        @include('blocks.advantage')
        @include('blocks.review')
    @endif

    <hr class="uk-divider-icon">

    @include('modals.callBackForm')

    @if(isset($contacts['map_position']))
        @include('oleus.contact.map_show.'.$contacts['map_position'])
    @endif

    <section id="uk-footer">
        <div class="uk-container uk-padding">
            <div class="uk-grid"
                 uk-grid>
                <div class="uk-width-1-2 uk-text-left uk-footer-left-sidebar">
                    <div class="uk-copyright">&copy; 2017 Copyright</div>
                </div>
                <div class="uk-width-1-2 uk-text-right uk-footer-right-sidebar">
                    <div class="uk-devel-studio">
                        <a href="#">
                            <img src="{{asset ('img/oleus.png')}}"
                                 alt="oleus">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap"></script>
<script>
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
</script>
@endpush
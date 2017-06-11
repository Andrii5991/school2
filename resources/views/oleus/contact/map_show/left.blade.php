<div class="uk-section uk-section-muted">
    <div class="uk-container">
        <div uk-grid>
            @if(isset($contacts['map_show']) && $contacts['map_show'] == 1)
                <div class="uk-width-2-3 uk-card uk-card-default uk-padding-remove">
                    <div style=" width: 100%; height: 500px;" id="map"></div>
                    <script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap"></script>

                </div>
            @endif

            {{--<div class="uk-width-1-3"></div>--}}

            <div class="uk-width-1-3 uk-card uk-card-default uk-padding">
                @include('oleus.contact.map_show.contact_info')
            </div>



        </div>
    </div>
</div>
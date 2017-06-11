@if(isset($contacts['map_show']) && $contacts['map_show'] == 1)
    <div class="uk-width-1-1 uk-card uk-card-default uk-padding-remove" style="position: relative;">

        <div class="fix-height uk-padding" style="position: absolute; left: 100px; z-index: 999999;">
            <div class="uk-card uk-card-default uk-padding">
                @include('oleus.contact.map_show.contact_info')
            </div>
        </div>

        <div style="width: 100%; height: 500px;" id="map" class="fix-height"></div>

        <script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap"></script>
        <script>
            window.onload = function () {
                setTimeout(function () {
                    var mainDivs = document.getElementsByClassName("fix-height");
                    var maxHeight = 0;
                    for (var i = 0; i < mainDivs.length; ++i) {
                        if (maxHeight < mainDivs[i].clientHeight) {
                            maxHeight = mainDivs[i].clientHeight;
                        }
                    }
                    for (var i = 0; i < mainDivs.length; ++i) {
                        mainDivs[i].style.height = maxHeight + "px";
                    }
                }, 1000);
            }

        </script>
    </div>
@endif
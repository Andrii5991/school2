<div class="uk-padding">
    <form action="">
        <div class="uk-grid">
            <div class="uk-width-1-1">
                <div class="uk-margin">
                    @if(isset($titleObj->logotype) && $titleObj->logotype != null)
                        <img src="/storage/files/{{ App\Files::find($titleObj->logotype)->filename }}"
                             alt="">
                    @endif
                </div>
                <div class="uk-margin">
                    {!! $titleObj->title !!}
                </div>
                <div class="uk-margin">
                    {!! $titleObj->sub_title !!}
                </div>
                <div class="uk-margin">
                        @if(isset($titleObj->video))<iframe width="560" height="315" src="{{ $titleObj->video }}" frameborder="0"  allowfullscreen></iframe>@endif
                </div>
            </div>
        </div>
    </form>
</div>

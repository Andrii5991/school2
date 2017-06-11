<hr class="uk-divider-icon">
<section id="uk-block-7"
         class="uk-block">
    <div class="uk-container" id="advantages">
        <h2 class="uk-h1 uk-title uk-text-center">
            Переваги
        </h2>

        <div style="align-items: stretch;" class="uk-grid uk-child-width-1-4@s uk-flex-center uk-text-center"
             uk-grid>
            @foreach($advantages as $advantage)
                <div class="uk-card uk-card-default uk-card-body uk-margin-left uk-margin-right">
                    <div class="uk-card-body adwantages">
                        @if(isset( App\Files::find($advantage->image)->filename))
                            <div class="parent" style="
                                    background: url(/storage/files/{{ App\Files::find($advantage->image)->filename }}) center center no-repeat;
                                    background-size: contain;
                                    ">
                            </div>
                        @endif
                    </div>
                    {!! $advantage->title !!}
                    {!! $advantage->sub_title !!}
                </div>
            @endforeach
        </div>
    </div>
</section>
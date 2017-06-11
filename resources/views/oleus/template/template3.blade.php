<section id="uk-header-title"
         class="uk-template-2">
    <div class="uk-container">
        <div class="uk-grid uk-grid-collapse"
             uk-grid>
            <div class="uk-width-1-2 uk-padding  text-block-center">

                <h1 class="uk-h1 uk-title">
                    {!! $titleObj->title !!}
                </h1>

                <div class="uk-h2 uk-subtitle uk-margin-small-top">
                    {!! $titleObj->subtitle !!}
                </div>
                <div class="uk-text-meta">
                    {!! $titleObj->text !!}

                </div>
            </div>
            <div class="uk-width-1-2 uk-padding">
                <div class="uk-cover-container uk-height-medium">
                    @if(isset($titleObj->video))<iframe src="{{ $titleObj->video }}"
                            width="560"
                            height="315"
                            frameborder="0"
                            allowfullscreen
                            uk-cover></iframe>@endif
                </div>
            </div>
        </div>
    </div>
</section>
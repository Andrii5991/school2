<section id="uk-header-title"
         class="uk-template-3">
    <div class="uk-container">
        <div class="uk-padding-small">

            <h1 class="uk-h1 uk-title">
                {!! $titleObj->title !!}
            </h1>

            <div class="uk-h2 uk-subtitle uk-margin-small-top">
                {!! $titleObj->sub_title !!}
            </div>
            <div class="uk-text-meta">
                {!! $titleObj->text !!}

            </div>
            <div class="uk-cover-container uk-height-large">
                @if(isset($titleObj->video))<iframe src="{{ $titleObj->video }}"
                                                    width="560"
                                                    height="315"
                                                    frameborder="0"
                                                    allowfullscreen
                                                    uk-cover></iframe>@endif
            </div>
        </div>
    </div>
</section>
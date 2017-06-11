<section id="uk-block-5"
         class="uk-block">
    <div class="uk-container"  @if(isset($text->class)) id="{{ $text->class }}" @endif
    @if(isset($text->background))
    style="
            background: url(/storage/files/{{ App\Files::find($text->background)->filename  }}) center center no-repeat;
            background-size: cover;
            "
            @endif>
        <div class="uk-grid uk-grid-collapse uk-child-width-1-2@s"
             uk-grid>
            <div class="uk-padding-small">
                {!! $text->title !!}

                <div class="uk-h2 uk-subtitle uk-margin-small-top">
                    {!! $text->sub_title !!}
                </div>
                <div class="uk-text-meta">
                    <p>{!! $text->body !!}</p>
                </div>
            </div>
            <div class="uk-padding-small">
                @if(isset(App\Files::find($text->image)->filename))
                <div class="uk-cover-container uk-height-medium" style="background: url(/storage/files/{{ App\Files::find($text->image)->filename }}) center center no-repeat;
                        background-size: contain;">
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
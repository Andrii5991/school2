<section id="uk-block-1"
         class="uk-block">
    <div class="uk-container" @if(isset($text->class)) id="{{ $text->class }}" @endif
         @if(isset($text->background))
         style="
                 background: url(/storage/files/{{ App\Files::find($text->background)->filename  }}) center center no-repeat;
                 background-size: cover;
                 "
            @endif>
        <div class="uk-padding">
                {!! $text->title !!}
            <div class="uk-h2 uk-subtitle uk-margin-small-top">
                {!! $text->sub_title !!}
            </div>
            <div class="uk-text-meta">
                <p>{!! $text->body !!}</p>
            </div>
        </div>
    </div>
</section>
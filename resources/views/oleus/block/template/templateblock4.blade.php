<section id="uk-block-4"
         class="uk-block">
    <style>
        article {
            -webkit-column-count:2;
            -moz-column-count:2;
            column-count:2;
        }
    </style>
    <div class="uk-container"  @if(isset($text->class)) id="{{ $text->class }}" @endif
    @if(isset($text->background))
    style="
            background: url(/storage/files/{{ App\Files::find($text->background)->filename  }}) center center no-repeat;
            background-size: cover;
            "
            @endif>
        {!! $text->title !!}

        <div class="uk-h2 uk-subtitle uk-margin-small-top">
            {!! $text->sub_title !!}
        </div>
        <div class="uk-grid uk-grid-collapse uk-child-width-1-1@s"
             uk-grid>
           <article>
               {!! $text->body !!}
           </article>
            </div>
        </div>
    </div>
</section>
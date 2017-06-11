<section id="uk-block-6"
         class="uk-block">

    <div class="uk-container" @if(isset($text->class)) id="{{ $text->class }}" @endif
    @if(isset($text->background))
    style="
            background: url(/storage/files/{{ App\Files::find($text->background)->filename  }}) center center no-repeat;
            background-size: cover;
            "
            @endif>
        <div class="uk-grid uk-child-width-1-2@s uk-grid-collapse"
             uk-grid>
            <div class="uk-padding">
                {!! $text->title !!}
                <div class="uk-h2 uk-subtitle uk-margin-small-top">
                    {!! $text->sub_title !!}
                </div>
                <div class="uk-text-meta">
                    <p>{!! $text->body !!}</p>
                </div>
            </div>
            <div class="uk-padding-small">
                <div class="uk-card uk-card-default">
                    @if(!is_null($text->form) && $text->form->status)
                        <form action="#" method="post"
                              class="uk-form uk-padding-medium uk-border-5">
                            {{ csrf_field() }}
                            <div class="uk-form-row">
                                <h2 class="uk-h2 uk-margin-remove uk-margin-small">
                                    {!! $text->form->title !!}
                                </h2>

                                <div class="uk-h4 uk-margin-remove">
                                    {!! $text->form->sub_title !!}
                                </div>
                            </div>
                            <div class="uk-form-row">
                                @forelse($text->form->fields as $field)
                                    <label class="uk-form-label"
                                           for="">{{ $field['title'] }}
                                        @if($field['required'])*@endif</label>
                                    <div class="uk-form-controls">
                                        <input type="{{ $types[$field['type']] }}" name="{{ $field['type'] }}[]"
                                               id=""
                                               class="uk-input uk-width-1-1 uk-border-5"
                                               placeholder="{{ $field['title'] }}"
                                               @if($field['required']) required @endif>

                                    </div>
                                @empty
                                @endforelse
                            </div>
                            <div class="uk-form-row uk-form-action uk-text-center">
                                <button type="submit" class="uk-button uk-button-primary uk-border-5">
                                    @if(!is_null($text->form->button)){!! $text->form->button !!}@elseОтправить@endif
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
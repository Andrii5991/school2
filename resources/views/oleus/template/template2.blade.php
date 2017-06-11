<section id="uk-header-title"
         class="uk-template-2">
    <div class="uk-container">
        <div class="uk-grid uk-grid-collapse"
             uk-grid>
            <div class="uk-width-1-3@m uk-width-1-2@s uk-padding-small">
                @if(!is_null($titleObj->form) && !is_null($form) && $form->status)
                    <form action="{{ route('send.email') }}"
                          method="post"
                          class="uk-form uk-padding-medium uk-border-5">
                        {{ csrf_field() }}
                        <input hidden name="titleId" value="{{ $titleObj->id }}">
                        <input hidden name="formId" value="{{ $form->id }}">
                        <input hidden name="check" value="title">
                        <div class="uk-form-row">
                            <h2 class="uk-h2 uk-margin-remove uk-margin-small">
                                {!! $form->title !!}
                            </h2>

                            <div class="uk-h4 uk-margin-remove">
                                {!! $form->sub_title !!}
                            </div>
                        </div>
                        <div class="uk-form-row">
                            @forelse($fields as $field)
                                <label class="uk-form-label"
                                       for="">{{ $field['placeholder'] }}
                                    @if($field['required'])*@endif</label>

                                <div class="uk-form-controls">
                                    <input type="{{ $field['type'] }}" name="{{ $field['placeholder'] }}"
                                           class="@if($field['type'] == 'checkbox') uk-checkbox @else uk-input
                                           @endif uk-border-5
                                           @if($field['type'] == 'phone') phonemask @endif
                                           @if($field['type'] == 'checkbox') checkbox @endif"
                                           placeholder="{{ $field['placeholder'] }}"
                                           @if($field['required']) required @endif>
                                </div>
                            @empty
                            @endforelse
                        </div>

                        <div class="uk-form-row uk-form-action uk-text-center">
                            <button type="submit" class="uk-button uk-button-primary uk-border-5">
                                @if(!is_null($form->button)){!! $form->button !!}@elseОтправить@endif
                            </button>
                        </div>
                    </form>
                @else
                    <h1>Форма не создана</h1>
                @endif
            </div>
            <div class="uuk-width-2-3@m uk-width-1-2@s uk-padding-small  text-block-center">

                <h1 class="uk-h1 uk-title">
                    {!! $titleObj->title !!}
                </h1>

                <div class="uk-h2 uk-subtitle uk-margin-small-top">
                    {!! $titleObj->sub_title !!}
                </div>
                <div class="uk-text-meta">
                    {!! $titleObj->text !!}

                </div>
            </div>
        </div>
    </div>
</section>
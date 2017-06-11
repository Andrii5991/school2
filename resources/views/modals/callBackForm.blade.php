<div id="modal-callback-form"
     uk-modal="center: true">
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-outside"
                type="button"
                uk-close></button>
        <div class="uk-modal-body">
            @if(isset($call_back))
                <form action="{{ route('send.email') }}"
                      method="post"
                      class="uk-form uk-padding-medium uk-border-5">
                    {{ csrf_field() }}
                    <input hidden name="check" value="callBack">
                    <div class="uk-form-row">
                        <h2 class="uk-h2 uk-margin-remove uk-margin-small uk-text-center">
                            {!! $call_back->title !!}
                        </h2>
                        <div class="uk-h4 uk-margin-remove uk-text-center">
                            {!! $call_back->sub_title !!}
                        </div>
                    </div>
                    <div class="uk-form-row">
                        @forelse($call_back_fields as $field)
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
                            @if(!is_null($call_back->button)){!! $call_back->button !!}@elseПерезвонить мне@endif
                        </button>
                    </div>
                </form>
            @else <div class="uk-form-row uk-text-center">Форма не вибрана</div>
            @endif
        </div>
    </div>
</div>
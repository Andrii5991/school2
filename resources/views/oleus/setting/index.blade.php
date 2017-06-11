@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container">
        <h3 class="uk-text-center uk-text-danger">Налаштування</h3>
        <div class="uk-card uk-card-default">
            <form class="uk-form-stacked" method="POST" id="type_form" action="{{ route('setting.update') }}">
                {{ csrf_field() }}
                <div class="uk-card-header">
                    <input class="uk-button btn-save pull-right uk-margin-bottom" type="submit"
                           value='Сохранить'>
                </div>
                <div class="uk-card-body uk-grid" uk-grid>

                    <div class="uk-width-1-2">
                        <div class="uk-margin {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="uk-form-label uk-margin-right">Email</label>
                            <div class="uk-form-controls">
                                <input name="email" type="text" value="{{ $settings['adminEmail'] or old('email') }}"
                                       class="uk-input uk-margin-bottom">
                                @if ($errors->has('email'))
                                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label uk-margin-right">Подяка</label>
                            <div class="uk-form-controls">
                                <input name="message" type="text" value="{{ $settings['message'] or old('message') }}"
                                       class="uk-input uk-margin-bottom">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label uk-margin-right" for="call_back">Вибір форми зворотнього звязку</label>
                            <div class="uk-form-controls">
                                <select class="uk-select" name="call_back" id="call_back">
                                    @if(isset($call_back))<option value="{{ $call_back->id }}" selected>{!! $call_back->title !!}</option>
                                @elseif(count($forms) == 0)<option value="null">У вас немає створених форм</option>
                                    @else <option value="null">Виберіть форму</option>  @endif

                                    @forelse($forms as $form)
                                        <option value="{{ $form->id }}">{!! $form->title !!}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label uk-margin-right">Google.Analytics:</label>
                            <div class="uk-form-controls">
                    <textarea placeholder="{{ old('google_analytics') }}" id="google_analytics" name="google_analytics"
                              rows="3"
                              class="uk-textarea uk-margin-bottom">{{ $settings['google_analytics'] or old('google_analytics') }}</textarea>
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label uk-margin-right">Яндекс.Метрика</label>
                            <div class="uk-form-controls">
                    <textarea placeholder="{{ old('yandex_metrix') }}" id="yandex_metrix" name="yandex_metrix" rows="3"
                              class="uk-textarea uk-margin-bottom">{{ $settings['yandex_metrix'] or old('yandex_metrix') }}</textarea>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label uk-margin-right" for="title">Вибір заголовка</label>
                            <div class="uk-form-controls">
                                <select class="uk-select" name="title">
                                    <option value="error">Без заголовка</option>
                                    @foreach($titles as $title)
                                        <option value="{{ $title->title }}"
                                                @if(isset($settings['title']) && $settings['title'] == $title->title) selected
                                                @endif>{!! $title->title !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label uk-margin-right">Оптимізація конверсій</label>
                            <div class="uk-form-controls">
                                <select name="conversion" class="uk-select" id="form-horizontal-select">
                                    <option value="3-0-0"
                                            @if(isset($settings['conversion']) && $settings['conversion'] == "3-0-0") selected @endif>
                                        3-0-0
                                    </option>
                                    <option value="3-2-1"
                                            @if(isset($settings['conversion']) && $settings['conversion'] == "3-2-1") selected @endif>
                                        3-2-1
                                    </option>
                                    <option value="3-1-1"
                                            @if(isset($settings['conversion']) && $settings['conversion'] == "3-1-1") selected @endif>
                                        3-1-1
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-2 check" id="welcome_sort" uk-sortable>
                        @if(isset($settings['static_text']))
                            @for($q = 1; $q <=3; $q++)
                                @if($settings['static_text'] == $q)
                                    <div class="uk-card uk-card-default uk-padding uk-card-hover uk-margin sortable"
                                         id="static_text">
                                        <input hidden name="welcome_sort[]" value="static_text">
                                        Статичні блоки
                                    </div>
                                @elseif($settings['advantage'] == $q)
                                    <div class="uk-card uk-card-default uk-padding uk-card-hover uk-margin sortable"
                                         id="advantage">
                                        <input hidden name="welcome_sort[]" value="advantage">
                                        Викладачі
                                    </div>
                                @elseif($settings['review'] == $q)
                                    <div class="uk-card uk-card-default uk-padding uk-card-hover uk-margin sortable"
                                         id="review">
                                        <input hidden name="welcome_sort[]" value="review">
                                        Відгуки
                                    </div>
                                @endif
                            @endfor
                        @else
                            <div class="uk-card uk-card-default uk-padding uk-card-hover uk-margin sortable"
                                 id="static_text">
                                <input hidden name="welcome_sort[]" value="static_text">
                                Статичні блоки
                            </div>
                            <div class="uk-card uk-card-default uk-padding uk-card-hover uk-margin sortable"
                                 id="advantage">
                                <input hidden name="welcome_sort[]" value="advantage">
                                Викладачі
                            </div>
                            <div class="uk-card uk-card-default uk-padding uk-card-hover uk-margin sortable"
                                 id="review">
                                <input hidden name="welcome_sort[]" value="review">
                                Відгуки
                            </div>
                        @endif
                        {{--@if(count($w_s) > 0)
                            @foreach($w_s as $item)
                                {{ dd($item, $welc_sort_text[$item]) }}
                                --}}{{--<div class="uk-card uk-card-default uk-padding uk-card-hover uk-margin sortable"
                                     id="static_text">
                                    <input hidden name="welcome_sort[]" value="">
                                    --}}{{----}}{{--@if($item == $welc_sort_text["$item"]) {{ $welc_sort_text["$item"] }}@endif--}}{{----}}{{--
                                </div>--}}{{--
                            @endforeach
                        @else--}}

                        {{--@endif--}}
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
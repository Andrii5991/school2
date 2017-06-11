@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container">
        <h3 class="uk-text-center uk-text-danger">Создать заголовок</h3>
        <div class="uk-card uk-card-default">
            @if(Session::has('checkActive'))
                <div>
                    <span style="color: red">Ви не можете создать больш 3-х активних заголовков</span>
                </div>
            @endif
            <form method="post" id="type_form" action="{{ route('title.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="uk-card-header">
                    <div class="uk-margin pull-left">
                        <label class="uk-form-label" for="status">
                            <input class="uk-checkbox checkbox_status" type="checkbox" name="status"
                                   value="1">Опубликовано
                        </label>
                    </div>
                    <input class="uk-button btn-create pull-right" type="submit" value='СОЗДАТЬ ЗАГОЛОВОК'>
                </div>
                <div class="uk-card-body">
                    <div class="uk-margin">
                        <label class="uk-form-label" for="title">Заголовок*
                            @if(Session::has('t'))<label style="color: red"> это поле обезательно</label>
                            @endif</label>
                        <div class="uk-form-controls">
                    <textarea id="title" name="title" type="text" class="uk-textarea htmleditor"
                              placeholder="title">{{ old('title') }}</textarea>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="sub_title">Подзаголовок</label>
                        <div class="uk-form-controls">
                    <textarea id="sub_title" name="sub_title" type="text" class="uk-textarea htmleditor"
                              placeholder="Sub title">{{ old('sub_title') }}</textarea>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="logotype">Логотип*
                            @if(Session::has('k'))<label style="color: red"> это поле обезательно</label>
                            @endif</label>
                        <div class="uk-form-file">
                            <button class="uk-button"></button>
                            <input type="file" name="logotype" id="logotype" accept="image/*">
                        </div>
                    </div>


                    <div class="uk-margin">
                        <label class="uk-form-label" for="image">Изображение <span
                                    style="color: #7a7a7a; font-size: 0.8em"> (Минимальный размер изображения 1920 х * px)</span></label>
                        <div class="uk-form-file">
                            <button class="uk-button"></button>
                            <input type="file" name="image" id="image" accept="image/*">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="utm">UTM-content*
                            @if(Session::has('u'))<label style="color: red"> это поле обезательно</label>
                            @endif</label>
                        <div class="uk-form-controls">
                            <input id="utm" name="utm" type="text" class="uk-input" placeholder="utm"
                                   value="{{ old('utm') }}" {{--pattern="[A-Za-z0-9%]+"--}}>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="form">Форма</label>
                        <div class="uk-form-controls">
                            <select class="uk-select" name="form" id="form">
                                <option value="">Виберите форму</option>
                                @forelse($forms as $form)
                                    <option value="{{ $form->id }}">{!! $form->title !!}</option>
                                @empty
                                    <option value="">У вас нет созданых форм</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label">Телефон</label>
                        @for($i = 1; $i<=3; $i++)
                            <div id="divResult" class="uk-margin uk-form-controls add_field">
                                <input id="phone" name="phone[]" type="text" class="uk-input phonemask"
                                       placeholder="Телефон №{{$i}}" value="{{ old('phone[]') }}">
                            </div>
                        @endfor
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="video">Видео</label>
                        <div class="uk-form-controls">
                            <input id="video" name="video" type="text" class="uk-input"
                                   placeholder="id видео с YouTube или Vimeo" value="{{ old('video') }}">
                        </div>
                    </div>
                    <div class="uk-margin uk-flex-center uk-child-width-1-3@m checktemp" uk-grid>
                        @for($i=1; $i<=5; $i++)
                            <div class="uk-card uk-padding"><input id="tem{{ $i }}" class="uk-radio" type="radio"
                                                                   name="templates"
                                                                   value="{{ config("template.templates.template$i.blade") }}"
                                                                   @if($i == 1) checked @endif>
                                <label for="tem{{ $i }}"><img src="{{ asset("img/template/$i.png") }}"
                                                              alt="template {{ $i }}"></label></div>
                        @endfor
                    </div>
                <div class="uk-margin">
                    <label class="uk-form-label">HTML-текст</label>
                    <div class="uk-form-controls">
                        <textarea class="uk-textarea htmleditor" name="text"
                                  rows="5" placeholder="HTML text">{{ old('text') }}</textarea>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

@endsection
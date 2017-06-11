@extends('oleus.layouts.admin')

@section('content')

    <div class="uk-container uk-margin">
        <h3 class="uk-text-center uk-text-danger">Изменить заголовок {!! $title->title !!} </h3>
        <div class="uk-card uk-card-default">
            @if(Session::has('checkActive'))
                <div>
                    <span style="color: red">Ви не можете создать больш 3-х активних заголовков</span>
                </div>
            @endif
            <form method="post" id="type_form" action="{{ route('title.update', $title) }}"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="uk-card-header">
                    <div class="uk-margin pull-left">
                        <label class="uk-form-label" for="status">
                            <input class="uk-checkbox checkbox_status" type="checkbox" name="status"
                                   value="1" @if($title->status) checked @endif>Опубликовано
                        </label>
                    </div>
                    <button class="uk-button btn-save pull-right" type="submit">
                        Сохранить <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="uk-card-body">
                    <div class="uk-margin">
                        <label class="uk-form-label" for="title">Заголовок*
                            @if(Session::has('t'))<label style="color: red"> это поле обезательно</label>
                            @endif</label></label>
                        <div class="uk-form-controls">
                            <textarea id="title" name="title" type="text"
                                      class="uk-textarea htmleditor">{{ $title->title or old('title') }}</textarea>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="sub_title">Подзаголовок</label>
                        <div class="uk-form-controls">
                            <textarea id="sub_title" name="sub_title" type="text"
                                      class="uk-textarea htmleditor">{{ $title->sub_title or old('sub_title') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="uk-form-label" for="logotype">Логотип</label>
                        @if(isset($logo))
                            <img src="/storage/files/{{ $logo->filename }}">
                        @endif
                        <div class="uk-form-file">
                            <button class="uk-button"></button>
                            <input type="file" name="logotype" id="logotype" accept="image/*">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="uk-form-label" for="image">Изображение <span
                                    style="color: #7a7a7a; font-size: 0.8em"> (Минимальный размер изображения 1920 х * px)</span></label>
                        @if(isset($image))
                            <img src="/storage/files/{{ $image->filename }}">
                        @endif
                        <div class="uk-form-file">
                            <button class="uk-button"></button>
                            <input type="file" name="image" id="image" accept="image/*">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="utm">UTM-content*
                            @if(Session::has('u'))<label style="color: red"> это поле обезательно</label>
                            @endif</label></label>
                        <div class="uk-form-controls">
                            <input id="utm" name="utm" type="text" class="uk-input" value="{{ $title->utm or old('utm')}}">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="form">Форма</label>
                        <div class="uk-form-controls">
                            {{--<input id="form" name="form" type="text" class="uk-input" placeholder="Form id">--}}
                            <select class="uk-select" name="form" id="form">
                                @if($form != null)
                                    <option value="{{ $form->id }}">{!! $form->title !!}</option>
                                    @foreach($forms as $item)
                                        @if($form->title != $item->title)<option value="{{ $item->id }}">{!! $item->title !!}</option>@endif
                                    @endforeach
                                @elseif($form == null && count($forms) == 0)
                                    <option value="">У вас не створені форми</option>
                                @elseif($form == null && count($forms) != 0)
                                    <option value="">Без форми</option>
                                    @foreach($forms as $item)
                                        <option value="{{ $item->id }}">{!! $item->title !!}</option
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label">Телефон</label>
                        @foreach($phones as $num => $phone)
                                <div id="divResult" class="uk-margin uk-form-controls add_field">
                                    <input id="phone" name="phone[]" type="text" class="uk-input phonemask"
                                           value="{{ $phone or old($phone)}}" placeholder="Телефон №{{$num+1}}">
                                </div>
                        @endforeach
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="video">Видео</label>
                        <div class="uk-form-controls">
                            <input id="video" name="video" type="text" class="uk-input" value="{{ $title->video}}">
                        </div>
                    </div>

                    <div class="uk-margin uk-flex-center uk-child-width-1-3@m checktemp" uk-grid>
                        @foreach($templates as $template)
                            @if($template['blade'] == $title->template) {{ dd('+') }} @endif
                            <div class="uk-card uk-padding"><input id="{{ $template['blade'] }}" class="uk-radio" type="radio"
                                                                   name="templates"
                                                                   value="{{ $template['blade'] }}"
                                                                   @if($template['blade'] == $title->templates) checked @endif>
                                <label for="{{ $template['blade'] }}"><img src="{{ asset($template['image']) }}"
                                                              alt="{{ $template['blade'] }}"></label></div>
                        @endforeach

                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label">HTML-текст</label>
                        <div class="uk-form-controls">
                            <textarea class="uk-textarea htmleditor" rows="5" name="text"
                                      placeholder="HTML text">{!! $title->text !!}</textarea>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="sort">Сортировка: </label>
                        <div class="uk-form-controls">
                            <input class="uk-input" type="number" name="sort" id="sort" min="0"
                                   value="{{ $title->sort }}">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
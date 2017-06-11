@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container">
        <h3 class="uk-card-title">Створення статичного тексту</h3>
        <div class="uk-card uk-card-default">
            <form method="post" id="type_form" action="{{ route('text.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="uk-card-header">
                <div class="uk-margin pull-left">
                    <label class="uk-form-label" for="status">
                        <input class="uk-checkbox checkbox_status" type="checkbox" name="status"
                               value="1">Опубліковано
                    </label>
                </div>
                <button class="uk-button btn-save uk-margin-top pull-right" type="submit">Зберегти <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
            </div>
            <div class="uk-card-body">
                <div class="uk-margin">
                    <label class="uk-form-label">Заголовок*
                        @if(Session::has('notify'))<label style="color: red">це поле обов'язкове</label>
                        @endif</label>
                    <div class="uk-form-controls">
                        <textarea id="title" name="title"  type="text" class="uk-textarea htmleditor" placeholder="Title">{{ old('title') }}</textarea>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="sub_title">Підзаголовок:</label>
                    <div class="uk-form-controls">
                            <textarea id="sub_title" name="sub_title" type="text" class="uk-textarea htmleditor"
                                      placeholder="Title">{{ old('sub_title') }}</textarea>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label">Вміст</label>
                    <div class="uk-form-controls">
                        <textarea id="body" name="body"  type="text" class="uk-textarea htmleditor" placeholder="Body">{{ old('body') }}</textarea>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form">Форма:</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" name="form" id="form">
                            <option value="">@if(count($forms) > 0)
                            Виберите форму
                            @elseУ вас немає створених форм
                            @endif</option>
                            @forelse($forms as $form)
                                <option value="{{ $form->id }}">{!! $form->title !!}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="image">Зображення</label><span style="color: #7a7a7a; font-size: 0.8em"> (Минимальный размер изображения 600 х 150px)</span>
                    <div class="uk-form-file">
                        <button class="uk-button"></button>
                        <input type="file" name="image" id="image" accept="image/*">
                    </div>
                </div>


                <div class="uk-margin">
                    <label class="uk-form-label" for="background">Фон</label>
                    <div class="uk-form-file">
                        <button class="uk-button"></button>
                        <input type="file" name="background" id="background" accept="image/*">
                    </div>
                </div>


                <div class="uk-margin">
                    <label class="uk-form-label" for="location_image">Місцезнаходження</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="location_image" name="location_image">
                            @foreach(config('config.location_image') as $path => $val)
                                <option value="{{ $path }}">{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
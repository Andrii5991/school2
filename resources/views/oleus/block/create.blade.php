@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container uk-margin">

        <h3 class="uk-text-center uk-text-danger"> Створити "Новини" </h3>

        <div class="uk-card uk-card-default">
            <form method="post" id="type_form" action="{{ route('block.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="uk-card-header">

                    <div class="uk-margin pull-left">
                        <label class="uk-form-label" for="status">
                            <input class="uk-checkbox checkbox_status" type="checkbox" name="status"
                                   value="1">Опубліковано
                        </label>
                    </div>

                    <input class="uk-button btn-create pull-right" type="submit" value='СТВОРИТИ БЛОК'>

                </div>
                <div class="uk-card-body">

                    <div class="uk-margin">
                        <label class="uk-form-label" for="title">Заголовок*
                            @if(Session::has('notify'))<label style="color: red"> Це поле обов'язкове</label>
                            @endif</label>
                        <div class="uk-form-controls">
                            <textarea id="title" name="title" type="text" class="uk-textarea htmleditor"
                                      placeholder="Title"></textarea>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="sort">Тип Новини: </label>
                        <div class="uk-form-controls">
                            <select id="bundle" name="bundle" class="uk-select">
                                @foreach(config('config.bundle') as $val => $name)
                                    <option value="{{ $val }}">{{ $name }}</option>
                                @endforeach
                            </select>
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
                        <label class="uk-form-label" for="body">Опис:</label>
                        <div class="uk-form-controls">
                            <textarea id="body" name="body" rows="3" class="uk-textarea">{{ old('body') }}</textarea>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="image">Зображення: </label>
                        <div class="uk-form-file">
                            <button class="uk-button"></button>
                            <input type="file" name="image" id="image" accept="image/*">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label">Фон:

                            <a class="link-tab-imgcolor" type="button" uk-toggle="target: .toggle">
                                <span class="toggle">Колір</span>
                                <span class="toggle" hidden>Зображення</span>
                            </a>
                        </label>
                        <div class="uk-form-file uk-margin toggle">
                            <button class="uk-button"></button>
                            <input type="file" name="background" id="background" accept="image/*">
                        </div>
                        <div class="uk-margin toggle" hidden>

                            <input type="color" name="color" onchange="clickColor(0, -1, -1, 5)" value="#ff0000"
                                   style="padding: 0; margin: 0; background: transparent; border: 0; height: 100px; width: 100px;">

                        </div>
                        <select class="uk-select" id="location_image" name="location_image">
                            @foreach(config('config.location_image') as $path => $val)
                                <option value="{{ $path }}">{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label" for="sort">Сортування: </label>
                        <div class="uk-form-controls">
                            <input class="uk-input" type="number" name="sort" id="sort" min="0" value="0">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
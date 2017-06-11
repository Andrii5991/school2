@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container uk-margin">
        <h3 class="uk-text-center uk-text-danger"> Редагувати "Новини": {!! $block->title !!} </h3>
        <div class="uk-card uk-card-default">
            <form class="uk-form-stacked" method="post" id="type_form" action="{{ route('block.update', $block) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="uk-card-header">
                <div class="uk-margin pull-left">
                    <label class="uk-form-label uk-margin-right" for="status">
                        <input class="uk-checkbox checkbox_status" type="checkbox" name="status" value="1"
                               @if($block->status) checked @endif >
                        Опубліковано
                    </label>
                </div>
                <input class="uk-button btn-save pull-right" type="submit" value="Змінити">
            </div>
            <div class="uk-card-body">
                <div class="uk-margin">
                    <label class="uk-form-label uk-margin-right" for="title">Заголовок*
                        @if(Session::has('notify'))<label style="color: red"> Це поле обов'язкове</label>
                        @endif</label>
                    <div class="uk-form-controls">
                        <textarea id="title" name="title"  type="text" class="uk-textarea htmleditor" placeholder="Title">{!! $block->title !!}</textarea>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label uk-margin-right" for="sub_title">Підзаголовок</label>
                    <div class="uk-form-controls">
                        <textarea id="sub_title" name="sub_title"  type="text" class="uk-textarea htmleditor" placeholder="Sub_title">{!! $block->sub_title !!}</textarea>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label uk-margin-right" for="body">Опис</label>
                    <div class="uk-form-controls">
                    <textarea id="body" name="body" rows="3"
                              class="uk-textarea uk-margin-bottom">{!! $block->body !!}</textarea>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label">Фон:

                        <a class="link-tab-imgcolor" type="button" uk-toggle="target: .toggle">
                            <span class="toggle">колір</span>
                            <span class="toggle" hidden>Зображення</span>
                        </a>
                    </label>
                    <div class="uk-form-file uk-margin toggle">
                        <button class="uk-button"></button>
                        @if(isset($background))
                            <img src="/storage/files/{{ $background->filename }}">
                        @endif
                        <input type="file" name="background" id="background" accept="image/*">
                    </div>
                    <div class="uk-margin toggle" hidden>

                        <input type="color" name="color" onchange="clickColor(0, -1, -1, 5)" value="{{ $block->color }}"
                               style="padding: 0; margin: 0; background: transparent; border: 0; height: 100px; width: 100px;">

                    </div>
                    <select class="uk-select" id="location_image" name="location_image">
                        @foreach(config('config.location_image') as $path => $val)
                            <option value="{{ $path }}" @if($block->location_image == $path) selected @endif>{{ $val }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="uk-form-label" for="sort">Сортування: </label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="number" name="sort" id="sort" min="0" value="{{ $block->sort }}">
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection


@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container">
        <h3 class="uk-text-center uk-text-danger">Редагування: {!! $advantage->title !!}</h3>
        <div class="uk-card uk-card-default">
            <form class="uk-form-stacked" method="post" id="type_form" action="{{ route('advantage.update', $advantage) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
        <div class="uk-card-header">

            <div class="uk-margin pull-left">
                <label class="uk-form-label uk-margin-right" for="status">
                    <input class="uk-checkbox checkbox_status" type="checkbox" name="status" value="1"
                           @if($advantage->status) checked @endif>
                    Опубліковано
                </label>
            </div>

            <button class="uk-button btn-save uk-margin-top pull-right" type="submit">Зберегти <i
                        class="fa fa-floppy-o" aria-hidden="true"></i></button>

        </div>
        <div class="uk-card-body">
                <div class="uk-margin">
                <label class="uk-form-label" for="title">Заголовок*
                @if(Session::has('notify'))<label style="color: red"> Це поле обов'язкове</label>
                @endif</label>
                <div class="uk-form-controls">
                    <textarea id="title" name="title" type="text" class="uk-input uk-form-width-large htmleditor"
                    >{{ $advantage->title}}</textarea>
                    </div>
                </div>

                <div class="uk-margin">
                <label class="uk-form-label" for="sub_title">Підзаголовок</label>
                <div class="uk-form-controls">
                    <textarea id="sub_title" name="sub_title" type="text" class="uk-input uk-margin-bottom uk-form-width-large htmleditor"
                    >{{ $advantage->sub_title}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                <label class="uk-form-label" for="image">Зображення: </label>
                @if(isset($image))
                <img src="/storage/files/{{ $image->filename }}">
                @endif
                <div class="uk-form-file">
                    <button class="uk-button"></button>
                    <input type="file" name="image" id="image" accept="image/*">
                    </div>
                </div>
            <div class="form-group">
                <label class="uk-form-label" for="sort">Сортування: </label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="number" name="sort" id="sort" min="0" value="{{ $advantage->sort }}">
                </div>
            </div>

            </div>
            </form>
        </div>










            {{--<div class="uk-margin">--}}
                {{--<label class="uk-form-label" for="content">Количество:</label>--}}
                {{--<div class="uk-form-controls">--}}
                    {{--<input id="" name="" class="uk-input uk-form-width-large">--}}
                {{--</div>--}}
            {{--</div>--}}





    </div>
@endsection
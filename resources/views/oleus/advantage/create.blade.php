@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container">
        <h3 class="uk-text-center uk-text-danger">Створити</h3>
        <div class="uk-card uk-card-default">
            <form method="post" id="type_form" action="{{ route('advantage.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="uk-card-header">
                <div class="uk-margin pull-left">
                    <label class="uk-form-label" for="status">
                        <input class="uk-checkbox checkbox_status" type="checkbox" name="status"
                               value="1">Опубліковано
                    </label>
                </div>
                <input class="uk-button btn-save pull-right" type="submit" value='СТВОРИТИ'>
            </div>
            <div class="uk-card-body">

                <div class="uk-margin">
                    <label class="uk-form-label" for="title">Заголовок*
                        @if(Session::has('notify'))<label style="color: red"> це поле обов'язкове</label>
                        @endif</label>
                    <div class="uk-form-controls">
                        <textarea  id="title" name="title" type="text" class="uk-input uk-form-width-large htmleditor">{{ old('title') }}</textarea>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="content">Підзаголовок:</label>
                    <div class="uk-form-controls">
                        <textarea id="sub_title" name="sub_title" type="text" class="uk-input uk-form-width-large htmleditor">{{ old('sub_title') }}</textarea>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="content">Зображення:</label>
                    <div class="uk-form-file">
                        <button class="uk-button"></button>
                        <input type="file" name="image" id="image" accept="image/*">
                    </div>
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







            {{--<div class="uk-margin">--}}
                {{--<label class="uk-form-label" for="content">Количество:</label>--}}
                {{--<div class="uk-form-controls">--}}
                    {{--<input id="" name="" class="uk-input uk-form-width-large">--}}
                {{--</div>--}}
            {{--</div>--}}


            {{--<div class="uk-margin">--}}
                {{--<label class="uk-form-label" for="content">Порядок:</label>--}}
                {{--<div class="uk-form-controls">--}}
                {{--<select class="uk-select uk-form-width-large">--}}
                    {{--<option>1</option>--}}
                    {{--<option>2</option>--}}
                    {{--<option>3</option>--}}
                {{--</select>--}}
                {{--</div>--}}
            {{--</div>--}}


    </div>
@endsection
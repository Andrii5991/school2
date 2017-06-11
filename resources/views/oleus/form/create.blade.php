@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container">
        <h3 class="uk-text-center uk-text-danger">Нова форма</h3>
        <div class="uk-card uk-card-default">
            <form method="post" id="type_form" action="{{ route('form.store') }}">
                {{ csrf_field() }}
            <div class="uk-card-header">
                <div class="uk-margin pull-left">
                    <label class="uk-form-label" for="status">
                        <input class="uk-checkbox checkbox_status" type="checkbox" name="status"
                               value="1">Опубліковано
                    </label>
                </div>
                <input type="submit" class="uk-button btn-save pull-right" value="Сохранить">
            </div>
            <div class="uk-card-body">

                <div class="uk-margin">
                    <label class="uk-form-label uk-margin-right" for="title">Заголовок*
                        @if(Session::has('notify'))<label style="color: red"> поле обов'язкове</label>
                        @endif
                    </label>
                    <div class="uk-form-controls">
                        <textarea id="title" name="title"  type="text" class="uk-textarea htmleditor"
                                  placeholder="Title">{{ old('title') }}</textarea>

                        {{--<input type="text" id="title" name="title"
                               class="uk-input uk-margin-bottom"
                               placeholder="title" value="{{ old('title') }}">--}}
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label uk-margin-right" for="sub_title">Підзаголовок</label>
                    <div class="uk-form-controls">
                        <textarea id="sub_title" name="sub_title"  type="text" class="uk-textarea htmleditor"
                                  placeholder="Подзаголовок">{{ old('sub_title') }}</textarea>

                        {{--<input type="text" id="sub_title" name="sub_title"
                               class="uk-input uk-margin-bottom"
                               placeholder="sub_title" value="{{ old('sub_title') }}">--}}
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label uk-margin-right" for="button">Надпис на кнопці</label>
                    <div class="uk-form-controls">
                        <input type="text" id="button" name="button"
                               class="uk-input uk-margin-bottom"
                               placeholder="button" value="{{ old('button') }}">
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label uk-margin-right" for="email">E-mail</label>
                    <div class="uk-form-controls">
                        <input type="email" id="email" name="email"
                               class="uk-input uk-margin-bottom"
                               placeholder="email" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label uk-margin-right" for="title">Ціль Google.Analytics</label>
                    <div class="uk-form-controls">
                        <input type="text" id="" name="" class="uk-input uk-margin-bottom"
                               placeholder="">
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label uk-margin-right" for="title">Ціль Яндекс.Метрики</label>
                    <div class="uk-form-controls">
                        <input type="text" id="" name="" class="uk-input uk-margin-bottom"
                               placeholder="">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label uk-margin-right">Шаблон</label>
                    <div class="uk-form-controls">
                        <select class="uk-select uk-form-width-large" name="show_template">
                            <option value="0">По горизонталі</option>
                            <option value="1">По вертикалі</option>
                        </select>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="show_title">
                        <input class="uk-checkbox checkbox_status" type="checkbox" name="show_title" id="show_title"
                               value="1">Показати заголовок
                    </label>
                </div>


            </div>
            <div class="uk-card-footer">
                <label class="uk-form-label">Конструктор полів</label>
                <div id="divResult" class="uk-margin add_field">

                </div>

                <a class="uk-button btn-create uk-margin-bottom pull-left btn_add_field" id="add_field">
                    Добавити поле <i class="fa fa-plus-square"></i>
                </a>
            </div>
            </form>
        </div>

    </div>


            {{--<div class="uk-margin">--}}
                {{--<label class="uk-form-label uk-margin-right" for="short_code">Short code</label>--}}
                {{--<div class="uk-form-controls">--}}
                    {{--<input type="text" id="short_code" name="short_code"--}}
                           {{--class="uk-input uk-margin-bottom uk-form-width-large"--}}
                           {{--placeholder="short_code">--}}
                {{--</div>--}}
            {{--</div>--}}



            {{--<div class="uk-margin uk-grid-small uk-child-width-auto" uk-grid>--}}
                {{--<label class="uk-form-label uk-margin-right" for="title">Показывать заголовок?</label>--}}
                {{--<label><input class="uk-radio" type="radio" value="1" name="show_title" checked> Да</label>--}}
                {{--<label><input class="uk-radio" type="radio" value="0" name="show_title"> Нет</label>--}}
            {{--</div>--}}




            {{--@if($fields != null)
                @foreach($fields as $field)
                    <div class="uk-card uk-card-default uk-card-body">
                        <div uk-grid>
                            <div class="uk-width-1-6@m">id1</div>
                            <div class="uk-width-1-6@m">Имя</div>
                            <div class="uk-width-expand@m">

                                <form action="" class="uk-display-inline">
                                    <input class="uk-checkbox" type="checkbox" checked>
                                </form>
                                Обязательное поле
                            </div>
                            <div class="uk-width-expand@m">Текстовое</div>
                            <div class="uk-width-1-6@m">

                                --}}{{--<a href="--}}{{----}}{{--{{ route('form.destroy', $form) }}--}}{{----}}{{--"--}}{{--
                                --}}{{--class="uk-margin-right"><i class="fa fa-floppy-o"></i></a>--}}{{--

                                <a href="--}}{{--{{ route('form.destroy', $form) }}--}}{{--"
                                   class="modal-del"><i class="fa fa-trash-o"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif--}}

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        var i = 0;

        $(".btn_add_field").click(function () {
            $('<div id="box_' + i + '">' +
                '<div style="margin-left: 0; margin: 10px;" uk-grid>' +
                '<select class="uk-select uk-width-1-2@m" name="fields[]">' +
                    @foreach($fields as $field)
                        '<option value="{{ $field->id }}">{{ $field->title }} | {{ $field->type }}</option>' +
                    @endforeach
                        '</select>' +
                '<button class="uk-button uk-button-danger uk-width-1-6" id="box_' + i + '" onclick="$(this).prev().remove(); this.remove();">Del</button>' +
                '</div></div>').appendTo('.add_field');

            i++;
        });
    });
</script>
@endpush
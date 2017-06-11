@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container">
        <h3 class="uk-text-center uk-text-danger">Створити відгук</h3>
        <div class="uk-card uk-card-default">
            <form method="post" id="type_form" class="uk-form-horizontal uk-margin-large"
                  action="{{ route('review.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="uk-card-header">
                    <div class="uk-margin pull-left">
                        <label for="status">Опубліковано</label>
                        <input class="uk-checkbox checkbox_status" type="checkbox" name="status"
                               value="1">
                    </div>
                    <button class="uk-button btn-create uk-margin pull-right" type="submit">Створити</button>
                </div>
                <div class="uk-card-body">
                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-horizontal-text">Имя*
                            @if(Session::has('t'))<label style="color: red"> це поле обов'язкове</label>
                            @endif</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" id="name" name="name" type="text" placeholder="Имя"
                                   value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-horizontal-text">Заголовок</label>
                        <div class="uk-form-controls">
                            <textarea class="uk-textarea htmleditor" id="title" name="title" type="text"
                                      placeholder="Заголовок">{{ old('title') }}</textarea>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-horizontal-text">Вміст*
                            @if(Session::has('b'))<label style="color: red"> це поле обов'язкове</label>
                            @endif</label>
                        <div class="uk-form-controls">
                            <textarea class="uk-textarea htmleditor" id="body" name="body" rows="5"
                                      placeholder="Содержимое">{{ old('body') }}</textarea>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="image">Зображення </label>
                        <div class="uk-form-file">
                            <button class="uk-button"></button>
                            <input type="file" name="image" id="image" accept="image/*">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-horizontal-text">Телефон</label>
                        <div class="uk-form-controls">
                            <input class="uk-input phonemask" name="phone" id="phone" type="text"
                                   value="{{ old('phone') }}">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-horizontal-text">E-mail</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" name="email" id="email" type="email" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label" for="sort">Сортування: </label>
                        <div class="uk-form-controls">
                            <input class="uk-input" type="number" name="sort" id="sort" min="0" value="0">
                        </div>
                    </div>
                </div>
                <div class="uk-card-footer">
                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-horizontal-text">Додаткові дані</label>
                        <div class="uk-form-controls">
                            <div id="divResult" class="add_url uk-grid" style="padding-top: 30px;">

                            </div>
                            <div class="uk-width-1-1 uk-padding-remove">
                                <a class="uk-button uk-button-default uk-button-small btn_add_url" id="add_url">
                                    Добавити url </i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        var i = 0;
        $(".btn_add_url").click(function () {
            $('<div class="uk-grid uk-padding-remove uk-margin-bottom uk-width-3-4">' +
                '<select class="uk-select uk-width-1-3" name="sel_url[]">' +
                @foreach($urls as $url)
                    '<option value="{{ $url }}">{{ $url }}</option>' +
                @endforeach
                '</select>' +
                '<input class="uk-input uk-width-2-3" name="url[]" type="text"></div>' +
                '<button id="box_' + i + '" onclick="$(this).prev().remove(); this.remove();" ' +
                    'class="uk-button uk-button-danger uk-button-small uk-margin-bottom modal-del uk-text-center uk-width-1-4">' +
                    '<i class="fa fa-trash-o"></i></button>'
            ).appendTo('.add_url');
            i++;
        });
    });
</script>
@endpush
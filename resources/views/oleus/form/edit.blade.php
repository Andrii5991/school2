@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container">
        <h3 class="uk-text-center uk-text-danger">Редагувати: {!! $form->title !!}</h3>
        <div class="uk-card uk-card-default">
            <form method="post" id="type_form" action="{{ route('form.update', $form) }}">
                {{ csrf_field() }}
            <div class="uk-card-header">
                <div class="uk-margin pull-left">
                    <label class="uk-form-label uk-margin-right" for="status">
                        <input class="uk-checkbox checkbox_status" type="checkbox" name="status" value="1"
                               @if($form->status) checked @endif>Опубліковано
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
                                  placeholder="Заголовок">{{ $form->title or old('title') }}</textarea>
                        {{--<input type="text" id="title" name="title"
                               class="uk-input uk-margin-bottom"
                               value="{{ $form->title }}">--}}
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label uk-margin-right" for="sub_title">Підзаголовок</label>
                    <div class="uk-form-controls">
                        <textarea id="sub_title" name="sub_title"  type="text" class="uk-textarea htmleditor"
                                  placeholder="Подзаголовок">{{ $form->sub_title or old('sub_title') }}</textarea>
                        {{--<input type="text" id="sub_title" name="sub_title"
                               class="uk-input uk-margin-bottom"
                               value="{{ $form->sub_title }}">--}}
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label uk-margin-right" for="button">Надпис на кнопкі</label>
                    <div class="uk-form-controls">
                        <input type="text" id="button" name="button"
                               class="uk-input uk-margin-bottom"
                               value="{{ $form->button }}">
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label uk-margin-right" for="email">E-mail</label>
                    <div class="uk-form-controls">
                        <input type="email" id="email" name="email"
                               class="uk-input uk-margin-bottom"
                               value="{{ $form->email }}">
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
                        <select class="uk-select" name="show_template">
                            <option value="@if($show_t) 1 @else 0 @endif">@if($show_t) По вертикалі @else По горизонтелі @endif</option>
                            <option value="@if($show_t) 0 @else 1 @endif">@if($show_t) По горизонтелі @else По вертикалі @endif</option>
                        </select>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="show_title">
                        <input class="uk-checkbox checkbox_status" type="checkbox" name="show_title" id="show_title"
                               @if($form->show_title) checked @endif value="1">Показати заголовок
                    </label>
                </div>




            </div>
            <div class="uk-card-footer">
                <label class="uk-form-label">Конструктор полів</label>
                @if(count($my_fields) != 0)
                    @for($i = 0; $i < count($my_fields); $i++)
                        <div id="box_{{$i}}">
                            <div style="margin-left: 0; margin: 10px;" uk-grid>
                                <select class="uk-select uk-width-1-3@m" name="fields[]">
                                    @foreach($fields as $field)
                                        <option value="{{ $my_fields[$i]->id }}">{{ $my_fields[$i]->title }}
                                            | {{ $my_fields[$i]->type }}</option>
                                        @if($my_fields[$i]->id != $field->id)
                                            <option value="{{ $field->id }}">{{ $field->title }}
                                                | {{ $field->type }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <button class="uk-button uk-button-danger uk-width-1-5" id="box_{{$i}}"
                                        onclick="$(this).prev().remove(); this.remove();">Del
                                </button>
                            </div>
                        </div>
                    @endfor
                @endif
                <div id="divResult" class="uk-margin add_field">

                </div>

                <a class="uk-button btn-create uk-margin-bottom pull-left btn_add_field" id="add_field">
                    Створити поле <i class="fa fa-plus-square"></i>
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
                           {{--value="{{ $form->short_code }}">--}}
                {{--</div>--}}
            {{--</div>--}}










@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        var i = 0;
        @if(count($my_fields) != 0) i = '{{ count($my_fields)-1 }}'; @endif

        $(".btn_add_field").click(function () {
            $('<div id="box_' + i + '">' +
                    '<div style="margin-left: 0; margin: 10px;" uk-grid>' +
                    '<select class="uk-select uk-width-1-3@m" name="fields[]">' +
                    @foreach($fields as $field)
                            '<option value="{{ $field->id }}">{{ $field->title }} | {{ $field->type }}</option>' +
                    @endforeach
                            '</select>' +
                    '<button class="uk-button uk-button-danger uk-width-1-5" id="box_' + i + '" onclick="$(this).prev().remove(); this.remove();">Del</button>' +
                    '</div></div>').appendTo('.add_field');

            i++;
        });
    });
</script>
@endpush
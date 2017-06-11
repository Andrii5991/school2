@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container uk-margin">
        <h3 class="uk-text-center uk-text-danger">Редагування відгуку {{ $review->name }}</h3>
        <div class="uk-card uk-card-default">
            <form class="uk-form-horizontal uk-margin-large" method="post" id="type_form"
                  action="{{ route('review.update', $review) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="uk-card-header">
                    <div class="uk-margin pull-left">
                        <label class="uk-form-label" for="status">Опубліковано</label>
                        <input class="uk-checkbox checkbox_status" type="checkbox" name="status"
                               @if($review->status) checked @endif
                               value="1">
                    </div>
                    <button class="uk-button btn-save uk-margin pull-right">Зберегти зміни</button>
                </div>
                <div class="uk-card-body">
                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-horizontal-text">Имя*
                            @if(Session::has('t'))<label style="color: red"> це поле обов'язкове</label>
                            @endif</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" id="name" name="name" type="text" value="{{ $review->name}}">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-horizontal-text">Заголовок</label>
                        <div class="uk-form-controls">
                            <textarea class="uk-textarea htmleditor" id="title" name="title"
                                      type="text">{{ $review->title}}</textarea>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-horizontal-text">Вміст*
                            @if(Session::has('b'))<label style="color: red"> це поле обов'язкове</label>
                            @endif</label>
                        <div class="uk-form-controls">
                            <textarea class="uk-textarea htmleditor" id="body" name="body"
                                      rows="5">{{ $review->body}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image">Зображення: </label>
                        @if(isset($image))
                            <img src="/storage/files/{{ $image->filename }}">
                        @endif
                        <div class="uk-form-file">
                            <button class="uk-button"></button>
                            <input type="file" name="image" id="image" accept="image/*">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-horizontal-text">Телефон</label>
                        <div class="uk-form-controls">
                            <input class="uk-input phonemask" id="phone" name="phone" type="text"
                                   value="{{ $review->phone}}">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-horizontal-text">E-mail</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" id="email" name="email" type="email" value="{{ $review->email}}">
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


                        <div class="uk-form-controls uk-grid">
                            @if(!is_null($review->url))
                                @forelse($review->url as $href => $caption)
                                    <div class="del-url uk-width-5-6 uk-grid">
                                        <div class="uk-grid uk-padding-remove uk-margin-remove uk-width-1-1">
                                            <select class="uk-select uk-width-1-3@m" name="sel_url[]">
                                                @foreach($urls as $url)
                                                    <option value="{{ $url }}" @if($url == $href) selected @endif>
                                                        {{ $url }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input class="uk-input uk-width-expand@m" name="url[]" type="text"
                                                   value="{{ $caption }}">
                                        </div>
                                    </div>
                                    <button id="box_{{--{{ $w+1/*$loop->iteration*/ }}--}}"
                                            onclick="$(this).prev('.del-url').remove(); this.remove();"
                                            class="uk-button uk-button-danger modal-del uk-text-center uk-margin-bottom uk-width-1-6">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                @empty
                                @endforelse
                            @endif
                            <div id="divResult" class="uk-padding-remove uk-margin-remove uk-width-1-1 uk-grid add_url">

                            </div>
                            <div class="uk-width-1-1 uk-padding-remove">
                                <a class="uk-button uk-button-default uk-button-small uk-margin-top btn_add_url"
                                   id="add_url">
                                    Добавить url
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
        var i = "{{ count($review->url) }}";

        $(".btn_add_url").click(function () {
            $('<div class="uk-width-1-1 uk-grid uk-margin-top"><div class="uk-grid uk-padding-remove uk-margin-remove uk-width-5-6">' +
                    '<select class="uk-select uk-width-1-3@m" name="sel_url[]">' +
                    @foreach($urls as $url)
                            '<option value="{{ $url }}">{{ $url }}</option>' +
                    @endforeach
                            '</select>' +
                    '<input class="uk-input uk-width-expand@m" name="url[]" type="text"></div>' +
                    '<button id="box_' + i + '" onclick="$(this).prev().remove(); this.remove();" class="uk-button uk-button-danger modal-del uk-text-center uk-width-1-6">' +
                    '<i class="fa fa-trash-o"></i></button></div>'
            ).appendTo('.add_url');
            i++;
        });

    });
</script>
@endpush
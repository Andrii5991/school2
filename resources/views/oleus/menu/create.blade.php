@extends('oleus.layouts.admin')
@inject('blocks', 'App\Block')

@section('content')
    <div class="uk-container">
        <h3 class="uk-card-title">Створення меню</h3>
        <div class="uk-card uk-card-default">
            <form method="post" id="type_form" action="{{ route('menu.store') }}">
                {{ csrf_field() }}
            <div class="uk-card-header">
                <button class="uk-button btn-save uk-margin-top pull-right" type="submit">Зберегти</button>
            </div>
            <div class="uk-card-body">
                <div class="uk-margin">
                    <label class="uk-form-label">Заголовок*
                        @if(Session::has('t'))<label style="color: red"> це поле обов'язкове</label>
                        @endif</label>
                    <div class="uk-form-controls">
                        <input id="title" name="title"  type="text" class="uk-input" placeholder="Title" value="{{ old('title') }}">
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label">Блок*
                        @if(Session::has('b'))<label style="color: red"> це поле обов'язкове</label>
                        @endif</label>
                    <div class="uk-form-controls">
                        <select id="block" name="block" class="uk-select">
                            <option value="error">
                                @if($blocks->active()->count() > 0) Виберіть блок
                                @else У Вас немає активних блоків @endif
                            </option>
                            <option value="-1">Переваги</option>
                            <option value="-2">Відгуки</option>
                            @foreach($blocks->active()->get() as $block)
                                @if($block->bundle == 'static_text' || $block->bundle == 'blocks')
                                    <option value="{{ $block->id }}">{!! $block->title !!}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="uk-margin" id="div-class">
                    <label class="uk-form-label">Метка*
                        @if(Session::has('m'))<label style="color: red"> це поле обов'язкове</label>
                        @endif</label>
                    <div class="uk-form-controls">
                        <input id="class" name="class" type="text" class="uk-input" placeholder="class для пункта меню" value="{{ old('class') }}">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label">Опубліковано на сайті:</label>
                    <input class="uk-checkbox checkbox_status" type="checkbox" name="status"
                           value="1">
                </div>
            </div>
            </form>
        </div>
    </div>
                   {{-- <div class="uk-margin">
                        <label class="uk-form-label">Ключ</label>
                        <div class="uk-form-controls">
                            <input type="text" class="uk-input" placeholder="#id">
                        </div>
                    </div> --}}
                    {{--<div class="uk-margin">
                        <label class="uk-form-label">Sort</label>
                        <div class="uk-form-controls">
                            <input id="sort" name="sort" type="text" class="uk-input" placeholder="sort">
                        </div>
                    </div>--}}
@endsection
@push('scripts')
<script>
    var nowSelect = $('#block').val();
    if(nowSelect == -1 || nowSelect == -2) {
        $('#div-class').css('display', 'none');
        $('#class').val((nowSelect == -1) ? 'advantages' : 'reviews');
    }else $('#div-class').css('display', 'block');

    $("select").change(function () {
        var block = $('#block').val();
        if(block == -1 || block == -2)  {
            $('#div-class').css('display', 'none');
            $('#class').val((block == -1) ? 'advantages' : 'reviews');
        }else $('#div-class').css('display', 'block');
    });
</script>
@endpush
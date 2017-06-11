@extends('oleus.layouts.admin')
@inject('blocks', 'App\Block')

@section('content')
<div class="uk-container">
    <h3 class="uk-card-title">Створення меню  {{ $menu->title }}</h3>
    <div class="uk-card uk-card-default">
        <form method="post" id="type_form" action="{{ route('menu.update', $menu) }}">
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
                    <input id="title" name="title" type="text" class="uk-input" value="{{ $menu->title}}">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Блок</label>
                <div class="uk-form-controls">
                    <select id="block" name="block" class="uk-select">
                        <option value="-1" @if($menu->block == -1) selected @endif>Переваги</option>
                        <option value="-2" @if($menu->block == -2) selected @endif>Відгуки</option>
                        @if(!is_null($block))
                            <option value="{{ $block->id }}">{!!  $block->title !!}@endif</option>
                        @foreach($blocks->active()->get() as $block)
                            @if($block->bundle == 'static_text' || $block->bundle == 'blocks')
                                <option value="{{ $block->id }}">{!! $block->title !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="uk-margin" id="div-class">
                <label class="uk-form-label">Мітка*
                    @if(Session::has('m'))<label style="color: red"> це поле обов'язкове</label>
                    @endif</label>
                <div class="uk-form-controls">
                    <input id="class" name="class" type="text" class="uk-input" value="{{ $menu->class}}">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label uk-margin-right">Опубліковано на сайті</label>
                <input class="uk-checkbox checkbox_status" type="checkbox" name="status"
                       @if($menu->status) checked @endif value="1">
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
            </div>--}}
            {{--<div class="uk-margin">
                <label class="uk-form-label">Sort</label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" placeholder="sort">
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
        }else {
            $('#div-class').css('display', 'block');
            $('#class').val('');
        }
    });
</script>
@endpush
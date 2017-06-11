@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container">
        <div class="uk-card uk-card-default">
            <div class="uk-card-header">
                <h3 class="uk-card-title uk-text-center uk-text-danger">Новини {!! $block->title !!}</h3>
            </div>
            <div class="uk-card-body">
                <dl class="uk-description-list uk-description-list-divider">
                    {{--@if(isset($cookie))
                        <dd>{{ $cookie }}</dd>
                    @endif--}}
                    <dt>Тип Новини:</dt>
                    <dd>{{ $bundle }}</dd>

                    <dt>Підзаголовок:</dt>
                    <dd>{!! $block->sub_title !!}</dd>

                    <dt>Опис:</dt>
                    <dd>{{ $block->body }}</dd>

                    @if(isset($image))
                        <dt>Изображение: #{{ $block->image }} </dt>
                        <dd><img src="/storage/files/{{ $image->filename }}"></dd>
                    @endif

                    @if(isset($background))
                        <dt>Фон: #{{ $block->background }} </dt>
                        <dd><img src="/storage/files/{{ $background->filename }}"></dd>
                    @else
                        <input type="color" name="color" onchange="clickColor(0, -1, -1, 5)" value="{{ $block->color }}"
                               style="padding: 0; margin: 0; background: transparent; border: 0; height: 100px; width: 100px;">
                    @endif
                    <dt>Місцезнаходження ображення:</dt>
                    <dd>{{ $location }}</dd>

                    <dt>Налаштування:</dt>
                    <dd>{{ $block->setting }}</dd>

                    <dt>Сортування:</dt>
                    <dd>{{ $block->sort }}</dd>

                    <dt>Статус:</dt>
                    <dd>{{ $block->status ? 'Опубліковано' : 'Не опубліковано' }}</dd>
                </dl>
            </div>
        </div>
    </div>
@endsection
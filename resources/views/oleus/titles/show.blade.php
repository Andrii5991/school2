@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container">
        <div class="uk-card uk-card-default">
            <div class="uk-card-header">
                <h3 class="uk-card-title" style="display: -webkit-inline-box;">Заголовок: {!! $title->title !!}</h3>
            </div>
            <div class="uk-card-body">
                <dl class="uk-description-list uk-description-list-divider">
                    <dt>#id</dt>
                    <dd>{{ $title->id }}</dd>

                    <dt>Заголовок</dt>
                    <dd>{!! $title->title !!}</dd>

                    <dt>Подзаголовок</dt>
                    <dd>{!! $title->sub_title !!}</dd>

                    <dt>Логотип</dt>
                    <dd>
                        @if(isset($logo))
                            <img src="/storage/files/{{ $logo->filename }}">
                        @endif
                    </dd>

                    <dt>Изображение</dt>
                    <dd>
                        @if(isset($image))
                            <img src="/storage/files/{{ $image->filename }}">
                        @endif
                    </dd>

                    <dt>UTM-content</dt>
                    <dd>{{ $title->utm }}</dd>

                    <dt>HTML текст</dt>
                    <dd>{!! $title->text !!}</dd>

                    <dt>Форма</dt>
                    <dd>{{ $title->form }}</dd>

                    <dt>Телефон</dt>
                    @foreach($phones as $num => $phone)
                        <dd>{{ $phone }}</dd>
                    @endforeach

                    <dt>Видео</dt>
                    <dd>{{ $title->video }}</dd>

                    <dt>По умолчанию</dt>
                    <dd>{{ $title->default }}</dd>

                    <dt>Шаблон вывода данных</dt>
                    <dd>
                        <div class="uk-margin uk-flex-center checktemp" uk-grid>
                            <img class="uk-thumbnail" src="{{ asset("$template_image") }}" alt="{{ $template_image }}">
                        </div>
                    </dd>

                    <dt>Просмотры</dt>
                    <dd>{{ $title->views }}</dd>

                    <dt>Лиды</dt>
                    <dd>{{ $title->lead }}</dd>

                    <dt>Конверсия</dt>
                    <dd>{{ $title->conversion }}</dd>

                    <dt>Порядок</dt>
                    <dd>{{ $title->sort }}</dd>

                    <dt>Опубликовано</dt>
                    <dd>{{ $title->status ? 'Да' : 'Нет' }}</dd>
                </dl>
            </div>

        </div>
    </div>
@endsection
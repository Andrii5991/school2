@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container">

        <h1>Заголовки</h1>

        <div class="uk-card uk-card-default uk-width-1-1@m">
            <div class="uk-card-header uk-text-right">
                <a class="uk-button btn-create" href="{{ route('title.create') }}">Создать</a>
                <button class="uk-button btn-save" id="sort_btn" type="submit" value='SAVE'>Сохранить</button>
            </div>
            <div class="uk-card-body">


                <div class="item-table-border-title" uk-grid>
                    <div class="uk-width-1-6@m">id</div>
                    <div class="uk-width-1-6@m">Заголовок</div>
                    <div class="uk-width-1-6@m">Подзаголовок</div>
                    <div class="uk-width-expand@m">UTM</div>
                    <div></div>
                </div>

                <div class="uk-margin check" id="title" uk-sortable>
                    @forelse($titles as $title)

                        <div class="item-table-border sortable" id="{{$title->id}}"
                             uk-grid>

                            <div class="uk-width-1-6@m">
                                <input class="uk-checkbox checkbox_status" type="checkbox"
                                       @if($title->status) checked @endif data-check="{{ $title->id }}"
                                       name="status-{{ $title->id }}">
                                #{{ $title->id }}
                            </div>

                            <div class="uk-width-1-6@m">{{ strip_tags($title->title) }}</div>

                            <div class="uk-width-1-6@m">{{ strip_tags($title->sub_title) }}</div>

                            <div class="uk-width-expand@m">{{ $title->utm }}</div>

                            <div class="uk-width-1-6@m">
                                <div>
                                    <a href="{{ route('title.show', $title) }}"
                                       class="uk-button btn-show uk-button-small">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a href="{{ route('title.edit', $title) }}"
                                       class="uk-button btn-edit uk-button-small">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>

                                    <a href="{{ route('title.destroy', $title) }}"
                                       class="uk-button btn-trash uk-button-small modal-del"
                                       data-confirm="Вы уверены?">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="uk-alert-danger" uk-alert>
                            <a class="uk-alert-close" uk-close></a>
                            <p>У вас нет Заголовков</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>

    </div>































    {{--<div class="uk-container">--}}
        {{--@if($titles->count() < 3)--}}
            {{--<a class="uk-button uk-button-secondary uk-margin-bottom pull-left" href="{{ route('title.create') }}">--}}
                {{--Создать заголовок <i class="fa fa-plus-square"></i>--}}
            {{--</a>--}}
        {{--@endif--}}

        {{--<button class="uk-button uk-button-primary uk-margin-right uk-margin-bottom pull-right"--}}
                {{--id="sort_btn" type="submit" value='SAVE'>--}}
            {{--<i class="fa fa-floppy-o"></i>--}}
        {{--</button>--}}
    {{--</div>--}}

    {{--<div class="uk-container">--}}
        {{--<div class="uk-child-width-expand uk-card top-title-table" uk-grid>--}}
            {{--<div class="uk-width-1-6@m">id</div>--}}
            {{--<div class="uk-width-1-6@m">Заголовок</div>--}}
            {{--<div class="uk-width-1-6@m">Подзаголовок</div>--}}
            {{--<div class="uk-width-expand@m">UTM</div>--}}
            {{--<div class="uk-width-1-6">Изображение</div>--}}
            {{--<div>Форма</div>--}}
            {{--<div>Activity</div>--}}
        {{--</div>--}}

        {{--<div class="uk-margin check" id="title" uk-sortable>--}}
            {{--@foreach($titles as $title)--}}
                {{--block--}}
                {{--<div class="uk-child-width-expand uk-card uk-card-default uk-card-body sortable" id="{{$title->id}}"--}}
                     {{--uk-grid>--}}

                    {{--<div class="uk-width-1-6@m">--}}
                        {{--<input class="uk-checkbox checkbox_status" type="checkbox"--}}
                               {{--@if($title->status) checked @endif data-check="{{ $title->id }}"--}}
                               {{--name="status-{{ $title->id }}">--}}
                        {{--#{{ $title->id }}--}}
                    {{--</div>--}}

                    {{--<div class="uk-width-1-6@m">{!! $title->title !!}</div>--}}

                    {{--<div class="uk-width-1-6@m">{!! $title->sub_title !!}</div>--}}

                    {{--<div class="uk-width-expand@m">{{ $title->utm }}</div>--}}
                    {{--<div class="table-img"><img src="{{ $title->templates }}" alt="LOL"></div>--}}

                    {{--<div>{{ $title->form }}</div>--}}

                    {{--<div class="uk-width-1-6@m">--}}
                        {{--<div>--}}
                            {{--<a href="{{ route('title.show', $title) }}"--}}
                               {{--class="uk-button uk-button-default uk-button-small">--}}
                                {{--<i class="fa fa-eye"></i>--}}
                            {{--</a>--}}

                            {{--<a href="{{ route('title.edit', $title) }}"--}}
                               {{--class="uk-button uk-button-primary uk-button-small">--}}
                                {{--<i class="fa fa-pencil-square-o"></i>--}}
                            {{--</a>--}}

                            {{--<a href="{{ route('title.destroy', $title) }}"--}}
                               {{--class="uk-button uk-button-danger uk-button-small modal-del"--}}
                               {{--data-confirm="Вы уверены?">--}}
                                {{--<i class="fa fa-trash-o"></i>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--block//--}}
                {{--block--}}


                {{--block//--}}
            {{--@endforeach--}}
        {{--</div>--}}


        {{--<div class="uk-margin" uk-sortable>--}}
        {{--@foreach($titles as $title)--}}

        {{--<div class="uk-card uk-card-default uk-card-body" uk-grid>--}}

        {{--<div class="uk-width-1-6@m">--}}
        {{--<div>--}}
        {{--<form class="uk-display-inline uk-margin-right">--}}
        {{--<input class="uk-checkbox checkbox_status" type="checkbox"--}}
        {{--@if($title->status) checked @endif>--}}
        {{--</form>--}}
        {{--# {{ $title->id }}--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="uk-width-expand@m">--}}
        {{--<div>--}}
        {{--{{ $title->templates}}--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="uk-width-1-6@m">--}}
        {{--<div>--}}
        {{--<a href="{{ route('title.show', $title) }}"--}}
        {{--class="uk-button uk-button-default uk-button-small"><i--}}
        {{--class="fa fa-eye"></i></a>--}}
        {{--<a href="{{ route('title.edit', $title) }}"--}}
        {{--class="uk-button uk-button-primary uk-button-small"><i--}}
        {{--class="fa fa-pencil-square-o"></i></a>--}}
        {{--<a href="{{ route('title.destroy', $title) }}"--}}
        {{--class="uk-button uk-button-danger uk-button-small modal-del"><i--}}
        {{--class="fa fa-trash-o"></i></a>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}

        {{--@endforeach--}}
        {{--</div>--}}
    </div>
@endsection
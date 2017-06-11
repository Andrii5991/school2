@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container">

        <h1>Створення меню</h1>

        <div class="uk-card uk-card-default uk-width-1-1@m">
            <div class="uk-card-header uk-text-right">
                <a class="uk-button btn-create" href="{{ route('menu.create') }}">Створити</a>
                <button class="uk-button btn-save" id="sort_btn" type="submit" value='SAVE'>Зберегти</button>
            </div>
            <div class="uk-card-body">

                <div class="item-table-border-title uk-child-width-1-6@m" uk-grid>
                    <div>№</div>
                    <div>Заголовок</div>
                    <div>Мітка</div>
                    <div>Статус</div>
                    <div>#id</div>
                    <div></div>
                </div>


                <div uk-sortable="group: sortable-group" class="check" id="menu">
                    @forelse($menu as $num => $item)
                        <div class="uk-margin sortable" id="{{$item->id}}">
                            <div class="item-table-border uk-child-width-1-6@m" uk-grid>
                                <div>{{ $num+1 }}</div>
                                <div>{{ $item->title }}</div>
                                <div>{{ $item->class }}</div>
                                <div><input class="uk-checkbox checkbox_status" type="checkbox"
                                            @if($item->status) checked @endif></div>
                                <div>#{{ $item->id }}</div>
                                <div>
                                    <a href="{{ route('menu.edit', $item) }}"
                                       class="uk-button btn-edit uk-button-small"><i
                                                class="fa fa-pencil-square-o"></i></a>
                                    <a href="{{ route('menu.destroy', $item) }}"
                                       class="uk-button btn-trash uk-button-small modal-del"><i
                                                class="fa fa-trash-o"></i></a>
                                </div>

                                {{--<div class="uk-width-2-3">--}}
                                {{--<form class="uk-display-inline uk-margin-right">--}}
                                {{--<input class="uk-checkbox checkbox_status" type="checkbox"--}}
                                {{--@if($item->status) checked @endif>--}}
                                {{--</form>--}}
                                {{--#{{ $item->id }}--}}
                                {{--{{ $item->title }}--}}
                                {{--</div>--}}
                                {{--<div class="uk-width-1-3">--}}
                                {{--<a href="{{ route('menu.edit', $item) }}" class="uk-button"><i--}}
                                {{--class="fa fa-pencil-square-o"></i></a>--}}
                                {{--<a href="{{ route('menu.destroy', $item) }}" class="modal-del"><i class="fa fa-trash-o"></i></a>--}}
                                {{--</div>--}}

                            </div>
                        </div>

                    @empty
                        <div class="uk-alert-danger" uk-alert>
                            <a class="uk-alert-close" uk-close></a>
                            <p>У вас немає Меню</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>

    </div>


















    {{--<div class="uk-container">--}}
        {{--<a class="uk-button uk-button-secondary uk-margin-bottom pull-left" href="{{ route('menu.create') }}">Создать новый пункт меню</a>--}}
        {{--<button class="uk-button uk-button-primary uk-margin-right uk-margin-bottom pull-right"--}}
                {{--id="sort_btn" type="submit" value='SAVE'>--}}
            {{--<i class="fa fa-floppy-o"></i>--}}
        {{--</button>--}}
    {{--</div>--}}


    {{--<div class="uk-container">--}}
        {{--<h3 class="uk-text-center uk-text-danger">Создание меню</h3>--}}

        {{--<div class="uk-card uk-card-default uk-card-body top-title-table uk-margin uk-child-width-1-6@m" uk-grid>--}}
            {{--<div>№</div>--}}
            {{--<div>Заголовок</div>--}}
            {{--<div>Метка</div>--}}
            {{--<div>Статус</div>--}}
            {{--<div>#id</div>--}}
            {{--<div>Активность</div>--}}
        {{--</div>--}}

                {{--<div uk-sortable="group: sortable-group" class="check" id="menu">--}}
            {{--@foreach($menu as $num => $item)--}}
                    {{--<div class="uk-margin sortable" id="{{$item->id}}">--}}
                        {{--<div class="uk-card uk-card-default uk-card-body uk-card-small uk-child-width-1-6@m" uk-grid>--}}
                            {{--<div>{{ $num+1 }}</div>--}}
                            {{--<div>{{ $item->title }}</div>--}}
                            {{--<div>Метка</div>--}}
                            {{--<div><input class="uk-checkbox checkbox_status" type="checkbox"--}}
                                        {{--@if($item->status) checked @endif></div>--}}
                            {{--<div>#{{ $item->id }}</div>--}}
                            {{--<div>--}}
                                {{--<a href="{{ route('menu.edit', $item) }}" class="uk-button"><i--}}
                                {{--class="fa fa-pencil-square-o"></i></a>--}}
                                {{--<a href="{{ route('menu.destroy', $item) }}" class="modal-del"><i class="fa fa-trash-o"></i></a>--}}
                            {{--</div>--}}

                            {{--<div class="uk-width-2-3">--}}
                                {{--<form class="uk-display-inline uk-margin-right">--}}
                                    {{--<input class="uk-checkbox checkbox_status" type="checkbox"--}}
                                           {{--@if($item->status) checked @endif>--}}
                                {{--</form>--}}
                                {{--#{{ $item->id }}--}}
                                {{--{{ $item->title }}--}}
                            {{--</div>--}}
                            {{--<div class="uk-width-1-3">--}}
                                {{--<a href="{{ route('menu.edit', $item) }}" class="uk-button"><i--}}
                                            {{--class="fa fa-pencil-square-o"></i></a>--}}
                                {{--<a href="{{ route('menu.destroy', $item) }}" class="modal-del"><i class="fa fa-trash-o"></i></a>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}

            {{--@endforeach--}}
                {{--</div>--}}

    {{--</div>--}}
@endsection()
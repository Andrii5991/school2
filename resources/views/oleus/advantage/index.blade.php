@extends('oleus.layouts.admin')

@section('content')

    <div class="uk-container">

        <h1>Викладачі</h1>
        <div class="uk-card uk-card-default uk-width-1-1@m">
            <div class="uk-card-header uk-text-right">
                <a href="{{ route('advantage.create') }}" class="uk-button btn-create">Створити</a>
                <button class="uk-button btn-save" id="sort_btn" type="submit" value='SAVE'>Зберегти</button>
            </div>
            <div class="uk-card-body">

                <div class="item-table-border-title" uk-grid>
                    <div class="uk-width-1-6">#id</div>
                    <div class="uk-width-1-6">Заголовок</div>
                    <div class="uk-width-1-6">Зображення</div>
                    <div class="uk-width-1-6">Підзаголовок</div>
                    <div class="uk-width-1-6">Сортування</div>
                </div>


                <div class="check" id="advantage" uk-sortable>

                    @forelse($advantages as $advantage)
                        <div class="item-table-border sortable" id="{{$advantage->id}}" uk-grid>
                            <div class="uk-width-1-6">
                                <input class="uk-checkbox checkbox_status"
                                       type="checkbox"
                                       @if($advantage->status) checked @endif
                                       data-check="{{ $advantage->id }}"
                                       name="status-{{ $advantage->id }}">
                                #{{ $advantage->id }}
                            </div>

                            <div class="uk-width-1-6">
                                {{ strip_tags($advantage->title) }}
                            </div>

                            <div class="uk-width-1-6">
                                @if(!is_null($advantage->image))
                                    <img class="img-fix-size"
                                         src="/storage/files/{{ App\Files::find($advantage->image)->filename }}">
                                @endif
                            </div>

                            <div class="uk-width-1-6">
                                {{ strip_tags($advantage->sub_title) }}
                            </div>

                            <div class="uk-width-1-6">
                                {{ $advantage->sort+1 }}
                            </div>

                            <div class="uk-width-1-6">
                                <div class="pull-right">
                                    <a href="{{ route('advantage.edit', $advantage) }}"
                                       class="uk-button btn-edit uk-button-small">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    <a href="{{ route('advantage.destroy', $advantage) }}"
                                       class="uk-button btn-trash uk-button-small modal-del"
                                       data-confirm="Ви впевнені?">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="uk-alert-danger" uk-alert>
                            <a class="uk-alert-close" uk-close></a>
                            <p>Відсутні записи</p>
                        </div>
                    @endforelse

                </div>


                {{--<table class="uk-table">--}}
                {{--<thead>--}}
                {{--<tr>--}}
                {{--<th class="uk-table-shrink"></th>--}}
                {{--<th class="uk-table-shrink">#id</th>--}}
                {{--<th class="uk-table-expand">Заголовок</th>--}}
                {{--<th class="uk-width-small">Изображение</th>--}}
                {{--<th>Подзаголовок</th>--}}
                {{--<th class="uk-table-expand"></th>--}}
                {{--</tr>--}}
                {{--</thead>--}}
                {{--<tbody uk-sortable>--}}
                {{--<tr>--}}
                {{--<td>--}}
                {{--<input class="uk-checkbox checkbox_status" type="checkbox" checked>--}}
                {{--</td>--}}
                {{--<td>--}}
                {{--1--}}
                {{--</td>--}}
                {{--<td>Lorem ipsum</td>--}}
                {{--<td><img class="img-fix-size" src="{{asset ('/img/ava.png')}}" alt=""></td>--}}
                {{--<td>Lorem ipsum</td>--}}
                {{--<td class="uk-text-right">--}}
                {{--@if($block->bundle == 'blocks')--}}
                {{--<a href="--}}{{--{{ route('block.edit', $block) }}--}}{{--"--}}
                {{--class="uk-button btn-edit uk-button-small">--}}
                {{--<i class="fa fa-pencil-square-o"></i>--}}
                {{--</a>--}}
                {{--<a href="--}}{{--{{ route('block.destroy', $block) }}--}}{{--"--}}
                {{--class="uk-button btn-trash uk-button-small modal-del"--}}
                {{--data-confirm="Вы уверены?">--}}
                {{--<i class="fa fa-trash-o"></i>--}}
                {{--</a>--}}
                {{--</td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                {{--<td>--}}
                {{--<input class="uk-checkbox checkbox_status" type="checkbox" checked>--}}
                {{--</td>--}}
                {{--<td>--}}
                {{--1--}}
                {{--</td>--}}
                {{--<td>Lorem ipsum</td>--}}
                {{--<td><img class="img-fix-size" src="{{asset ('/img/ava.png')}}" alt=""></td>--}}
                {{--<td>Lorem ipsum</td>--}}
                {{--<td class="uk-text-right">--}}
                {{--@if($block->bundle == 'blocks')--}}
                {{--<a href="--}}{{--{{ route('block.edit', $block) }}--}}{{--"--}}
                {{--class="uk-button btn-edit uk-button-small">--}}
                {{--<i class="fa fa-pencil-square-o"></i>--}}
                {{--</a>--}}
                {{--<a href="--}}{{--{{ route('block.destroy', $block) }}--}}{{--"--}}
                {{--class="uk-button btn-trash uk-button-small modal-del"--}}
                {{--data-confirm="Вы уверены?">--}}
                {{--<i class="fa fa-trash-o"></i>--}}
                {{--</a>--}}
                {{--</td>--}}
                {{--</tr>--}}
                {{--</tbody>--}}
                {{--</table>--}}

            </div>
        </div>

    </div>









    {{--<div class="uk-container">--}}
    {{--<a class="uk-button uk-button-secondary uk-margin-left uk-margin-bottom" href="{{ route('advantage.create') }}">--}}
    {{--Создать <i class="fa fa-plus-square"></i>--}}
    {{--</a>--}}
    {{--<button class="uk-button uk-button-primary uk-margin-right uk-margin-bottom pull-right"--}}
    {{--id="sort_btn" type="submit" value='SAVE'>--}}
    {{--<i class="fa fa-floppy-o"></i>--}}
    {{--</button>--}}
    {{--</div>--}}

    {{--<div class="uk-container">--}}
    {{--<div class="uk-card uk-card-default uk-card-body top-title-table" uk-grid>--}}
    {{--<div class="uk-width-1-6">#id</div>--}}
    {{--<div class="uk-width-1-6">Заголовок</div>--}}
    {{--<div class="uk-width-1-6">Изображение</div>--}}
    {{--<div class="uk-width-1-6">Подзаголовок</div>--}}
    {{--<div class="uk-width-1-6">Сортировка</div>--}}
    {{--</div>--}}

    {{--<div class="uk-margin check" id="advantage" uk-sortable>--}}

    {{--@foreach($advantages as $advantage)--}}
    {{--<div class="uk-card uk-card-default uk-card-body sortable" id="{{$advantage->id}}" uk-grid>--}}
    {{--<div class="uk-width-1-6">--}}
    {{--<input class="uk-checkbox checkbox_status"--}}
    {{--type="checkbox"--}}
    {{--@if($advantage->status) checked @endif--}}
    {{--data-check="{{ $advantage->id }}"--}}
    {{--name="status-{{ $advantage->id }}">--}}
    {{--#{{ $advantage->id }}--}}
    {{--</div>--}}

    {{--<div class="uk-width-1-6">--}}
    {{--{!! $advantage->title !!}--}}
    {{--</div>--}}

    {{--<div class="uk-width-1-6">--}}
    {{--@if(!is_null($advantage->image))--}}
    {{--<img src="/storage1/files/{{ App\Files::find($advantage->image)->filename }}">--}}
    {{--@endif--}}
    {{--</div>--}}

    {{--<div class="uk-width-1-6">--}}
    {{--{!! $advantage->sub_title !!}--}}
    {{--</div>--}}

    {{--<div class="uk-width-1-6">--}}
    {{--{{ $advantage->sort }}--}}
    {{--</div>--}}

    {{--<div class="uk-width-1-6">--}}
    {{--<div class="pull-right">--}}
    {{--<a href="{{ route('advantage.edit', $advantage) }}"--}}
    {{--class="uk-button uk-button-primary uk-button-small">--}}
    {{--<i class="fa fa-pencil-square-o"></i>--}}
    {{--</a>--}}
    {{--<a href="{{ route('advantage.destroy', $advantage) }}"--}}
    {{--class="uk-button uk-button-danger uk-button-small modal-del"--}}
    {{--data-confirm="Вы уверены?">--}}
    {{--<i class="fa fa-trash-o"></i>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@endforeach--}}

    {{--</div>--}}
    {{--</div>--}}
@endsection

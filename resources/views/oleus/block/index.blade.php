@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container">

        <h1>Новини</h1>

        <div class="uk-card uk-card-default uk-width-1-1@m">
            <div class="uk-card-header uk-text-right">
                <a class="uk-button btn-create" href="{{ route('block.create') }}">Створити</a>
                <button class="uk-button btn-save" id="sort_btn" type="submit" value='SAVE'>Зберегти</button>
            </div>
            <div class="uk-card-body">
                <div class="item-table-border-title" uk-grid>
                    <div class="uk-width-1-6@m">#id</div>
                    <div class="uk-width-expand@m">Заголовок</div>
                    <div class="uk-width-1-6@m"></div>
                </div>


                <div class="uk-margin check" id="block" uk-sortable>
                    @forelse($blocks as $block)
                        <div class="item-table-border sortable" id="{{$block->id}}" uk-grid>
                            <div class="uk-width-1-6@m">
                                <div>
                                    <input class="uk-checkbox checkbox_status" type="checkbox"
                                           @if($block->status) checked @endif data-check="{{ $block->id }}"
                                           name="status-{{ $block->id }}">
                                    #{{ $block->id }}
                                </div>
                            </div>

                            <div class="uk-width-expand@m">
                                <div>
                                    {!! $block->title !!}
                                </div>
                            </div>

                            <div class="uk-width-1-6@m">
                                <div>
                                    <a href="{{ route('block.show', $block) }}"
                                       class="uk-button btn-show uk-button-small"><i
                                                class="fa fa-eye"></i></a>
                                    @if($block->bundle == 'blocks')
                                        <a href="{{ route('block.edit', $block) }}"
                                           class="uk-button btn-edit uk-button-small">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <a href="{{ route('block.destroy', $block) }}"
                                           class="uk-button btn-trash uk-button-small modal-del"
                                           data-confirm="Ви впевнені?">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                            <div class="uk-alert-danger" uk-alert>
                                <a class="uk-alert-close" uk-close></a>
                                <p>У вас немає новин</p>
                            </div>
                        @endforelse
                </div>
            </div>
        </div>

    </div>






    {{--<div class="uk-container">--}}
    {{--<a class="uk-button uk-button-secondary uk-margin-bottom pull-left" href="{{ route('block.create') }}">--}}
    {{--Создать 'Блок' <i class="fa fa-plus-square"></i>--}}
    {{--</a>--}}

    {{--<button class="uk-button uk-button-primary uk-margin-right uk-margin-bottom pull-right"--}}
    {{--id="sort_btn" type="submit" value='SAVE'>--}}
    {{--<i class="fa fa-floppy-o"></i>--}}
    {{--</button>--}}
    {{--</div>--}}
    {{--<div class="uk-container">--}}
    {{--<div class="uk-card uk-card-default uk-card-body top-title-table uk-margin-bottom" uk-grid>--}}
    {{--<div class="uk-width-1-6@m">#id</div>--}}
    {{--<div class="uk-width-expand@m">Контент</div>--}}
    {{--<div class="uk-width-1-6@m"></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="uk-container">--}}
    {{--<div class="uk-margin check" id="block" uk-sortable>--}}
    {{--@foreach($blocks as $block)--}}
    {{--<div class="uk-card uk-card-default uk-card-body sortable" id="{{$block->id}}" uk-grid>--}}
    {{--<div class="uk-width-1-6@m">--}}
    {{--<div>--}}
    {{--<input class="uk-checkbox checkbox_status" type="checkbox"--}}
    {{--@if($block->status) checked @endif data-check="{{ $block->id }}"--}}
    {{--name="status-{{ $block->id }}">--}}
    {{--#{{ $block->id }}--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="uk-width-expand@m">--}}
    {{--<div>--}}
    {{--{!! $block->body !!}--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="uk-width-1-6@m">--}}
    {{--<div>--}}
    {{--<a href="{{ route('block.show', $block) }}"--}}
    {{--class="uk-button uk-button-default uk-button-small"><i--}}
    {{--class="fa fa-eye"></i></a>--}}
    {{--@if($block->bundle == 'blocks')--}}
    {{--<a href="{{ route('block.edit', $block) }}"--}}
    {{--class="uk-button uk-button-primary uk-button-small">--}}
    {{--<i class="fa fa-pencil-square-o"></i>--}}
    {{--</a>--}}
    {{--<a href="{{ route('block.destroy', $block) }}"--}}
    {{--class="uk-button uk-button-danger uk-button-small modal-del"--}}
    {{--data-confirm="Вы уверены?">--}}
    {{--<i class="fa fa-trash-o"></i>--}}
    {{--</a>--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@endforeach--}}
    {{--</div>--}}
    {{--</div>--}}
@endsection



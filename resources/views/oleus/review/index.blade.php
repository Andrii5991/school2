@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container">

        <h1>Отзывы</h1>

        <div class="uk-card uk-card-default uk-width-1-1@m">
            <div class="uk-card-header uk-text-right">
                <a class="uk-button btn-create" href="{{ route('review.create') }}">Створити</a>
                <button class="uk-button btn-save" id="sort_btn" type="submit" value='SAVE'>Зберегти</button>
            </div>
            <div class="uk-card-body">


                <div class="item-table-border-title" uk-grid>
                    <div class="uk-width-1-6@m">#id</div>
                    <div class="uk-width-expand@m">Імя</div>
                    <div class="uk-width-expand@m">Заголовок</div>
                    {{--<div class="uk-width-expand@m">Текст</div>--}}
                    <div class="uk-width-1-6@m"></div>
                </div>


                <div class="check" id="review" uk-sortable>

                    @forelse($reviews as $review)

                        <div class="item-table-border sortable" id="{{$review->id}}" uk-grid>
                            <div class="uk-width-1-6@m">
                                <input class="uk-checkbox checkbox_status" type="checkbox"
                                       @if($review->status) checked @endif data-check="{{ $review->id }}"
                                       name="status-{{ $review->id }}">
                                #{{ $review->id }}
                            </div>

                            <div class="uk-width-expand@m">
                                <div>{{ $review->name }}</div>
                            </div>

                            <div class="uk-width-expand@m">
                                {{ strip_tags($review->title) }}
                            </div>

                            {{--<div class="uk-width-expand@m">--}}
                                {{--{!! $review->body !!}--}}
                            {{--</div>--}}

                            <div class="uk-width-1-6@m">
                                <a href="{{ route('review.edit', $review) }}"
                                   class="uk-button btn-edit uk-button-small">
                                    <i class="fa fa-pencil-square-o"></i>
                                </a>
                                <a href="{{ route('review.destroy', $review) }}"
                                   class="uk-button btn-trash uk-button-small modal-del"
                                   data-confirm="Вы уверены?">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </div>
                        </div>

                    @empty
                        <div class="uk-alert-danger" uk-alert>
                            <a class="uk-alert-close" uk-close></a>
                            <p>У вас немає відгуків</p>
                        </div>
                    @endforelse

                </div>


            </div>
        </div>

    </div>



















    {{--<div class="uk-container">--}}
        {{--<a class="uk-button uk-button-secondary uk-margin-bottom pull-left" href="{{ route('review.create') }}">--}}
            {{--Создать <i class="fa fa-plus-square"></i>--}}
        {{--</a>--}}

        {{--<button class="uk-button uk-button-primary uk-margin-right uk-margin-bottom pull-right"--}}
                {{--id="sort_btn" type="submit" value='SAVE'>--}}
            {{--<i class="fa fa-floppy-o"></i>--}}
        {{--</button>--}}
    {{--</div>--}}

    {{--<div class="uk-container uk-margin-bottom">--}}
        {{--<div class="uk-card uk-card-default uk-card-body top-title-table" uk-grid>--}}
            {{--<div class="uk-width-1-6@m">#id</div>--}}
            {{--<div class="uk-width-expand@m">Имя</div>--}}
            {{--<div class="uk-width-expand@m">Заголовок</div>--}}
            {{--<div class="uk-width-expand@m">Текст</div>--}}
            {{--<div class="uk-width-1-6@m"></div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<div class="uk-container">--}}
        {{--<div class="uk-container check" id="review" uk-sortable>--}}

            {{--@forelse($reviews as $review)--}}

                {{--<div class="uk-card uk-card-default uk-card-body uk-card-hover sortable" id="{{$review->id}}" uk-grid>--}}
                    {{--<div class="uk-width-1-6@m">--}}
                        {{--<input class="uk-checkbox checkbox_status" type="checkbox"--}}
                               {{--@if($review->status) checked @endif data-check="{{ $review->id }}"--}}
                               {{--name="status-{{ $review->id }}">--}}
                        {{--#{{ $review->id }}--}}
                    {{--</div>--}}

                    {{--<div class="uk-width-expand@m">--}}
                        {{--<div>{{ $review->name }}</div>--}}
                    {{--</div>--}}

                    {{--<div class="uk-width-expand@m">--}}
                        {{--{!! $review->title !!}--}}
                    {{--</div>--}}

                    {{--<div class="uk-width-expand@m">--}}
                        {{--{{ $review->body }}--}}
                    {{--</div>--}}

                    {{--<div class="uk-width-1-6@m">--}}
                        {{--<a href="{{ route('review.edit', $review) }}"--}}
                           {{--class="uk-button uk-button-primary uk-button-small">--}}
                            {{--<i class="fa fa-pencil-square-o"></i>--}}
                        {{--</a>--}}
                        {{--<a href="{{ route('review.destroy', $review) }}"--}}
                           {{--class="uk-button uk-button-danger uk-button-small modal-del"--}}
                           {{--data-confirm="Вы уверены?">--}}
                            {{--<i class="fa fa-trash-o"></i>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}

            {{--@empty--}}
                {{--У вас нет Отзывов--}}
            {{--@endforelse--}}

        {{--</div>--}}
    {{--</div>--}}
@endsection
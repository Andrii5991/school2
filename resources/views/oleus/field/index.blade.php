@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container">

        <h1>ПОЛЯ</h1>

        <div class="uk-card uk-card-default uk-width-1-1@m">
            <div class="uk-card-header uk-text-right">
                <a href="{{ route('field.create') }}" class="uk-button btn-create">Створити</a>
            </div>
            <div class="uk-card-body">

                <div class="item-table-border-title" uk-grid>
                    <div class="uk-width-1-6@m">#id</div>
                    <div class="uk-width-expand@m">Заголовок</div>
                    <div class="uk-width-1-6@m"></div>
                </div>

                <div class="check" id="field">

                    @forelse($fields as $field)

                        <div class="item-table-border" uk-grid>
                            <div class="uk-width-1-6@m">
                                #{{ $field->id }}
                            </div>

                            <div class="uk-width-expand@m">
                                {{ $field->title }}
                            </div>

                            <div class="uk-width-1-6@m">
                                <a href="{{ route('field.edit', $field) }}"
                                   class="uk-button btn-edit uk-button-small">
                                    <i class="fa fa-pencil-square-o"></i>
                                </a>

                                <a href="{{ route('field.destroy', $field) }}"
                                   class="uk-button btn-trash uk-button-small modal-del" data-confirm="Вы уверены?">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </div>
                        </div>

                    @empty
                        <div class="uk-alert-danger" uk-alert>
                            <a class="uk-alert-close" uk-close></a>
                            <p>У вас немає полів</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>


















    {{--<div class="uk-container">--}}
        {{--<a class="uk-button uk-button-secondary uk-margin-bottom pull-left" href="{{ route('field.create') }}">--}}
            {{--Создать <i class="fa fa-plus-square"></i>--}}
        {{--</a>--}}
    {{--</div>--}}

    {{--<div class="uk-container uk-margin-bottom">--}}
        {{--<div class="uk-card uk-card-default uk-card-body top-title-table" uk-grid>--}}
            {{--<div class="uk-width-1-6@m">#id</div>--}}
            {{--<div class="uk-width-expand@m">Заголовок</div>--}}
            {{--<div class="uk-width-1-6@m"></div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<div class="uk-container check" id="field">--}}

        {{--@foreach($fields as $field)--}}

            {{--<div class="uk-card uk-card-default uk-card-body uk-card-hover" uk-grid>--}}
                {{--<div class="uk-width-1-6@m">--}}
                    {{--#{{ $field->id }}--}}
                {{--</div>--}}

                {{--<div class="uk-width-expand@m">--}}
                    {{--{{ $field->title }}--}}
                {{--</div>--}}

                {{--<div class="uk-width-1-6@m">--}}
                    {{--<a href="{{ route('field.edit', $field) }}"--}}
                       {{--class="uk-button uk-button-primary uk-button-small">--}}
                        {{--<i class="fa fa-pencil-square-o"></i>--}}
                    {{--</a>--}}

                    {{--<a href="{{ route('field.destroy', $field) }}" class="uk-button uk-button-danger uk-button-small modal-del" data-confirm="Вы уверены?">--}}
                        {{--<i class="fa fa-trash-o"></i>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--@endforeach--}}

    {{--</div>--}}

@endsection()
@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container">
        <h1>Форми</h1>
        <div class="uk-card uk-card-default uk-width-1-1@m">
            <div class="uk-card-header uk-text-right">
                <a class="uk-button btn-create" href="{{ route('form.create') }}">Створити</a>
            </div>
            <div class="uk-card-body">

                <div class="item-table-border-title uk-margin-remove" uk-grid>

                    <div>
                        <div class="uk-margin-left">Id</div>
                    </div>

                    <div class="uk-width-expand@m">
                        <div>Заголовок</div>
                    </div>

                    <div class="uk-width-expand@m">
                        <div>Підзаголовок</div>
                    </div>

                    <div class="uk-width-expand@m">
                        <div>Ел.пошта</div>
                    </div>

                    <div class="uk-width-1-6@m">
                        <div></div>
                    </div>

                </div>
                <div class="uk-margin check" id="block">

                    @forelse($forms as $num => $form)
                        <div class="item-table-border sortable" uk-grid>

                            <div>
                                #{{ $form->id }}
                            </div>

                            <div class="uk-width-expand@m">
                                {{ strip_tags($form->title) }}
                            </div>

                            <div class="uk-width-expand@m">
                                {{ strip_tags($form->sub_title) }}
                            </div>

                            <div class="uk-width-expand@m">
                                {{ $form->email }}
                            </div>

                            <div class="uk-width-1-6@m">
                                <div>
                                    <a href="{{ route('form.edit', $form) }}"
                                       class="uk-button btn-edit uk-button-small">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    <a href="{{ route('form.destroy', $form) }}"
                                       class="uk-button btn-trash uk-button-small modal-del"
                                       data-confirm="Вы действительно хотите удалить &quot;{{ $form->title }}&quot;?">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="uk-alert-danger" uk-alert>
                            <a class="uk-alert-close" uk-close></a>
                            <p>У вас немає Форм</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>














    {{--<div class="uk-container uk-margin-bottom">--}}
        {{--<a class="uk-button uk-button-secondary pull-left" href="{{ route('form.create') }}">--}}
            {{--Создать 'Форму' <i class="fa fa-plus-square"></i>--}}
        {{--</a>--}}

    {{--</div>--}}

    {{--<div class="uk-container">--}}
        {{--<div class="uk-card uk-card-default uk-card-body top-title-table" uk-grid>--}}

            {{--<div class="">--}}
                {{--<div class="uk-margin-left">Id</div>--}}
            {{--</div>--}}

            {{--<div class="uk-width-expand@m">--}}
                {{--<div>Заголовок</div>--}}
            {{--</div>--}}

            {{--<div class="uk-width-expand@m">--}}
                {{--<div>Подзаголовок</div>--}}
            {{--</div>--}}

            {{--<div class="uk-width-expand@m">--}}
                {{--<div>Ел.почта</div>--}}
            {{--</div>--}}

            {{--<div class="uk-width-1-6@m">--}}
                {{--<div>Активность</div>--}}
            {{--</div>--}}

        {{--</div>--}}

        {{--<div class="uk-margin check" id="block">--}}

            {{--@foreach($forms as $num => $form)--}}
                {{--<div class="uk-card uk-card-default uk-card-body" uk-grid>--}}

                    {{--<div>--}}
                        {{--#{{ $form->id }}--}}
                    {{--</div>--}}

                    {{--<div class="uk-width-expand@m">--}}
                        {{--{{ $form->title }}--}}
                    {{--</div>--}}

                    {{--<div class="uk-width-expand@m">--}}
                        {{--{{ $form->sub_title }}--}}
                    {{--</div>--}}

                    {{--<div class="uk-width-expand@m">--}}
                        {{--{{ $form->email }}--}}
                    {{--</div>--}}

                    {{--<div class="uk-width-1-6@m">--}}
                        {{--<div>--}}
                            {{--<a href="{{ route('form.edit', $form) }}"--}}
                               {{--class="uk-button uk-button-primary uk-button-small">--}}
                                {{--<i class="fa fa-pencil-square-o"></i>--}}
                            {{--</a>--}}
                            {{--<a href="{{ route('form.destroy', $form) }}"--}}
                               {{--class="uk-button uk-button-danger uk-button-small modal-del"--}}
                               {{--data-confirm="Вы действительно хотите удалить &quot;{{ $form->title }}&quot;?">--}}
                                {{--<i class="fa fa-trash-o"></i>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                {{--</div>--}}
            {{--@endforeach--}}

        {{--</div>--}}
    {{--</div>--}}
@endsection()
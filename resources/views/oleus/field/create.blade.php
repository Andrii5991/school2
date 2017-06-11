@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container">
        <h3 class="uk-text-center uk-text-danger">Создать поле</h3>
        <div class="uk-card uk-card-default">
            <form method="post" id="type_form" action="{{ route('field.store') }}">
                {{ csrf_field() }}
                <div class="uk-card-header">
                    <button class="uk-button btn-create pull-right">Создать</button>
                </div>
                <div class="uk-card-body">
                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title">Заголовок*
                            @if(Session::has('notify'))<label style="color: red"> це поле обов'язкове</label>
                            @endif</label>
                        <div class="uk-form-controls">
                            <input type="text" id="title" name="title" class="uk-input" placeholder="title"
                                   value="title{{ old('title') }}">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title">Тип</label>
                        <div class="uk-form-controls">
                            <select class="uk-select" id="type" name="type">
                                @foreach($types as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title">Налаштування</label>
                        <div class="uk-form-controls">
                            <input type="text" id="settings" name="settings" class="uk-input" placeholder="settings"
                                   value="{{ old('settings') }}">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title">Маска форми</label>
                        <div class="uk-form-controls">
                            <input type="text" id="mask" name="mask" class="uk-input" placeholder="mask"
                                   value="{{ old('mask') }}">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="status">
                            <input class="uk-checkbox checkbox_status" type="checkbox" name="required"
                                   value="1"> поле обов'язкове
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
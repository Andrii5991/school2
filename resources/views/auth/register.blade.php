@extends('layouts.app')

@section('content')
    <div class="uk-container reg-form">
        <div class="uk-card uk-card-default uk-position-center uk-width-1-2">
            <div class="uk-card-header">
                <h3 class="uk-text-success uk-h1">Реєстрація</h3>
            </div>
            <form id="form-horizontal" class="form-horizontal" role="form" method="POST"
                  action="{{ action('Auth\RegisterController@register') }}">
                {{ csrf_field() }}
            <div class="uk-card-body">
                    <div class="uk-margin">
                        <div class="uk-form-controls">
                            <input class="uk-input" id="form-stacked-text" name="name" type="text" placeholder="Логін користувача">
                            @if ($errors->has('name'))<span class="help-block" style="font-weight: 600; color: red; font-size: 0.8em">{{ $errors->first('name') }}</span>@endif
                        </div>
                    </div>
                    <div class="uk-margin">
                        <div class="uk-form-controls">
                            <input class="uk-input" id="form-stacked-text" name="email" type="email" placeholder="Email">
                            @if ($errors->has('email'))<span class="help-block" style="font-weight: 600; color: red; font-size: 0.8em">{{ $errors->first('email') }}</span>@endif
                        </div>
                    </div>
                    <div class="uk-margin">
                        <div class="uk-form-controls">
                            <input class="uk-input" id="form-stacked-text" name="password" type="password" placeholder="Пароль">
                            @if ($errors->has('password'))<span class="help-block" style="font-weight: 600; color: red; font-size: 0.8em">{{ $errors->first('password') }}</span>@endif
                        </div>
                    </div>
                    <div class="uk-margin">
                        <div class="uk-form-controls">
                            <input class="uk-input" id="form-stacked-text" name="password_confirmation" type="password" placeholder="Повтор пароля">
                            @if ($errors->has('password_confirmation'))<span class="help-block" style="font-weight: 600; color: red; font-size: 0.8em">{{ $errors->first('password_confirmation') }}</span>@endif
                        </div>
                    </div>
            </div>
            <div class="uk-card-footer">
                <div class="uk-child-width-1-2" uk-grid>
                    <div>
                        <a href="{{ url('login') }}">Вхід в панель</a>
                    </div>
                    <div>
                        <button type="submit" class="uk-button btn-login pull-right" href="{{ url('register') }}">Зареєструватися</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
@endsection

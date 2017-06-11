@extends('layouts.app')

@section('content')
<div class="uk-container login-form">
    <div class="uk-card uk-card-default uk-position-center uk-width-1-2">
        <div class="uk-card-header">
            <h3 class="uk-text-success uk-h1">Авторизуватися</h3>
        </div>
        <form id="form-horizontal" class="form-horizontal" role="form" method="POST"
              action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="uk-card-body">
                <div class="uk-margin">
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-stacked-text" name="email" type="text" placeholder="Логін">
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
                        <label for="remember">Запам'ятати мене</label><input id="remember" class="uk-checkbox"
                                                                           type="checkbox" style="margin: 0 4px;">
                    </div>
                </div>
            </div>
            <div class="uk-card-footer">
                <div class="uk-child-width-1-2" uk-grid>
                    <div>
                        <a href="{{ url('/password/reset') }}">Відновити пароль?</a>
                        <br>
                        <a href="{{ route('register') }}">Реєстрація</a>
                    </div>
                    <div>
                        <button type="submit" class="uk-button btn-login pull-right">Увійти</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

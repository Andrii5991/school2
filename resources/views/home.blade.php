@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                @if (Auth::guest())
                    <a class="navbar-brand" href="{{ route('login') }}"><span class="header-nav-right">Вхід</span></a>
                    <span class="navbar-brand">|</span>
                    <a class="navbar-brand" href="{{ url('register') }}">
                        <div class="header-nav-right">Реєстрація</div>
                    </a>
                @else
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Вихід
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endif

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

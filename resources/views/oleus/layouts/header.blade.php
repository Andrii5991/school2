{{--navigation-top--}}

<div class="uk-container navigation">
    <a href="#offcanvas" uk-toggle="target: #offcanvas-slide"><i class="fa fa-bars" aria-hidden="true"></i>MENU</a>
    {{--<i class="driver">|</i>--}}
    <a style="border-left: 2px solid #838383; padding-left: 5px; padding: 7px;" href="{{ route('home') }}"><i class="fa fa-home" aria-hidden="true"></i>НА САЙТ</a>
</div>

{{--<nav class="uk-navbar-container uk-nav" uk-navbar data-uk-sticky>--}}
    {{--<div class="uk-navbar-left">--}}
        {{--<ul class="uk-navbar-nav">--}}
            {{--<li><a href="#offcanvas" uk-toggle="target: #offcanvas-slide"><i class="fa fa-bars" aria-hidden="true"></i>MENU</a>--}}
            {{--</li>--}}
            {{--<li><a href="{{ route('home') }}"><i class="fa fa-home" aria-hidden="true"></i>НА САЙТ</a></li>--}}
        {{--</ul>--}}
    {{--</div>--}}
    {{--<div class="uk-navbar-right uk-margin-right">--}}
        {{--<ul class="uk-navbar-nav">--}}
            {{--<li>Добро пожаловать, <span class="uk-text-bold">Администратор</span></li>--}}
        {{--</ul>--}}
    {{--</div>--}}
{{--</nav>--}}
{{--navigation-left--}}
<div id="offcanvas-slide" uk-offcanvas="mode: slide; overlay: false;">
    <div class="uk-offcanvas-bar">
        <h3 class="uk-text-bold pull-left"> MENU</h3>
        <a type="button" class="uk-offcanvas-close pull-right"><i class="fa fa-times" aria-hidden="true"></i></a>
        <ul class="uk-nav uk-nav-parent-icon uk-margin-left" style="clear: both;" data-uk-nav>
            <li><a href="{{ url('/oleus') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
            <li><a href="{{ url('/oleus/block') }}"><i class="fa fa-check" aria-hidden="true"></i> Блоки</a></li>
            <li><a href="{{ url('/oleus/advantage') }}"><i class="fa fa-check" aria-hidden="true"></i> Переваги</a></li>
            <li><a href="{{ url('/oleus/lead') }}"><i class="fa fa-check" aria-hidden="true"></i> Ліди</a></li>
            <li><a href="{{ url('/oleus/statistic') }}"><i class="fa fa-check" aria-hidden="true"></i> Статистика</a></li>
            <li><a href="{{ url('/oleus/form') }}"><i class="fa fa-check" aria-hidden="true"></i> Форми</a></li>
            <li><a href="{{ url('/oleus/field') }}"><i class="fa fa-check" aria-hidden="true"></i> Поля</a></li>
            <li><a href="{{ url('/oleus/text') }}"><i class="fa fa-check" aria-hidden="true"></i> Статичний текст</a></li>
            <li><a href="{{ url('/oleus/menu') }}"><i class="fa fa-bars" aria-hidden="true"></i> Меню</a></li>
            <li><a href="{{ url('/oleus/contact') }}"><i class="fa fa-phone" aria-hidden="true"></i> Контакти</a></li>
            <li><a href="{{ url('/oleus/title') }}"><i class="fa fa-circle" aria-hidden="true"></i> Заголовки</a></li>
            <li><a href="{{ url('/oleus/review') }}"><i class="fa fa-comments" aria-hidden="true"></i> Відгуки</a></li>
            <li><a href="{{ url('/oleus/setting') }}"><i class="fa fa-cog" aria-hidden="true"></i> Налаштування</a></li>
            <li><a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                    Выход
                </a>
            </li>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <img src="{{asset ('/img/oleus.png')}}" alt="">
    </div>
</div>

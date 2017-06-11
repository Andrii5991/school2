<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/css/main.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>@if(isset($titleObj) && isset($titleObj->title)) {{ strip_tags($titleObj->title) }} @else Landing @endif</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="robots" content=""/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="theme-color" content="">
    <meta name="copyright" content="">
    <meta name="url" content="">
    <meta name="HandheldFriendly" content="True"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="csrf-token" content="">
    <link href="" rel="shortcut icon" type="image/x-icon"/>
    <link rel="stylesheet" href="/components/uikit/dist/css/uikit.min.css">
    <link rel="stylesheet" href="/components/owl.carousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="/components/owl.carousel/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="/css/lpc.css">

@if(isset($contacts['google_analytics']))
    {!! $contacts['google_analytics'] !!}
@endif
@if(isset($contacts['yandex_metrix']))
    {!! $contacts['yandex_metrix'] !!}
@endif

@stack('styles')

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>

@yield('content')

<script src="/components/jquery/dist/jquery.min.js" type="application/javascript"></script>
<script src="/components/uikit/dist/js/uikit.min.js" type="application/javascript"></script>
<script src="/components/jquery.inputmask/dist/min/inputmask/inputmask.min.js" type="application/javascript"></script>
<script src="/components/jquery.inputmask/dist/min/inputmask/jquery.inputmask.min.js" type="application/javascript"></script>
<script src="/components/owl.carousel/dist/owl.carousel.min.js" type="application/javascript"></script>
<script src="/js/lpc.js" type="application/javascript"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.11/js/uikit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>
<script src="{{ elixir('js/app.js') }}"></script>
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>


<script>
    jQuery(function () {
        jQuery(".phonemask").mask("+99(999)999-99-99");
    });

    @if(Session::has('check_message'))
    UIkit.notification("{{ Session::get('check_message.message') }}", {
        status: "{{ Session::get('check_message.status') }}",
        pos: 'top-right'
    });
    @endif

    @if(Session::has('call_back'))
    UIkit.notification("{{ Session::get('call_back.message') }}", {
        status: "{{ Session::get('call_back.status') }}",
        pos: 'top-right'
    });
    @endif

    $('.checkbox').change(function(){
        if(this.checked) $(this).val('1');
        else $(this).val('0');
    });
</script>

@stack('script')

</body>
</html>

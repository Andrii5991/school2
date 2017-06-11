<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin panel</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.11/css/uikit.min.css"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"--}}
    {{--integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/css/bootstrap-datetimepicker.min.css" />--}}

    {{--@stack('styles')--}}
    {{--@stack('headerScripts')--}}
</head>
<body>

<div class="container sm-container">
    @include('oleus.layouts.header')
    @if(isset($breadcrumb))
        @include('oleus.layouts.breadcrumb', ['breadcrumb' => $breadcrumb])
    @endif
    @yield('content')

</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.11/js/uikit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>
<script src="{{ elixir('js/app.js') }}"></script>
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
@stack('styles')

<script>
    CKEDITOR.replaceAll('htmleditor');

    CKEDITOR.config.toolbar = [
        ['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript'],
        ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote', 'CreateDiv'],
        ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
        ['Styles', 'Format', 'Font', 'FontSize'],
        ['TextColor', 'BGColor'],
        ['Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'],
        ['Table']
    ];
    $('#sort_btn').on('click', function () {
        var check = document.getElementsByClassName('check');
        var url = "/oleus/" + check[0].id + "/change_status";
        var elements = document.getElementsByClassName('sortable');
        var arr = [];
        for (var i = 0; i < elements.length; i++) {
            arr.push(elements[i].id);
        }

        elements = document.getElementsByClassName('checkbox_status');
        var checked = [];
        for (var i = 0; i < elements.length; i++) {
            checked.push(elements[i].checked ? 1 : 0);
        }

        $.ajax({
            type: "GET",
            url: url,
            data: {arr: arr, checked: checked}
        });
    });

    $('.modal-del').on('click', function (e) {
        $(this).attr('data-confirm', 'Вы уверены?');
        return !!confirm($(this).data('confirm'));
    });
</script>


<script type="text/javascript">
    jQuery(function () {
        jQuery(".phonemask").mask("+99(999)999-99-99");
    });
    jQuery(function () {
        jQuery(".time").mask("99:99");
    });
</script>
@if (count($errors) > 0)
    @php
        $notice = '<ul class=\"uk-list uk-margin-remove\">';
        foreach ($errors->all('<li>:message</li>') as $message) {
            $notice .= $message;
        }
        $notice .= '</ul>';
    @endphp
    <script>
        UIkit.notification("{!! $notice !!}", {
            status: 'danger',
            pos: 'top-right'
        });
    </script>
@endif
@if(Session::has('notify'))
    <script>
        UIkit.notification("{!! Session::get('notify.message') !!}", {
            status: '{{ Session::get('notify.status') }}',
            pos: 'top-right'
        });
    </script>
@endif

@stack('scripts')

</body>
</html>
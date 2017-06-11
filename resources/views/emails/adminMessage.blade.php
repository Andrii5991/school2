<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<table border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0; width: 600px;">
    <tr>
        <td colspan="3">
            <center>
    <span style="color: #636363; font: 30px Arial, sans-serif; line-height: 30px; -webkit-text-size-adjust:none; display: block;
    background: #ccc; padding: 30px;">
    {{ config('app.name') }}
    </span>
            </center>
        </td>
        <td></td>
    </tr>
    @forelse($data as $name => $val)
        @if($name != 'formId' && $name != 'titleId' && $name != '_token' && $name != 'check')
            <tr>
                <td>
                    <center>{{ $name }}</center>
                </td>
                <td>
                    <center> - </center>
                </td>
                <td>
                    <center>@if($val == '1') Да @elseif($val == '0') Нет @else {{ $val }} @endif</center>
                </td>
            </tr><br>
        @endif
    @empty
    @endforelse
    <tr>
        <td colspan="3">
            <center>
    <span style="color: #e6e6e6; font: 20px Arial, sans-serif; line-height: 30px; -webkit-text-size-adjust:none; display: block;
    background: #ccc; padding: 30px;">
&copy; {{ date('Y') }}
<span style="color: #e6e6e6; text-decoration: none;">
    <a href="{{ url('http://landing.dev/') }}" target="_blank">{{ config('app.name') }}</a>.
    </span>
     Всі права захищені.
    </span>
            </center>
        </td>
        <td></td>
    </tr>
</table>
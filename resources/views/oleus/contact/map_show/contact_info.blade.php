<dl>
    @if(count($phones) > 0)
        <dt>Телефоны:</dt>@endif
    @forelse($phones as $phone)
        <dd>{{ $phone }}</dd>
    @empty
    @endforelse
    @if(isset($contacts['contact_email']) && $contacts['contact_email'] != null)
        <dt>E-mail:</dt>
        <dd>{{ $contacts['contact_email'] }}</dd>
    @endif
    @if((!is_null($view_day7) && !is_null($view_day7[0])) && (is_null($view_day5) || is_null($view_day5[0])))
        <dd><b>Ми працюємо без вихідних:</b> {{ $view_day7[0] }} - {{ $view_day7[1] }}</dd>
        {{--@if(isset($view_day7[2]) && !is_null($view_day7[2]))
            <dd><span style="font-size: 0.8em">Перерыв: </span>
                {{ $view_day7[2] }} - {{ $view_day7[3] }}</dd>
        @endif--}}
    @elseif((!is_null($view_day5) && !is_null($view_day5[0])) && (is_null($view_day7) || is_null($view_day7[0])))
        <dd><b>Понедельник - Пятница:</b> {{ $view_day5[0] }} - {{ $view_day5[1] }}</dd>
        {{--@if(isset($view_day5[2]) && !is_null($view_day5[2]))
            <dd><span style="font-size: 0.8em">Перерыв: </span>
                {{ $view_day5[2] }} - {{ $view_day5[3] }}</dd>
        @else
        @endif--}}
    @elseif((!is_null($view_day7) && !is_null($view_day7[0])) && (!is_null($view_day5) && !is_null($view_day5[0])))
        <dd><b>Понедельник - Пятница:</b> {{ $view_day5[0] }} - {{ $view_day5[1] }}</dd>
        {{--@if(isset($view_day5[2]) && !is_null($view_day5[2]))
            <dd><span style="font-size: 0.8em">Перерыв: </span>
                {{ $view_day5[2] }} - {{ $view_day5[3] }}</dd>
        @endif--}}
    @else
    @endif

    @if((!is_null($view_day7) && !is_null($view_day7[2])) && (is_null($view_day5) || is_null($view_day5[2])))
        <dd><span style="font-size: 0.8em">Перерыв: </span>
            {{ $view_day7[2] }} - {{ $view_day7[3] }}</dd>
    @elseif((!is_null($view_day5) && !is_null($view_day5[2])) && (is_null($view_day7) || is_null($view_day7[2])))
        <dd><span style="font-size: 0.8em">Перерыв: </span>
            {{ $view_day5[2] }} - {{ $view_day5[3] }}</dd>
    @elseif((!is_null($view_day7) && !is_null($view_day7[2])) && (!is_null($view_day5) && !is_null($view_day5[2])))
        <dd><span style="font-size: 0.8em">Перерыв: </span>
            {{ $view_day5[2] }} - {{ $view_day5[3] }}</dd>
    @else
    @endif

    @if(count($view_day7) > 0)
        @for($i = 0; $i < count($alldays); $i+=5)
            @if((!is_null($alldays[$i+1])) && ($alldays[$i+1] != $days7[0] || $alldays[$i+2] != $days7[1] ||
            $alldays[$i+3] != $days7[2] || $alldays[$i+4] != $days7[3]))
                <dd><b>{{ $days_name[$alldays[$i]] }} :</b> {{ $alldays[$i+1] }}
                    - {{ $alldays[$i+2] }}</dd>
                @if(isset($alldays[$i+3]) && !is_null($alldays[$i+3]))
                    <dd><span style="font-size: 0.8em">Перерыв: </span>
                        {{ $alldays[$i+3] }} - {{ $alldays[$i+4] }}</dd>
                @endif
            @endif
        @endfor
    @elseif(count($view_day5) > 0)
        @for($i = 0; $i < (count($alldays)-10); $i+=5)
            @if((! is_null($alldays[$i+1])) && ($alldays[$i+1] != $days5[0] || $alldays[$i+2] != $days5[1] ||
            $alldays[$i+3] != $days5[2] || $alldays[$i+4] != $days5[3]))
                <dd><b>{{ $days_name[$alldays[$i]] }} :</b> {{ $alldays[$i+1] }}
                    - {{ $alldays[$i+2] }}</dd>
                @if(isset($alldays[$i+3]) && !is_null($alldays[$i+3]))
                    <dd><span style="font-size: 0.8em">Перерыв: </span>
                        {{ $alldays[$i+3] }} - {{ $alldays[$i+4] }}</dd>
                @endif
            @endif
        @endfor
    @else
        @for($i = 0; $i < count($alldays); $i+=5)
            @if(! is_null($alldays[$i+1]))
                <dd><b>{{ $days_name[$alldays[$i]] }} :</b> {{ $alldays[$i+1] }}
                    - {{ $alldays[$i+2] }}</dd>
                @if(isset($alldays[$i+3]) && !is_null($alldays[$i+3]))
                    <dd><span style="font-size: 0.8em">Перерыв: </span>
                        {{ $alldays[$i+3] }} - {{ $alldays[$i+4] }}</dd>
                @endif
            @endif
        @endfor
    @endif
    @if(isset($contacts['address']) && $contacts['address'] != null)
        <dt>Адрес:</dt>
        <dd>{!! $contacts['address'] !!}</dd>
    @endif
</dl>
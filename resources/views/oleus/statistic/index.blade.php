@extends('oleus.layouts.admin')
@inject('withits', 'App\Withits')
@inject('leads', 'App\Lead')

@section('content')
    <div class="uk-container">
        <div class="uk-card uk-card-default uk-width-1-1@m">
            <div class="uk-card-header">
                <h1 class="pull-left">Статистика</h1>
                <div class="uk-margin pull-right">
                    <select id="select_period" class="uk-select uk-form-width-medium">
                        <option value="all">За всьо время</option>
                        <option value="month">За последний месяц</option>
                        <option value="week">За последнюю неделю</option>
                        <option value="day">За последний день</option>
                    </select>
                </div>
            </div>
            <div class="uk-card-body">

                <div class="item-table-border-title" uk-grid>
                    <div class="uk-width-1-6@m">№</div>
                    <div class="uk-width-expand@m">Заголовок</div>
                    <div class="uk-width-1-6@m">UTM</div>
                    <div class="uk-width-1-6@m">Кол-во пользователей</div>
                    <div class="uk-width-1-6@m">Лиды</div>
                    <div class="uk-width-1-6@m">Конверсия</div>
                </div>
                @forelse($titles as $title)
                    <div class="item-table-border" uk-grid>
                        <div class="uk-width-1-6@m">{{ $title->id }}</div>
                        <div class="uk-width-1-6@m">{!! strip_tags($title->title) !!}</div>
                        <div class="uk-width-1-6@m">{{ $title->utm }}</div>

                        <div class="all uk-width-1-6@m">{{ $title->views }}</div>
                        <div class="month uk-width-1-6@m">{{ $withits->lastMonth($title->id)->count() }}</div>
                        <div class="week uk-width-1-6@m">{{ $withits->lastWeek($title->id)->count() }}</div>
                        <div class="day uk-width-1-6@m">{{ $withits->lastDay($title->id)->count() }}</div>

                        <div class="all uk-width-1-6@m">{{ $title->lead }}</div>
                        <div class="month uk-width-1-6@m">{{ $leads->lastMonth($title->id)->count() }}</div>
                        <div class="week uk-width-1-6@m">{{ $leads->lastWeek($title->id)->count() }}</div>
                        <div class="day uk-width-1-6@m">{{ $leads->lastDay($title->id)->count() }}</div>

                        <div class="all uk-width-1-6@m">@if($title->lead != 0 && $title->views != 0)
                                {{ ($title->lead*100)/$title->views }} % @else 0 % @endif</div>
                        <div class="month uk-width-1-6@m">@if($leads->lastMonth($title->id)->count() != 0 && $withits->lastMonth($title->id)->count() != 0)
                                {{ ($leads->lastMonth($title->id)->count() * 100)/$withits->lastMonth($title->id)->count() }} % @else 0 % @endif</div>
                        <div class="week uk-width-1-6@m">@if($leads->lastWeek($title->id)->count() != 0 && $withits->lastWeek($title->id)->count() != 0)
                                {{ ($leads->lastWeek($title->id)->count() * 100)/$withits->lastWeek($title->id)->count() }} % @else 0 % @endif</div>
                        <div class="day uk-width-1-6@m">@if($leads->lastDay($title->id)->count() != 0 && $withits->lastDay($title->id)->count() != 0)
                                {{ ($leads->lastDay($title->id)->count() * 100)/$withits->lastDay($title->id)->count() }} % @else 0 % @endif</div>
                    </div>
                @empty
                    <div class="uk-alert-danger" uk-alert>
                        <a class="uk-alert-close" uk-close></a>
                        <p>У вас нет Заголовков</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $('.month').css('display', 'none');
    $('.week').css('display', 'none');
    $('.day').css('display', 'none');
    $("select").change(function () {
        var period = $('#select_period').val();
        $('.all').css('display', 'none');
        $('.month').css('display', 'none');
        $('.week').css('display', 'none');
        $('.day').css('display', 'none');
        if (period == 'all') $('.all').css('display', 'block');
        else if (period == 'month') $('.month').css('display', 'block');
        else if (period == 'week') $('.week').css('display', 'block');
        else if (period == 'day') $('.day').css('display', 'block');
    });
</script>
@endpush
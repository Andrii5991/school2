@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container">

        <h1>Ліди</h1>

        <div class="uk-card uk-card-default uk-width-1-1@m">
            <div class="uk-card-header uk-text-right">
                {{--<button class="uk-button btn-save" id="sort_btn" type="submit" value='SAVE'>Сохранить</button>--}}
            </div>
            <div class="uk-card-body">

                <div class="item-table-border-title" uk-grid>
                    <div class="uk-width-1-6@m">ID</div>
                    <div class="uk-width-expand@m">Дані</div>
                    <div class="uk-width-2-6@m">Назва форми</div>
                </div>

                @forelse($leads as $lead)
                    <div class="item-table-border uk-grid uk-margin-remove-top" uk-grid>

                        <div class="uk-width-1-6@m">
                            <div># {{ $lead->id }}</div>
                        </div>

                        <div class="uk-width-expand@m">
                            @forelse(json_decode($lead->data) as $name => $val)
                                @if($name != 'formId' && $name != 'titleId' && $name != '_token')
                                    {{ $name }} - {{ $val }}<br>
                                @endif
                            @empty
                            @endforelse
                        </div>

                        <div class="uk-width-2-6@m">
                             <div>{{ strip_tags($lead->form->title) }}</div>
                        </div>

                        <div class="uk-width-1-6@m">
                            <div>
                                <a href="{{ route('lead.show', $lead) }}"
                                   class="uk-button btn-show uk-button-small pull-right">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    Нет записей
                @endforelse
            </div>
        </div>
    </div>
@endsection
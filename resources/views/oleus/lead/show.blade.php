@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container">
        <div class="uk-card uk-card-default">
            <div class="uk-card-header">
                <h3 class="uk-text-center uk-text-danger">#{{ $lead->id }} LEAD</h3>
            </div>
            <div class="uk-card-body">
                <dl class="uk-description-list uk-description-list-divider">
                    <dt>FORM:</dt>
                    <dd>{!! strip_tags($lead->form->title) !!}</dd>
                    <dt>Data:</dt>
                    <dd>
                        @forelse(json_decode($lead->data) as $name => $val)
                            @if($name != 'formId' && $name != 'titleId' && $name != '_token')
                                {{ $name }} - {{ $val }}<br>
                            @endif
                        @empty
                        @endforelse
                    </dd>
                </dl>
            </div>
        </div>
    </div>
@endsection
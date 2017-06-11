@extends('oleus.layouts.admin')

@section('content')
    <div class="uk-container">

        <h1>Статичний текст</h1>

        <div class="uk-card uk-card-default uk-width-1-1@m">
            <div class="uk-card-header uk-text-right">
                <a class="uk-button btn-create" href="{{ route('text.create') }}">Створити</a>
                <button class="uk-button btn-save" id="sort_btn" type="submit" value='SAVE'>Зберегти</button>
            </div>
            <div class="uk-card-body">

                <div class="item-table-border-title" uk-grid>
                    <div class="uk-width-1-6">№</div>
                    <div class="uk-width-1-6">Заголовок</div>
                    <div class="uk-width-1-3">Зображення</div>
                    <div class="uk-width-1-6">ID</div>
                    <div class="uk-width-1-6"></div>
                </div>

                <div uk-sortable="group: sortable-group" class="check" id="menu">
                    @forelse($texts as $num => $text)
                        <div class="uk-margin sortable" id="{{$text->id}}">
                            <div class="item-table-border" uk-grid>
                                <div class="uk-width-1-6">{{ $num+1 }}</div>
                                <div class="uk-width-1-6">{{ strip_tags($text->title) }}</div>
                                <div class="uk-width-1-3 text-bacground-img" {{--id="text-{{ $text->id }}--}}>
                                @if(isset($text->image))
                                    <img src="/storage/files/{{ App\Files::find($text->image)->filename }}"
                                         class="advantages-scheme" style="max-width: 80px; max-height: 80px;">
                                @endif
                                </div>
                            <div class="uk-width-1-6"># {{ $text->id }}</div>
                            <div class="uk-width-1-6">
                                <a href="{{ route('text.edit', $text) }}"
                                   class="uk-button btn-edit uk-button-small"><i
                                            class="fa fa-pencil-square-o"></i></a>
                                <a href="{{ route('text.destroy', $text) }}"
                                   class="uk-button btn-trash uk-button-small modal-del"><i
                                            class="fa fa-trash-o"></i></a>
                            </div>

                        </div>
                </div>

                @empty
                    <div class="uk-alert-danger" uk-alert>
                        <a class="uk-alert-close" uk-close></a>
                        <p>Пусто</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
@endsection

{{--@push('styles')--}}
{{--<style type="text/css">--}}
{{--@foreach($texts as $text)--}}

{{--#text-{{ $text->id }}  {--}}
{{--@if(!is_null($text->image))--}}
{{--background-image: url(/storage/files/{{ App\Files::find($text->image)->filename }});--}}
{{--@endif--}}
{{--}--}}
{{--@endforeach--}}
{{--</style>--}}
{{--@endpush--}}
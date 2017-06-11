@extends('oleus.layouts.admin')

@section('content')

    <div class="uk-container">
        <h3 class="uk-card-title">Контакти</h3>
        <div class="uk-card uk-card-default">
            <form class="uk-form-stacked" method="post" id="type_form" action="{{ route('contact.update') }}">
                {{ csrf_field() }}
            <div class="uk-card-header">
                <input class="uk-button btn-save uk-margin pull-right" type="submit" value='Зберегти'>
            </div>
            <div class="uk-card-body">
                <div uk-grid>
                    <div class="uk-width-1-2 uk-padding">

                        <div class="uk-margin">
                            <label class="uk-form-label uk-margin-right" for="name">Назва контактів</label>
                            <div class="uk-form-controls">
                                <input type="text" class="uk-input uk-margin-bottom uk-form-width-large" name="name"
                                       id="title" value="{{ $contacts['name'] or old('name') }}">
                            </div>
                        </div>

                        <div class="uk-margin">
                            Координаты карт Google
                            <label class="uk-form-label uk-margin-right" for="latitude">широта</label>
                            <div class="uk-form-controls">
                                <input type="text" class="uk-input uk-margin-bottom uk-form-width-large" id="latitude"
                                       name="latitude" value="{{ $contacts['latitude'] or old('latitude') }}">
                            </div>

                            <label class="uk-form-label uk-margin-right" for="longitude">довгота</label>
                            <div class="uk-form-controls">
                                <input type="text" class="uk-input uk-margin-bottom uk-form-width-large" id="longitude"
                                       name="longitude" value="{{ $contacts['longitude'] or old('longitude') }}">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label" for="status">
                                <input class="uk-checkbox checkbox_status" type="checkbox" name="map_show"
                                       value="1" @if(isset($contacts['map_show']) && $contacts['map_show'] == 1) checked @endif >Отображaть карту
                            </label>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label uk-margin-right" for="map_position">Формат відображення карти</label>
                            <div class="uk-form-controls">
                                <select class="uk-select uk-form-width-large" name="map_position" id="map_position">
                                    <option value="fon" @if(isset($contacts['map_position']) && $contacts['map_position'] == 'fon') selected @endif>
                                        Фоном
                                    </option>
                                    <option value="right" @if(isset($contacts['map_position']) && $contacts['map_position'] == 'right') selected @endif>
                                        Cправа
                                    </option>
                                    <option value="left" @if(isset($contacts['map_position']) && $contacts['map_position'] == 'left') selected @endif>
                                        Cлева
                                    </option>
                                </select>
                            </div>
                        </div>

                        {{--<div class="uk-margin">
                            <label class="uk-form-label uk-margin-right" for="title">Выбор заголовка</label>
                            <div class="uk-form-controls">
                                <select class="uk-select uk-form-width-large" name="title">
                                    <option value="@if(isset($contacts['title'])) {{ $contacts['title'] }} @else error @endif">
                                        @if(isset($contacts['title'])) {!! $contacts['title'] !!} @else Вибір заголовка @endif</option>
                                    @foreach($titles as $title)
                                        <option value="{{ $title->title }}">{!! $title->title !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>--}}

                        <div class="uk-margin">
                            <label class="uk-form-label uk-margin-right" for="status">
                                <input class="uk-checkbox checkbox_status" type="checkbox" name="status" id="status"
                                       value="1"
                                       @if(isset($contacts['status']) && $contacts['status']) checked @endif>
                                Опубликовано
                            </label>
                        </div>

                        <div class="uk-margin">
                            Телефоны
                            <div class="uk-form-controls">
                                <input type="text" class="uk-input uk-margin-bottom uk-form-width-large phonemask"
                                       placeholder="Телефон №1" name="phone1" id="phone1"
                                       value="{{ $contacts['phone1'] or old('phone1') }}">
                            </div>
                            <div class="uk-form-controls">
                                <input type="text" class="uk-input uk-margin-bottom uk-form-width-large phonemask"
                                       placeholder="Телефон №2" name="phone2" id="phone2"
                                       value="{{ $contacts['phone2'] or old('phone2') }}">
                            </div>
                            <div class="uk-form-controls">
                                <input type="text" class="uk-input uk-margin-bottom uk-form-width-large phonemask"
                                       placeholder="Телефон №3" name="phone3" id="phone3"
                                       value="{{ $contacts['phone3'] or old('phone3') }}">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label uk-margin-right" for="contact_email">Email</label>
                            <div class="uk-form-controls">
                                <input type="email" class="uk-input uk-margin-bottom uk-form-width-large"
                                       name="contact_email" id="contact_email"
                                       value="{{ $contacts['contact_email'] or old('contact_email') }}">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label uk-margin-right" for="address">Юридический адрес</label>
                            <div class="uk-form-controls">
                            <textarea name="address" class="uk-textarea uk-form-width-large htmleditor"
                                      rows="7">{{ $contacts['address'] or old('address') }}</textarea>
                            </div>
                        </div>



                        <div class="uk-margin">
                            <label class="uk-form-label">Колір кнопки: </label>
                            <div class="uk-margin toggle">
                                <input type="color" name="color" onchange="clickColor(0, -1, -1, 5)" value="{{  $contacts['color'] or "ff0000" }}"
                                       style="padding: 0; margin: 0; background: transparent; border: 0; height: 100px; width: 100px;">
                            </div>
                        </div>
                    </div>

                    <div class="uk-width-1-2 uk-padding">

                        <div class="uk-inline">
                            <button class="uk-button btn-show" type="button">Графік</button>
                            <div uk-dropdown="pos: right-top">
                                <ul class="uk-nav uk-dropdown-nav" uk-switcher="connect: #my-id">
                                    <li><a href="#">Всі дні</a></li>
                                    <li><a href="#">С понеділка по п'ятницю</a></li>
                                    <li><a href="#">Всі дні (окремо)</a></li>
                                    {{--<li><a href="#">Вторник</a></li>
                                    <li><a href="#">Среда</a></li>
                                    <li><a href="#">Четверг</a></li>
                                    <li><a href="#">Пятница</a></li>
                                    <li><a href="#">Субота</a></li>
                                    <li><a href="#">Воскресенье</a></li>--}}

                                </ul>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <ul id="my-id" class="uk-switcher">
                                <li>
                                    <h3 class="uk-text-center uk-text-danger">Всі дні</h3>
                                    <div class="uk-margin">
                                        <label class="uk-form-label uk-margin-right"><span
                                                    class="uk-label">Працюєм</span></label>
                                        <div class="uk-autocomplete uk-form"
                                             id="callback" data-uk-autocomplete="{source:'oleus.contact.timepicker.json'}">
                                            <input type="text" value=" {{ $contacts['wt_all_from'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small time"
                                                   data-uk-timepicker name="wt_all_from" id="wt_all_from">
                                            <input type="text" value=" {{ $contacts['wt_all_to'] or ""}}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left time"
                                                   data-uk-timepicker name="wt_all_to" id="wt_all_to">
                                        </div>
                                    </div>

                                    <div class="uk-margin">
                                        <label class="uk-form-label uk-margin-right"><span
                                                    class="uk-label uk-label-danger">Перерва</span></label>
                                        <div class="uk-autocomplete uk-form">
                                            <input type="text" value="{{ $contacts['rt_all_from'] or ""}}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small time"
                                                   data-uk-timepicker name="rt_all_from" id="rt_all_from">
                                            <input type="text" value=" {{ $contacts['rt_all_to'] or ""}}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left time"
                                                   data-uk-timepicker name="rt_all_to" id="rt_all_to">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <h3 class="uk-text-center uk-text-danger">З понеділка по п'ятницю</h3>
                                    <div class="uk-margin">
                                        <label class="uk-form-label uk-margin-right"><span
                                                    class="uk-label">Працюєм</span></label>
                                        <div class="uk-autocomplete uk-form"
                                             id="callback" data-uk-autocomplete="{source:'oleus.contact.timepicker.json'}">
                                            <input type="text" value=" {{ $contacts['wt_5_from'] or ""}}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small time"
                                                   data-uk-timepicker name="wt_5_from" id="wt_5_from">
                                            <input type="text" value="{{ $contacts['wt_5_to'] or ""}}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left time"
                                                   data-uk-timepicker name="wt_5_to" id="wt_5_to">
                                        </div>
                                    </div>

                                    <div class="uk-margin">
                                        <label class="uk-form-label uk-margin-right"><span
                                                    class="uk-label uk-label-danger">Перерва</span></label>
                                        <div class="uk-autocomplete uk-form">
                                            <input type="text" value=" {{ $contacts['rt_5_from'] or ""}}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small time"
                                                   data-uk-timepicker name="rt_5_from" id="rt_5_from">
                                            <input type="text" value=" {{ $contacts['rt_5_to'] or ""}}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left time"
                                                   data-uk-timepicker name="rt_5_to" id="rt_5_to">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <h3 class="uk-text-center uk-text-danger">Понеділок</h3>
                                    <div class="uk-margin">
                                        <label class="uk-form-label uk-margin-right"><span
                                                    class="uk-label">Працюєм</span></label>
                                        <div class="uk-autocomplete uk-form"
                                             id="callback" data-uk-autocomplete="{source:'oleus.contact.timepicker.json'}">
                                            <input type="text" value=" {{ $contacts['wt_mon_from'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small time"
                                                   data-uk-timepicker name="wt_mon_from" id="wt_mon_from">
                                            <input type="text" value=" {{ $contacts['wt_mon_to'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left time"
                                                   data-uk-timepicker name="wt_mon_to" id="wt_mon_to">
                                        </div>
                                    </div>

                                    <div class="uk-margin">
                                        <label class="uk-form-label uk-margin-right"><span
                                                    class="uk-label uk-label-danger">Перерва</span></label>
                                        <div class="uk-autocomplete uk-form">
                                            <input type="text" value=" {{ $contacts['rt_mon_from'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small time"
                                                   data-uk-timepicker name="rt_mon_from" id="rt_mon_from">
                                            <input type="text" value=" {{ $contacts['rt_mon_to'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left time"
                                                   data-uk-timepicker name="rt_mon_to" id="rt_mon_to">
                                        </div>
                                    </div>

                                    <h3 class="uk-text-center uk-text-danger">Вівторок</h3>
                                    <div class="uk-margin">
                                        <label class="uk-form-label uk-margin-right"><span
                                                    class="uk-label">Працюєм</span></label>
                                        <div class="uk-autocomplete uk-form"
                                             id="callback" data-uk-autocomplete="{source:'oleus.contact.timepicker.json'}">
                                            <input type="text" value="{{ $contacts['wt_tue_from'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small time"
                                                   data-uk-timepicker name="wt_tue_from" id="wt_tue_from">
                                            <input type="text" value=" {{ $contacts['wt_tue_to'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left time"
                                                   data-uk-timepicker name="wt_tue_to" id="wt_tue_to">
                                        </div>
                                    </div>

                                    <div class="uk-margin">
                                        <label class="uk-form-label uk-margin-right"><span
                                                    class="uk-label uk-label-danger">Перерва</span></label>
                                        <div class="uk-autocomplete uk-form">
                                            <input type="text" value=" {{ $contacts['rt_tue_from'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small time"
                                                   data-uk-timepicker name="rt_tue_from" id="rt_tue_from">
                                            <input type="text" value=" {{ $contacts['rt_tue_to'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left time"
                                                   data-uk-timepicker name="rt_tue_to" id="rt_tue_to">
                                        </div>
                                    </div>

                                    <h3 class="uk-text-center uk-text-danger">Середа</h3>
                                    <div class="uk-margin">
                                        <label class="uk-form-label uk-margin-right"><span
                                                    class="uk-label">Працюєм</span></label>
                                        <div class="uk-autocomplete uk-form"
                                             id="callback" data-uk-autocomplete="{source:'oleus.contact.timepicker.json'}">
                                            <input type="text" value=" {{ $contacts['wt_wen_from'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small time"
                                                   data-uk-timepicker name="wt_wen_from" id="wt_wen_from">
                                            <input type="text" value=" {{ $contacts['wt_wen_to'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left time"
                                                   data-uk-timepicker name="wt_wen_to" id="wt_wen_to">
                                        </div>
                                    </div>

                                    <div class="uk-margin">
                                        <label class="uk-form-label uk-margin-right"><span
                                                    class="uk-label uk-label-danger">Перерва</span></label>
                                        <div class="uk-autocomplete uk-form">
                                            <input type="text" value="{{ $contacts['rt_wen_from'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small time"
                                                   data-uk-timepicker name="rt_wen_from" id="rt_wen_from">
                                            <input type="text" value=" {{ $contacts['rt_wen_to'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left time"
                                                   data-uk-timepicker name="rt_wen_to" id="rt_wen_to">
                                        </div>
                                    </div>

                                    <h3 class="uk-text-center uk-text-danger">Червер</h3>
                                    <div class="uk-margin">
                                        <label class="uk-form-label uk-margin-right"><span
                                                    class="uk-label">Працюєм</span></label>
                                        <div class="uk-autocomplete uk-form"
                                             id="callback" data-uk-autocomplete="{source:'oleus.contact.timepicker.json'}">
                                            <input type="text" value="{{ $contacts['wt_thu_from'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small time"
                                                   data-uk-timepicker name="wt_thu_from" id="wt_thu_from">
                                            <input type="text" value="{{ $contacts['wt_thu_to'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left time"
                                                   data-uk-timepicker name="wt_thu_to" id="wt_thu_to">
                                        </div>
                                    </div>

                                    <div class="uk-margin">
                                        <label class="uk-form-label uk-margin-right"><span
                                                    class="uk-label uk-label-danger">Перерва</span></label>
                                        <div class="uk-autocomplete uk-form">
                                            <input type="text" value="{{ $contacts['rt_thu_from'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small time"
                                                   data-uk-timepicker name="rt_thu_from" id="rt_thu_from">
                                            <input type="text" value="{{ $contacts['rt_thu_to'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left time"
                                                   data-uk-timepicker name="rt_thu_to" id="rt_thu_to">
                                        </div>
                                    </div>

                                    <h3 class="uk-text-center uk-text-danger">П'ятниця</h3>
                                    <div class="uk-margin">
                                        <label class="uk-form-label uk-margin-right"><span
                                                    class="uk-label">Працюєм</span></label>
                                        <div class="uk-autocomplete uk-form"
                                             id="callback" data-uk-autocomplete="{source:'oleus.contact.timepicker.json'}">
                                            <input type="text" value="{{ $contacts['wt_fri_from'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small time"
                                                   data-uk-timepicker name="wt_fri_from" id="wt_fri_from">
                                            <input type="text" value=" {{ $contacts['wt_fri_to'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left time"
                                                   data-uk-timepicker name="wt_fri_to" id="wt_fri_to">
                                        </div>
                                    </div>

                                    <div class="uk-margin">
                                        <label class="uk-form-label uk-margin-right"><span
                                                    class="uk-label uk-label-danger">Перерва</span></label>
                                        <div class="uk-autocomplete uk-form">
                                            <input type="text" value="{{ $contacts['rt_fri_from'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small time"
                                                   data-uk-timepicker name="rt_fri_from" id="rt_fri_from">
                                            <input type="text" value="{{ $contacts['rt_fri_from'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left time"
                                                   data-uk-timepicker name="rt_fri_to" id="rt_fri_to">
                                        </div>
                                    </div>

                                    <h3 class="uk-text-center uk-text-danger">Субота</h3>
                                    <div class="uk-margin">
                                        <label class="uk-form-label uk-margin-right"><span
                                                    class="uk-label">Працюєм</span></label>
                                        <div class="uk-autocomplete uk-form"
                                             id="callback" data-uk-autocomplete="{source:'oleus.contact.timepicker.json'}">
                                            <input type="text" value=" {{ $contacts['wt_sat_from'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small time"
                                                   data-uk-timepicker name="wt_sat_from" id="wt_sat_from">
                                            <input type="text" value="{{ $contacts['wt_sat_to'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left time"
                                                   data-uk-timepicker name="wt_sat_to" id="wt_sat_to">
                                        </div>
                                    </div>

                                    <div class="uk-margin">
                                        <label class="uk-form-label uk-margin-right"><span
                                                    class="uk-label uk-label-danger">Перерва</span></label>
                                        <div class="uk-autocomplete uk-form">
                                            <input type="text" value=" {{ $contacts['rt_sat_from'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small time"
                                                   data-uk-timepicker name="rt_sat_from" id="rt_sat_from">
                                            <input type="text" value="{{ $contacts['rt_sat_to'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left time"
                                                   data-uk-timepicker name="rt_sat_to" id="rt_sat_to">
                                        </div>
                                    </div>

                                    <h3 class="uk-text-center uk-text-danger">Неділя</h3>
                                    <div class="uk-margin">
                                        <label class="uk-form-label uk-margin-right"><span
                                                    class="uk-label">Працюєм</span></label>
                                        <div class="uk-autocomplete uk-form"
                                             id="callback" data-uk-autocomplete="{source:'oleus.contact.timepicker.json'}">
                                            <input type="text" value="{{ $contacts['wt_sun_from'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small time"
                                                   data-uk-timepicker name="wt_sun_from" id="wt_sun_from">
                                            <input type="text" value="{{ $contacts['wt_sun_to'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left time"
                                                   data-uk-timepicker name="wt_sun_to" id="wt_sun_to">
                                        </div>
                                    </div>

                                    <div class="uk-margin">
                                        <label class="uk-form-label uk-margin-right"><span
                                                    class="uk-label uk-label-danger">Перерва</span></label>
                                        <div class="uk-autocomplete uk-form">
                                            <input type="text" value="{{ $contacts['rt_sun_from'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small time"
                                                   data-uk-timepicker name="rt_sun_from" id="rt_sun_from">
                                            <input type="text" value="{{ $contacts['rt_sun_to'] or "" }}"
                                                   class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left time"
                                                   data-uk-timepicker name="rt_sun_to" id="rt_sun_to">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $(document).on( "click", "li.clicked", function(  ) {
            alert($(this).attr('data-id'));
        });

    });
</script>


@endpush
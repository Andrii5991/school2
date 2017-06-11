@extends('oleus.layouts.admin')

@section('content')

    <div class="uk-container">
        <h3 class="uk-text-center uk-text-danger">Редагувати</h3>
        <form class="uk-form-stacked" method="post" id="type_form" action="{{ route('contact.update') }}">
            {{ csrf_field() }}
            <div uk-grid>
                <div class="uk-width-1-2 uk-card-default uk-padding">

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="">Назва контактів</label>
                        <div class="uk-form-controls">
                            <input type="text" class="uk-input uk-margin-bottom uk-form-width-large">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title">Координати карт Google</label>
                        <div class="uk-form-controls">
                            <input type="text" class="uk-input uk-margin-bottom uk-form-width-large">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="">Відображення карти</label>
                        <div class="uk-form-controls">
                            <select class="uk-select uk-form-width-large">
                                <option>Фоном</option>
                                <option>Зправа</option>
                                <option>Зліва</option>
                            </select>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="">Вибір заголовка</label>
                        <div class="uk-form-controls">
                            <select class="uk-select uk-form-width-large">
                                <option>Вибір заголовка</option>
                            </select>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" style="display: inline-block;">Опубликовано:</label>
                        <input class="uk-checkbox checkbox_status" type="checkbox" name="status"
                               {{--@if($advantage->status)--}} checked {{--@endif--}} value="1">
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title">Телефон</label>
                        <div class="uk-form-controls">
                            <input type="text" class="uk-input uk-margin-bottom uk-form-width-large phonemask"
                                   placeholder="Телефон №1">
                        </div>
                        <div class="uk-form-controls">
                            <input type="text" class="uk-input uk-margin-bottom uk-form-width-large phonemask"
                                   placeholder="Телефон №2">
                        </div>
                        <div class="uk-form-controls">
                            <input type="text" class="uk-input uk-margin-bottom uk-form-width-large phonemask"
                                   placeholder="Телефон №3">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title">Email</label>
                        <div class="uk-form-controls">
                            <input type="email" class="uk-input uk-margin-bottom uk-form-width-large">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title">Юридична адреса</label>
                        <div class="uk-form-controls">
                            <textarea class="uk-textarea uk-form-width-large" rows="7">123</textarea>
                        </div>
                    </div>
                    <input class="uk-button uk-button-primary uk-margin-bottom" type="submit" value='Зберегти'>

                </div>
                <div class="uk-width-1-2 uk-card-default uk-padding">

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title"><span class="uk-label">Понеділок</span></label>
                        <div class="uk-autocomplete uk-form" data-uk-autocomplete="{source:'timepicker.json'}">
                            <input type="text" placeholder="С" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small" data-uk-timepicker>
                            <input type="text" placeholder="До" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left"
                                   data-uk-timepicker>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title"><span class="uk-label uk-label-danger">Перерва</span></label>
                        <div class="uk-autocomplete uk-form" data-uk-autocomplete="{source:'timepicker.json'}">
                            <input type="text" placeholder="С" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small" data-uk-timepicker>
                            <input type="text" placeholder="До" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left"
                                   data-uk-timepicker>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title"><span class="uk-label">Вівторок</span></label>
                        <div class="uk-autocomplete uk-form" data-uk-autocomplete="{source:'timepicker.json'}">
                            <input type="text" placeholder="С" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small" data-uk-timepicker>
                            <input type="text" placeholder="До" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left"
                                   data-uk-timepicker>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title"><span class="uk-label uk-label-danger">Перерва</span></label>
                        <div class="uk-autocomplete uk-form" data-uk-autocomplete="{source:'timepicker.json'}">
                            <input type="text" placeholder="С" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small" data-uk-timepicker>
                            <input type="text" placeholder="До" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left"
                                   data-uk-timepicker>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title"><span class="uk-label">Середа</span></label>
                        <div class="uk-autocomplete uk-form" data-uk-autocomplete="{source:'timepicker.json'}">
                            <input type="text" placeholder="С" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small" data-uk-timepicker>
                            <input type="text" placeholder="До" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left" data-uk-timepicker>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title"><span class="uk-label uk-label-danger">Перерва</span></label>
                        <div class="uk-autocomplete uk-form" data-uk-autocomplete="{source:'timepicker.json'}">
                            <input type="text" placeholder="С" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small" data-uk-timepicker>
                            <input type="text" placeholder="До" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left"
                                   data-uk-timepicker>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title"><span class="uk-label">Четверг</span></label>
                        <div class="uk-autocomplete uk-form" data-uk-autocomplete="{source:'timepicker.json'}">
                            <input type="text" placeholder="С" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small" data-uk-timepicker>
                            <input type="text" placeholder="До" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left" data-uk-timepicker>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title"><span class="uk-label uk-label-danger">Перерва</span></label>
                        <div class="uk-autocomplete uk-form" data-uk-autocomplete="{source:'timepicker.json'}">
                            <input type="text" placeholder="С" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small" data-uk-timepicker>
                            <input type="text" placeholder="До" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left"
                                   data-uk-timepicker>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title"><span class="uk-label">Пйятниця</span></label>
                        <div class="uk-autocomplete uk-form" data-uk-autocomplete="{source:'timepicker.json'}">
                            <input type="text" placeholder="С" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small" data-uk-timepicker>
                            <input type="text" placeholder="До" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left" data-uk-timepicker>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title"><span class="uk-label uk-label-danger">Перерва</span></label>
                        <div class="uk-autocomplete uk-form" data-uk-autocomplete="{source:'timepicker.json'}">
                            <input type="text" placeholder="С" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small" data-uk-timepicker>
                            <input type="text" placeholder="До" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left"
                                   data-uk-timepicker>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title"><span class="uk-label">Субота</span></label>
                        <div class="uk-autocomplete uk-form" data-uk-autocomplete="{source:'timepicker.json'}">
                            <input type="text" placeholder="С" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small" data-uk-timepicker>
                            <input type="text" placeholder="До" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left" data-uk-timepicker>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title"><span class="uk-label uk-label-danger">Перерва</span></label>
                        <div class="uk-autocomplete uk-form" data-uk-autocomplete="{source:'timepicker.json'}">
                            <input type="text" placeholder="С" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small" data-uk-timepicker>
                            <input type="text" placeholder="До" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left"
                                   data-uk-timepicker>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title"><span class="uk-label">Неділя</span></label>
                        <div class="uk-autocomplete uk-form" data-uk-autocomplete="{source:'timepicker.json'}">
                            <input type="text" placeholder="С" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small" data-uk-timepicker>
                            <input type="text" placeholder="До" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left" data-uk-timepicker>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-margin-right" for="title"><span class="uk-label uk-label-danger">Перерва</span></label>
                        <div class="uk-autocomplete uk-form" data-uk-autocomplete="{source:'timepicker.json'}">
                            <input type="text" placeholder="С" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small" data-uk-timepicker>
                            <input type="text" placeholder="До" class="uk-input uk-margin-bottom uk-form-width-small uk-form-small uk-margin-left"
                                   data-uk-timepicker>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>

@endsection()
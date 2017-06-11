<div class="uk-padding">
    <div class="uk-grid">
        <div class="uk-width-2-3">
            <div class="uk-margin">
                @if(isset($titleObj->logotype) && $titleObj->logotype != null)
                    <img src="/storage/files/{{ App\Files::find($titleObj->logotype)->filename }}"
                         alt="">
                @endif
            </div>
            <div class="uk-margin">
                {!! $titleObj->title !!}
            </div>
            <div class="uk-margin">
                {!! $titleObj->sub_title !!}
            </div>
            <div class="uk-margin">
                {!! $titleObj->text !!}
            </div>
        </div>
        <div class="uk-width-1-3">
            @if($titleObj->form != null)
                <div class="title" style="text-transform: uppercase;">{{ $form->title }}</div>
                <p style="text-transform: uppercase;">{{ $form->sub_title }}</p>
                <form action="#" method="post" class="for_form">
                    @forelse($fields as $field)
                        <input type="{{$field['type']}}"
                               name="{{ $field['name'] }}"
                               placeholder="{{ $field['placeholder'] }}"
                               @if($field['required']===true) required @endif>
                    @empty
                    @endforelse
                    <div class="gradient-button">
                        <input type="submit" value="{{ $form->button }}">
                        <div class="container-shadow">{{ $form->button }}</div>
                    </div>
                </form>
            @else
                <h1>Форма не создана</h1>
            @endif
        </div>
    </div>
</div>

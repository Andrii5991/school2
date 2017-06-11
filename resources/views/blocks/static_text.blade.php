@forelse($texts as $text)
    <hr class="uk-divider-icon">
    <div class="container">
        @include("$text->location_image")
    </div>
@empty
@endforelse
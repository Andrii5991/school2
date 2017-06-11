@if(count($breadcrumb))
	<div class="uk-container">
	<ul class="uk-breadcrumb">
		@foreach($breadcrumb as $item)
			@if(isset($item['href']))
				<li>
					<a href="{{ $item['href'] }}">
						{{ strip_tags($item['text']) }}
					</a>
				</li>
			@else
				<li class="uk-active">
					<span>
						{{ strip_tags($item['text']) }}
					</span>
				</li>
			@endif
		@endforeach
	</ul>
	</div>
@endif
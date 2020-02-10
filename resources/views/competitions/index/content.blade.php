<div class="container">
    <div class="row competitions-list">
		@foreach ($competitions as $competition)
			@include('competitions.index.card_data')
		@endforeach
    </div>
</div>

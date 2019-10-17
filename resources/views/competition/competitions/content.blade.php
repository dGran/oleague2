<div class="container">
    <div class="row" style="padding-bottom: 15px">
		@foreach ($competitions as $competition)
			@include('competition.competitions.card_data')
		@endforeach
    </div>

</div>

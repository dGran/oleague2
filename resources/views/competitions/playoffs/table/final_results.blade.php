<h4>Resultados finales</h4>
<div class="col-12 col-lg-6 p-0">
	<figure class="logo_winner animated fadeInRight">
		<img src="{{ asset($playoff->winner()->participant->logo()) }}">
	</figure>
	<div class="final-results shadow-sm compressed animated zoomIn">
		@foreach ($playoff->rounds->sortByDesc('id') as $round)
			@if ($round->is_last_round())
				<div class="row py-1">
					<div class="col-6 round-name">
						Campeón
					</div>
					<div class="col-6" style="font-weight: bold">
						<span>{{ $playoff->winner()->participant->sub_name() }}</span></strong>
					</div>
				</div>
				<div class="row py-1">
					<div class="col-6 round-name">
						Subcampeón
					</div>
					<div class="col-6">
						<span>{{ $playoff->subchampion()->participant->sub_name() }}</span>
					</div>
				</div>
			@else
				<div class="row py-1 mt-1">
					<div class="col-6 round-name">
						<small class="d-block">{{ $round->name }}</small>
					</div>
					<div class="col-6">
						@foreach ($round->participants as $participant)
							@if (!$participant->exist_in_next_round())
								<small class='d-block'>{{ $participant->participant->participant->sub_name() }}</small>
							@endif
						@endforeach
					</div>
				</div>
			@endif
		@endforeach
		<button id="show_button" class="btn btn-light">Resultados completos</button>
	</div> {{-- final-results --}}
</div>
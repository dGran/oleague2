<div class="teams">

	<div class="header">
		<div class="container">
			<div class="row m-0">
		    	<div class="col-12 text-right pt-3">
					@if ($seasons->count()>1)
						<select class="selectpicker btn-light" id="season_selector">
							@foreach ($seasons as $season)
								<option {{ $season->slug == $season_slug ? 'selected' : '' }} value="{{ route('market.teams', $season->slug) }}">
									{{ $season->name }}
								</option>
							@endforeach
						</select>
					@endif
		    	</div>
			</div>
			<h2 class="text-center">
				Listado de equipos
			</h2>
		</div> {{-- container --}}
	</div> {{-- header --}}

	<section class="content">
		<div class="container">
			<div class="row pb-4 px-2">
			@foreach ($participants as $participant)
				<div class="col-12 col-md-6 col-lg-4 col-xl-3">
					@include('market.teams.card_data')
				</div>
			@endforeach
			</div>
		</div>
	</section> {{-- content --}}

</div> {{-- teams --}}
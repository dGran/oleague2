<div class="playoffs">
	<div class="container py-3">
		<div class="playoffs-box">
			@if ($playoff->rounds->count()>0)
				<table class="playoffs-table">
					<thead>
						<tr>
							@foreach ($playoff->rounds as $round)
								<th>
									{{ $round->name }}
								</th>
								{{-- if not is last round --}}
								<th></th>
								<th></th>
							@endforeach
						</tr>
					</thead>
					<tbody>
						@foreach ($playoff->rounds as $key_round => $round)
							@foreach ($round->clashes as $key => $clash)
								<tr>
									<td class="clash local">
										{{ $clash->local_participant->participant->name() }}
									</td>
									@if (!$round->is_last_round() && even_number($key + 1)) {{-- even --}}
										<td class="clash line bottom right">par {{$key+1}}</td>
									@endif
								</tr>
								<tr>
									<td class="clash visitor">
										{{ $clash->visitor_participant->participant->name() }}
									</td>
									@if (!$round->is_last_round() && !even_number($key + 1)) {{-- odd --}}
										<td class="clash line top right">impar {{$key+1}}</td>
									@endif
								</tr>

								@for ($i = 0; $i <= ($key_round)*2; $i++)
									<tr>
										<td colspan="2"></td>
										<td class="clash local">
											{{ $clash->local_participant->participant->name() }}
										</td>
										@if (!$round->is_last_round() && even_number($key + 1)) {{-- even --}}
											<td class="clash line bottom right">par {{$key+1}}</td>
										@endif
									</tr>
									<tr>
										<td colspan="2"></td>
										<td class="clash visitor">
											{{ $clash->visitor_participant->participant->name() }}
										</td>
										@if (!$round->is_last_round() && !even_number($key + 1)) {{-- odd --}}
											<td class="clash line top right">impar {{$key+1}}</td>
										@endif
									</tr>
									</tr>
								@endfor

{{-- 								@if (!$round->is_last_round())
									@for ($i = 0; $i < ($key_round+1)*2; $i++)
										<tr><td colspan="2" class="clash line right">&nbsp;</td></tr>
									@endfor
								@endif --}}

							@endforeach
						@endforeach



					</tbody>
				</table> {{-- playoffs-table --}}
			@else
				El cuadro de eliminatorias está en fase de preparación
			@endif
		</div> {{-- playofffs-box --}}

	</div> {{-- container --}}

</div> {{-- playoffs --}}

<div class="playoffs">
	@if ($playoff->rounds->count()>0)
{{$playoff->winner()}}
		@if ($playoff->winner())
			<div class="row justify-content-center">
				<div class="col-12 px-3 px-md-0 py-3">
					<div class="clearfix container">
						<div class="float-left animated rubberBand">
							<div class="d-inline-block align-middle">
								<figure class="bg-white border rounded-circle m-0 shadow" style="padding: 10px">
									<img src="{{ $playoff->winner()->logo() }}" width="40">
								</figure>
							</div>
							<div class="d-inline-block align-middle pl-2">
								<strong>{{ $playoff->winner()->name() }}</strong>
								<small class="text-muted d-block">
									{{ $playoff->winner()->sub_name() }}
								</small>
							</div>
						</div>
						<div class="float-right text-center animated bounceInDown delay-2s">
							<img src="https://media.giphy.com/media/eMmj4M254X9sFu06jQ/giphy.gif" alt="" width="40">
							{{-- <img src="https://thumbs.gfycat.com/SpryGrotesqueIvorybilledwoodpecker-max-1mb.gif" width="60"> --}}
							{{-- <img src="https://media.tenor.com/images/9f208823ef7db08e4b3c2aeef043266e/tenor.gif" width="48"> --}}
							<div style="font-size: .7em; font-weight: bold; text-transform: uppercase; padding-top: 4px">
								Campeón
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif

		@foreach ($playoff->rounds->sortByDesc('id') as $round)
			<div class="round">
				<div class="container px-4 py-2">
					<span class="name">{{ $round->name }}</span>
				</div>
			</div>
			@if ($round->clashes->count()>0)
				<div class="container py-3">
				@foreach ($round->clashes as $clash)
					<div class="row m-0">
						@foreach ($clash->matches as $match)
							@include('competitions.playoffs.table.match')
						@endforeach
					</div>
					<div>
						<div class="clash-winner pt-1 pb-3 px-3" style="font-size: .8em; color: ##64798D">
							@if (!$round->is_last_round())
								@if (!$clash->winner())
									<strong style="color: gray">Eliminatoria no disputada</strong>
								@else
									<strong>Clasificado: </strong>{{ $clash->winner()->name() }}
								@endif
							@endif
						</div>
					</div>
				@endforeach
				</div>
			@else
				<div class="row py-4 m-0">
					<div class="col-12">
						<div class="text-center">
							No existen eliminatorias
						</div>
					</div>
				</div>
			@endif
		@endforeach
	@else
		No existen rondas
	@endif
</div>
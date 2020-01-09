<div class="playoffs pb-4">
	<div class="container p-3 py-md-3 px-md-0">
		<div class="playoffs-box">
			@if ($playoff->rounds->count()>0)
				@foreach ($playoff->rounds as $key_round => $round)
					<table class="playoffs-table">
						<thead>
							@if ($round->clashes->count()>0)
								<tr>
									<th>{{ $round->name }}</th>
								</tr>
							@endif
						</thead>
						<tbody>
							@include('competitions.playoffs.table.clashes')
						</tbody>
					</table>
				@endforeach
			@else
				El cuadro de eliminatorias está en fase de preparación
			@endif
		</div> {{-- playofffs-box --}}
	</div> {{-- container --}}
</div> {{-- playoffs --}}
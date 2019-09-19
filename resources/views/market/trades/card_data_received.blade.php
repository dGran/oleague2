<tr class="date">
	<td colspan="9" class="text-muted">
		<small>Oferta recibida: {{ $trade->created_at }}</small>
	</td>
</tr> {{-- date --}}

<tr class="data">
	<td width="32">
		<img src="{{ $trade->participant1->logo() }}" width="32">
	</td>
	<td>
		{{ $trade->participant1->name() }}
		<small class="d-block">
			{{ $trade->participant1->sub_name() }}
		</small>
	</td>
	<td width="40" class="text-right">
		<span class="badge badge-primary">pendiente</span>
	</td>
</tr> {{-- data --}}

<tr class="detail">
	<td colspan="9">
		<div class="row" style="font-size: .8em">
			<div class="col-6 text-right">
				<span class="text-uppercase" style="font-size: .9rem">
					<strong>Ofrece</strong>
				</span>
				<span class="d-block py-1 {{ $trade->cash2 == 0 ? 'text-muted' : '' }}">
					{{ $trade->cash2 }} M.
				</span>
				@foreach ($trade->detail as $detail)
					<span class="d-block">
						@if ($detail->player2)
							<span style="line-height: 20px">
								{{ $detail->player2->player->name }} ({{ $detail->player2->player->position }}-{{ $detail->player2->player->overall_rating }})
							</span>
							<img src="{{ $detail->player2->player->getImgFormatted() }}" width="20">
						@endif
					</span>
				@endforeach
			</div>

			<div class="col-6 text-left">
				<span class="text-uppercase" style="font-size: .9rem">
					<strong>Solicita</strong>
				</span>
				<span class="d-block py-1 {{ $trade->cash1 == 0 ? 'text-muted' : '' }}">
					{{ $trade->cash1 }} M.
				</span>
				@foreach ($trade->detail as $detail)
					<span class="d-block">
						@if ($detail->player1)
							<img src="{{ $detail->player1->player->getImgFormatted() }}" width="20">
							<span style="line-height: 20px">
								({{ $detail->player1->player->position }}-{{ $detail->player1->player->overall_rating }}) {{ $detail->player1->player->name }}
							</span>
						@endif
					</span>
				@endforeach
			</div>
		</div> {{-- row --}}

		<div class="row">
			<div class="col-12 text-center py-2">
				<span class="text-success d-block py-2">
					<i class="fas fa-check"></i> Oferta valida
				</span>

				<a href="" class="btn btn-primary brn-sm" style="font-size: .9em">
					Aceptar oferta
				</a>
				<a href="" class="btn btn-danger brn-sm" style="font-size: .9em">
					Rechazar oferta
				</a>
			</div>
		</div> {{-- row --}}

		<div class="row">
			<div class="col-12" style="font-size: .8em">
				<span class="text-warning d-block">
					<i class="fas fa-exclamation-triangle"></i> Plantilla de {{ $trade->participant1->name() }} quedará fuera de los līmites
				</span>
				<span class="text-warning d-block">
					<i class="fas fa-exclamation-triangle"></i> Hay jugadores que ya no pertenecen a los equipos
				</span>
			</div>
		</div> {{-- row --}}

	</td>
</tr> {{-- detail --}}

{{--
<tr>
	<td colspan="9" class="text-center">
		<span>
			{{ $trade->created_at }}
		</span>
		<figure class="text-center d-block mb-2">
			<img src="{{ $trade->participant1->logo() }}" width="60">
		</figure>
		<h5>
			{{ $trade->participant1->name() }}
			<small class="d-block">
				{{ $trade->participant1->sub_name() }}
			</small>
		</h5>
	</td>
</tr>

<tr>
	<td class="text-center border-right px-2">
		<span>
			Ofrece
		</span>
		<span class="d-block">
			{{ $trade->cash2 }}
		</span>
		<h5>
			Jugadores
		</h5>
		@foreach ($trade->detail as $detail)
			<span class="d-block">
				@if ($detail->player2)
					<img src="{{ $detail->player2->player->getImgFormatted() }}" width="20">
					{{ $detail->player2->player->name }} ({{ $detail->player2->player->position }} - {{ $detail->player2->player->overall_rating }})
				@endif
			</span>
		@endforeach
	</td>

	<td class="text-center px-2">
		<span>
			Solicita
		</span>
		<span class="d-block">
			{{ $trade->cash1 }}
		</span>
		<h5>
			Jugadores
		</h5>
		@foreach ($trade->detail as $detail)
			<span class="d-block">
				@if ($detail->player1)
					<img src="{{ $detail->player2->player->getImgFormatted() }}" width="20">
					{{ $detail->player1->player->name }} ({{ $detail->player1->player->position }} - {{ $detail->player1->player->overall_rating }})
				@endif
			</span>
		@endforeach
	</td>

</tr>
 --}}
<div style="background: #F2F2F2; border-bottom: 1px solid #f1eff3; padding: 1rem .5rem 1rem .5rem; color: #4ea800; font-weight: 400; font-size: 28px; line-height: 1.3em;">
	<div class="container">
		Nueva negociación
	</div>
</div>
<div class="container py-3">


	<div class="row">
		<div class="col-12 col-md-6 px-3">
			<div class="pb-3">
				<img src="{{ participant_of_user()->logo() }}" width="55" class="d-inline-block align-middle">
				<div class="d-inline-block align-middle">
					<strong>
						{{ participant_of_user()->name() }}
					</strong>
					<small class="d-block">
						{{ participant_of_user()->sub_name() }}
					</small>
				</div>
			</div>

			<div class="form-group">
				<input type="number" class="form-control" value="0">
			</div>

            <select name="p1_players" id="p1_players" class="form-control selectpicker show-tick" data-size="5" title="Selecciona jugadores..." multiple data-selected-text-format="count">
                @foreach (participant_of_user()->players as $player)
                	<option title="{{ $player->player->name }}" data-content="<img class='mr-1' src='{{ $player->player->getImgFormatted() }}' width='20'><span>{{ $player->player->name }}</span><small class='text-muted'>{{ $player->player->position }}-{{ $player->player->overall_rating }}</small>" value="{{ $player->id }}" style="font-size: .8em"></option>
                @endforeach
            </select>
		</div>
		<div class="col-12 col-md-6 mt-4 mt-md-0 px-3">
			<div class="pb-3">
				<img src="{{ $participant->logo() }}" width="55" class="d-inline-block align-middle">
				<div class="d-inline-block align-middle">
					<strong>
						{{ $participant->name() }}
					</strong>
					<small class="d-block">
						{{ $participant->sub_name() }}
					</small>
				</div>
			</div>

			<div class="form-group">
				<input type="number" class="form-control" value="0">
			</div>

            <select name="p1_players" id="p1_players" class="form-control selectpicker show-tick" data-size="5" title="Selecciona jugadores..." multiple data-selected-text-format="count">
                @foreach ($participant->players as $player)
                	<option title="{{ $player->player->name }}" data-content="<img class='mr-1' src='{{ $player->player->getImgFormatted() }}' width='20'><span>{{ $player->player->name }}</span><small class='text-muted'>{{ $player->player->position }}-{{ $player->player->overall_rating }}</small>" value="{{ $player->id }}" style="font-size: .8em"></option>
                @endforeach
            </select>
		</div>
	</div> {{-- row --}}

	<div class="row">
		<div class="col-12 pt-4 pb-2 mt-4 text-center">
			<input type="submit" class="btn btn-primary" value="Enviar oferta">
		</div>
	</div>

</div>
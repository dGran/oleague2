@foreach ($round->clashes as $key_clash => $clash)
	<tr>
		<td class="clash local {{ $clash->winner() && $clash->winner()->id == $clash->local_participant->participant->id ? 'winner' : '' }}">
			@include('competitions.playoffs.table.clash_local_data')
		</td>
		@if (!$round->is_last_round()) {{-- even --}}
			<td class="line bottom {{ even_number($key_clash + 1) ? 'right' : '' }}"></td>
		@endif
	</tr>
	<tr>
		<td class="clash visitor {{ $clash->winner() && $clash->winner()->id == $clash->visitor_participant->participant->id ? 'winner' : '' }}">
			@include('competitions.playoffs.table.clash_visitor_data')
		</td>
		@if (!$round->is_last_round() && !even_number($key_clash + 1)) {{-- odd --}}
			<td class="line right"></td>
		@endif
	</tr>
	@if ($key_clash + 1 < $round->clashes->count())
		@for ($i = 1; $i < (round_spaces($key_round+1)); $i++)
			<tr>
				<td>&nbsp;</td>
				<td class="line {{ !$round->is_last_round() && !even_number($key_clash + 1) ? 'right' : '' }}">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="line {{ !$round->is_last_round() && !even_number($key_clash + 1) ? 'right' : '' }}">&nbsp;</td>
				@if (round_spaces($key_round+1)/2 == $i)
					<td class="line {{ !$round->is_last_round() && !even_number($key_clash + 1) ? 'top' : '' }}">&nbsp;</td>
				@else
					<td class="line {{ !$round->is_last_round() && !even_number($key_clash + 1) ? '' : '' }}">&nbsp;</td>
				@endif
			</tr>
		@endfor
	@endif

@endforeach
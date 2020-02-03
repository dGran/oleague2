<div class="clearfix participant local">
	@if ($clash->local_id > 0)
		<div class="logo">
			<img src="{{ $clash->local_participant->participant->logo() }}">
		</div>
		<div class="name text-truncate">
			{{ $clash->local_participant->participant->name() }}
		</div>
		@if ($round->round_trip)
			<div class="result"> {{-- 2nd match --}}
				@if ($round->round_trip)
					{{ $clash->result()[1]['visitor'] }}
					@if (!is_null($clash->result()[1]['pen_visitor']))
						<small>({{ $clash->result()[1]['pen_visitor']}})</small>
					@endif
				@else
					{{ $clash->result()['local'] }}
					@if (!is_null($clash->result()['pen_local']))
						<small>({{ $clash->result()['pen_local']}})</small>
					@endif
				@endif
			</div>
		@endif
		<div class="result"> {{-- 1st match --}}
			@if ($round->round_trip)
				{{ $clash->result()[0]['local'] }}
				@if (!is_null($clash->result()[0]['pen_local']))
					<small>({{ $clash->result()[0]['pen_local']}})</small>
				@endif
			@else
				{{ $clash->result()['local'] }}
				@if (!is_null($clash->result()['pen_local']))
					<small>({{ $clash->result()['pen_local']}})</small>
				@endif
			@endif
		</div>
	@endif
</div>
<div class="clearfix participant visitor">
	@if ($clash->visitor_id > 0)
		<div class="logo">
			<img src="{{ $clash->visitor_participant->participant->logo() }}">
		</div>
		<div class="name text-truncate">
			{{ $clash->visitor_participant->participant->name() }}
		</div>
		@if ($round->round_trip)
			<div class="result"> {{-- 2nd match --}}
				@if ($round->round_trip)
					{{ $clash->result()[1]['local'] }}
				@else
					{{ $clash->result()['visitor'] }}
				@endif
			</div>
		@endif
		<div class="result"> {{-- 1st match --}}
			@if ($round->round_trip)
				{{ $clash->result()[0]['visitor'] }}
			@else
				{{ $clash->result()['visitor'] }}
			@endif
			@if (!is_null($clash->result()['pen_visitor']))
				<small>({{ $clash->result()['pen_visitor']}})</small>
			@endif
		</div>
	@endif
</div>
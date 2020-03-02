<div class="row justify-content-center">
	<div class="col-12 col-md-10 col-lg-8 px-3 px-md-0 py-3">
		<div class="clearfix">
			<div class="float-left animated rubberBand">
				<div class="d-inline-block align-middle">
					<figure class="bg-white border rounded-circle m-0 shadow" style="padding: 10px">
						<img src="{{ $table_participants->first()['participant']->participant->logo() }}" width="40">
					</figure>
				</div>
				<div class="d-inline-block align-middle pl-2">
					<strong>{{ $table_participants->first()['participant']->participant->name() }}</strong>
					<small class="text-muted d-block">
						{{ $table_participants->first()['participant']->participant->sub_name() }}
					</small>
				</div>
			</div>
			<div class="float-right text-center animated bounceInDown delay-2s">
				@if ($league->has_winner())
					<img src="https://media.giphy.com/media/llUeFDNRaLWvokhbat/source.gif" width="70" class="rounded-circle border shadow">
				@else
					<img src="https://media.giphy.com/media/eMmj4M254X9sFu06jQ/giphy.gif" alt="" width="40">
					<div style="font-size: .7em; font-weight: bold; text-transform: uppercase; padding-top: 4px">Líder</div>
				@endif
			</div>
		</div>
	</div>
</div>
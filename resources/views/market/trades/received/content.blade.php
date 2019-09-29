<div class="negotiations">

	<div class="header">
		<div class="container p-0">
			<img class="logo" src="{{ participant_of_user()->logo() }}">
			<div class="participant">
				<span class="name">
					{{ participant_of_user()->name() }}
				</span>
				<span class="subname">
					<strong>Manager: </strong>{{ participant_of_user()->sub_name() }}
				</span>
			</div>
		</div>
	</div> {{-- header --}}


	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-12 col-md-8 p-0">

				<div class="selector">
					<ul class="nav nav-pills justify-content-center">
						<li class="nav-item">
							<a class="nav-link active" id="pills-received-tab" href="#">Ofertas recibidas</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="pills-received-tab" href="{{ route('market.trades.sent') }}">Ofertas enviadas</a>
						</li>
					</ul>
				</div>

				<section class="content">
					@if ($offers_received->count() > 0)
						@foreach ($offers_received as $trade)
							@include('market.trades.received.card_data')
						@endforeach
					@else
						@include('market.trades.received.card_data_empty')
					@endif
				</section> {{-- content --}}
			</div> {{-- col --}}


		</div> {{-- row --}}
	</div> {{-- container --}}

</div> {{-- negotiations --}}
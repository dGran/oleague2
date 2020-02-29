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

		<section class="content">

			<div class="p-3">
				<p>Ofertas recibidas pendientes de tu respuesta: {{ $offers_received }}</p>
				<a href="{{ route('market.trades.received', $season_slug) }}" class="btn btn-primary">Ofertas recibidas</a>
				<p class="pt-3">
					Ofertas enviadas esperando respuesta: {{ $offers_sent_pending }}
					<br>
					Ofertas enviadas esperando rechazadas: {{ $offers_sent_refushed }}
				</p>
				<a href="{{ route('market.trades.sent', $season_slug) }}" class="btn btn-primary">Ofertas enviadas</a>
			</div>

			<div class="p-3">
			<h4>Nueva negociación</h4>
				<ul>
					@foreach ($participants as $participant)
						<li>
							<a href="{{ route('market.trades.add', $participant->id) }}">
								Abrir negociación con {{ $participant->name() }}
							</a>
						</li>
					@endforeach
				</ul>
			</div>
		</section> {{-- content --}}
	</div> {{-- container --}}

	<div class="row m-0">
		<div class="col-12 mt-1 px-3 pt-3 border-top" style="color: #085460; background-color: #d1ecf1; border-top: 1px solid #bee5eb; font-size: .9em">
			<div class="container">
				<p class="text-justify">
					<small>
					*Puedes enviar ofertas ilimitadas y tener al mismo jugador en distintas ofertas simultáneamente.
					<br>
					*No se permiten ofertas sin ofrecer ni solicitar jugadores, es decir, envío de dinero.
					</small>
				</p>
			</div>
		</div>
	</div>
</div> {{-- negotiations --}}


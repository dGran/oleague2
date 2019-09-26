<div class="negotiations">

	<div class="header">
		<div class="container">
			<div class="scrolling-wrapper">
				<ul class="nav nav-pills nav-fill">
					<li class="nav-item">
						<a class="nav-link active" id="pills-received-tab" data-toggle="pill" href="#received" role="tab" aria-controls="received" aria-selected="true">Ofertas recibidas</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-sent-tab" data-toggle="pill" href="#sent" role="tab" aria-controls="sent" aria-selected="true">Ofertas enviadas</a>
					</li>
				</ul>
			</div> {{-- scrolling-wrapper --}}
		</div> {{-- container --}}
	</div> {{-- header --}}

	<div class="container">

		<section class="content">
			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active" id="received" role="tabpanel" aria-labelledby="home-tab">
					<div class="row justify-content-center">
						<div class="col-12 col-md-6">
							@include('market.trades.partials.received')
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="sent" role="tabpanel" aria-labelledby="home-tab">
					<div class="row justify-content-center">
						<div class="col-12 col-md-6">
							@include('market.trades.partials.sent')
						</div>
					</div>
				</div>
			</div> {{-- tab-content --}}
		</section> {{-- content --}}
	</div> {{-- container --}}
</div> {{-- sale --}}


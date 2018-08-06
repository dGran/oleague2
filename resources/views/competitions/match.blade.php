@extends('layouts.app')

@section('section')
    <section class="section">

    	<div class="container title py-1">
			<div class="row align-items-center">
				<div class="col py-2 py-md-0">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('competition') }}">Champions League</a></li>
							{{-- <li class="breadcrumb-item"><a href="{{ route('competitions') }}">Competiciones</a></li> --}}
						</ol>
					</nav>
				</div>
			</div>
		</div>

		<div class="row no-gutters">
	                <div class="match">
	                    <div class="local">
                    		<div class="participant">
	                    		<span class="team">
		                        	F.C.BARCELONA
	                    		</span>
		                        <span class="gamertag">
		                        	x pAdRoNe x
		                        </span>
                    		</div>
	                    	<figure class="logo">
	                        	<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/3.png" alt="">
	                        </figure>
	                    </div> {{-- local --}}
	                    <div class="result">3 - 1</div>
	                    <div class="visitor">
	                    	<figure class="logo">
	                        	<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/1.png" alt="">
	                        </figure>
                    		<div class="participant">
	                    		<span class="team">
		                        	REAL MADRID
	                    		</span>
		                        <span class="gamertag">
		                        	ferminnn
		                        </span>
                    		</div>
	                    </div> {{-- visitor --}}
	                </div> {{-- match --}}
		</div>

	</section>
@endsection

@section('content')

	<div class="container">
		<div class="row no-gutters mt-3">
			<div class="col-6 border-right text-right pr-3">
				<span class="d-block">
					L. Messi
					&nbsp;
					<i class="fas fa-futbol"></i>
				</span>
				<span class="d-block">
					L. Messi
					&nbsp;
					<i class="fas fa-futbol"></i>
				</span>
				<span class="d-block">
					L. Suarez
					&nbsp;
					<i class="fas fa-futbol"></i>
				</span>
				<span class="d-block">
					A. Vidal
					&nbsp;
					<i class="fas fa-square" style="color: #fff80b"></i>
				</span>
			</div>
			<div class="col-6 text-left pl-3">
				<span class="d-block">
					<i class="fas fa-futbol"></i>
					&nbsp;
					C. Ronaldo
				</span>
				<span class="d-block">
					<i class="fas fa-square" style="color: red"></i>
					&nbsp;
					S. Ramos
				</span>
			</div>
		</div> {{-- row --}}

		<div class="row no-gutters mt-3">
			<div class="col-3 text-center">
				<figure class="mb-2">
					<img src="http://pesdb.net/pes2018/images/players/player_7511.png" alt="" width="96" class="rounded-circle bg-white border">
				</figure>
				<span class="d-block"><strong>M.V.P.</strong></span>
				L. Messi - F.C.Barcelona
			</div>
			<div class="col-9">
				<div class="card">
					<div class="card-header">
						Cronica
					</div>
					<div class="card-body">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est alias deleniti sunt eius, asperiores voluptatibus nulla autem. Facilis quidem consequuntur ex excepturi ea cum ipsum iusto. Rem, illo dignissimos reprehenderit. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi dolore excepturi eum quaerat dicta modi eveniet enim consectetur vel ducimus, vitae nemo id laboriosam eos beatae illum laborum reprehenderit voluptate! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt qui delectus iste rem voluptate assumenda porro repellat rerum nostrum tempore, dicta pariatur quisquam blanditiis, similique veritatis numquam sed. Esse, tenetur.
					</div>
				</div>
			</div>

		</div> {{-- row --}}

	</div> {{-- container --}}

@endsection
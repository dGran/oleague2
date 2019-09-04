<div class="modal-content">

    <div class="modal-header info">
    	<h4>{{ $player->player->name }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
    	<div class="row justify-content-center p-1 p-lg-3">
			<div class="col-12 col-sm-5 mb-3 mb-md-0">
				<div class="card">
					<img class="img" src="{{ $player->player->getImgFormatted() }}">
					<span class="position">
						{{ $player->player->position }}
					</span>
					<span class="overall">
						{{ $player->player->overall_rating }}
					</span>
					<figure class="ball">
						<img src="{{ asset($player->player->getBall()) }}">
					</figure>
				</div>
			</div>

			<div class="col-12 col-sm-7">
	            <div class="details" style="font-size: .9em">
	            	<div class="detail-item clearfix">
	            		<span class="title">
	            			Equipo
	            		</span>
	            		<div class="data">
	            			@if ($player->participant)
	                        	{{ $player->participant->name() }}
	                        @endif
	            		</div>
	            	</div>
	            	<div class="detail-item clearfix">
	            		<span class="title">
	            			Manager
	            		</span>
	            		<div class="data">
	            			@if ($player->participant)
	                        	{{ $player->participant->sub_name() }}
	                        @endif
	            		</div>
	            	</div>
	            	<div class="detail-item clearfix">
	            		<span class="title">
	            			Salario
	            		</span>
	            		<div class="data">
	                        {{ number_format($player->salary, 2, ',', '.') }} M.
	            		</div>
	            	</div>
	            	<div class="detail-item clearfix">
	            		<span class="title">
	            			Claúsula
	            		</span>
	            		<div class="data">
	                        {{ number_format($player->price, 2, ',', '.') }} M.
	            		</div>
	            	</div>
	            	<div class="detail-item clearfix border-0">
	            		<span class="title">
	            			<i class="fab fa-gratipay mr-1 {{ num_favourite_player($player->id) > 0 ? 'text-danger' : '' }}"></i>Seguidores
	            		</span>
	            		<div class="data">
	                        {{ number_format(num_favourite_player($player->id), 0, ',', '.') }}
	            		</div>
	            	</div>

	            	<div class="detail-item clearfix mt-3">
	            		<span class="title">
	            			Edad
	            		</span>
	            		<div class="data">
	                        @if ($player->player->age)
	                            {{ $player->player->age }} años
	                        @endif
	            		</div>
	            	</div>
	            	<div class="detail-item clearfix">
	            		<span class="title">
	            			Altura
	            		</span>
	            		<div class="data">
	                        @if ($player->player->height)
	                            {{ $player->player->height }} cm
	                        @endif
	            		</div>
	            	</div>
	            	<div class="detail-item clearfix">
	            		<span class="title">
	            			Nacionalidad
	            		</span>
	            		<div class="data">
	                        @if ($player->player->nation_name)
	                            {{ $player->player->nation_name }}
	                        @endif
	            		</div>
	            	</div>
	            	<div class="detail-item clearfix">
	            		<span class="title">
	            			*Equipo
	            		</span>
	            		<div class="data">
	                        @if ($player->player->team_name)
	                            {{ $player->player->team_name }}
	                        @endif
	            		</div>
	            	</div>
	            	<div class="detail-item clearfix border-0">
	            		<span class="title">
	            			*Liga
	            		</span>
	            		<div class="data">
	                        @if ($player->player->league_name)
	                            {{ $player->player->league_name }}
	                        @endif
	            		</div>
	            	</div>
	        	</div>
	        </div>
		</div>
	</div>

    <div class="modal-bottom">
        @if ($player->player->game_id)
            <a target="_blank" href="{{ pesdb_player_info_path($player->player->game_id) }}">+info en pesdb.net</a>
            <a target="_blank" href="{{ pesmaster_player_info_path($player->player->game_id) }}">+info en pesmaster.com</a>
        @endif
    </div>

</div>
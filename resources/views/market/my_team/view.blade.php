<div class="modal-content">

    <div class="modal-header" style="background-color: #e2e2e4">
    	<h4 class="m-0">{{ $player->player->name }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
    	<div class="row justify-content-center p-1 p-lg-3">
			<div class="col-12 col-sm-5 col-md-5 col-lg-3 mb-3 mb-md-0">
				<div class="border rounded" style="width: 160px; height: 120px; position: relative; background: rgba(139,160,184,1);
background: -moz-linear-gradient(top, rgba(139,160,184,1) 0%, rgba(162,179,199,1) 50%, rgba(255,255,255,1) 100%);
background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(139,160,184,1)), color-stop(50%, rgba(162,179,199,1)), color-stop(100%, rgba(255,255,255,1)));
background: -webkit-linear-gradient(top, rgba(139,160,184,1) 0%, rgba(162,179,199,1) 50%, rgba(255,255,255,1) 100%);
background: -o-linear-gradient(top, rgba(139,160,184,1) 0%, rgba(162,179,199,1) 50%, rgba(255,255,255,1) 100%);
background: -ms-linear-gradient(top, rgba(139,160,184,1) 0%, rgba(162,179,199,1) 50%, rgba(255,255,255,1) 100%);
background: linear-gradient(to bottom, rgba(139,160,184,1) 0%, rgba(162,179,199,1) 50%, rgba(255,255,255,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#8ba0b8', endColorstr='#ffffff', GradientType=0 );">
					<img src="{{ $player->player->getImgFormatted() }}" alt="" width="100" style="position: absolute; bottom: 0; left: 30px">
					<span class="text-center" style="color: white; width: 35px; font-size: 1.2em; font-weight: bold; position: absolute; top: 2px; left: 5px">
						{{ $player->player->position }}
					</span>
					<span class="text-center" style="width: 35px; color: white; font-size: 1.6em; font-weight: bold; position: absolute; top: 20px; left: 5px">
						{{ $player->player->overall_rating }}
					</span>
					<figure style="position: absolute; top: 8px; right: 8px;">
						<img src="{{ asset($player->player->getBall()) }}" style="width: 36px">
					</figure>
{{-- 					<figure style="position: absolute; top: 35px; right: 5px;">
						<img src="https://carwad.net/sites/default/files/russia-flag-png-transparent-images-149955-5284790.png" style="width: 25px">
					</figure> --}}
				</div>

				<div class="d-sm-none">
					<span class="badge badge-dark p-1" style="position: absolute; right: 0px; top: 5px; padding: 2px; opacity: .2">INTRANSFERIBLE</span>
					<span class="badge badge-dark p-1" style="position: absolute; right: 0px; top: 30px; padding: 2px;">TRANSFERIBLE</span>
					<span class="badge badge-dark p-1" style="position: absolute; right: 0px; top: 55px; padding: 2px;">CEDIBLE</span>
				</div>

				<div class="d-none d-sm-block">
					<div class="pt-2 pb-1">
						<span class="badge badge-dark p-1" style="padding: 2px; opacity: .2">INTRANSFERIBLE</span>
					</div>
					<div class="pb-1">
						<span class="badge badge-dark p-1" style="padding: 2px;">TRANSFERIBLE</span>
					</div>
					<div class="pb-1">
						<span class="badge badge-dark p-1" style="padding: 2px;">CEDIBLE</span>
					</div>
				</div>
			</div>

			<div class="col-12 col-sm-7 col-md-7 col-lg-9">
	            <div class="details" style="font-size: .9em">
	            	<div class="clearfix border-bottom py-2">
	            		<span class="float-left">
	            			Salario
	            		</span>
	            		<div class="float-right" style="color: #a5a5a7">
	                        {{ $player->salary }} M.
	            		</div>
	            	</div>
	            	<div class="clearfix border-bottom py-2">
	            		<span class="float-left">
	            			Claúsula
	            		</span>
	            		<div class="float-right" style="color: #a5a5a7">
	                        {{ $player->price }} M.
	            		</div>
	            	</div>
	            	<div class="clearfix border-bottom py-2">
	            		<span class="float-left">
	            			Edad
	            		</span>
	            		<div class="float-right" style="color: #a5a5a7">
	                        @if ($player->player->age)
	                            {{ $player->player->age }} años
	                        @endif
	            		</div>
	            	</div>
	            	<div class="clearfix border-bottom py-2">
	            		<span class="float-left">
	            			Altura
	            		</span>
	            		<div class="float-right" style="color: #a5a5a7">
	                        @if ($player->player->height)
	                            {{ $player->player->height }} cm
	                        @endif
	            		</div>
	            	</div>
	            	<div class="clearfix border-bottom py-2">
	            		<span class="float-left">
	            			Nacionalidad
	            		</span>
	            		<div class="float-right" style="color: #a5a5a7">
	                        @if ($player->player->nation_name)
	                            {{ $player->player->nation_name }}
	                        @endif
	            		</div>
	            	</div>
	            	<div class="clearfix border-bottom py-2">
	            		<span class="float-left">
	            			*Equipo
	            		</span>
	            		<div class="float-right" style="color: #a5a5a7">
	                        @if ($player->player->team_name)
	                            {{ $player->player->team_name }}
	                        @endif
	            		</div>
	            	</div>
	            	<div class="clearfix py-2">
	            		<span class="float-left">
	            			*Liga
	            		</span>
	            		<div class="float-right" style="color: #a5a5a7">
	                        @if ($player->player->league_name)
	                            {{ $player->player->league_name }}
	                        @endif
	            		</div>
	            	</div>
	        	</div>
	        </div>
		</div>
	</div>
{{--             <h5 class="m-0 p-2"><strong class="d-block">
                @if ($player->player->overall_rating)
                    <div class="d-inline-block">
                        {!! $player->player->getOverallRatingFormatted() !!}
                    </div>
                @endif
                @if ($player->player->position)
                    <div class="d-inline-block">
                        {!! $player->player->getPositionFormatted() !!}
                    </div>
                @endif
            </strong></h5> --}}
    <div class="modal-bottom p-3" style="background-color: #e2e2e4">
        @if ($player->player->game_id)
            <div class="" style="font-size: .9em">
                <a class="d-block" target="_blank" href="{{ pesdb_player_info_path($player->player->game_id) }}">+info en pesdb.net</a>
                <a class="d-block" target="_blank" href="{{ pesmaster_player_info_path($player->player->game_id) }}">+info en pesmaster.com</a>
            </div>
        @endif
    </div>

</div>
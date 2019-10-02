<h4 class="title-position border-bottom">
	<div class="container clearfix">
		<span>Sala de prensa</span>
	</div>
</h4>
<div class="container p-3">
	<h5 class="m-0">Declaraciones del club</h5>
	<div class="declarations-list py-2">
		@if ($presses->count() == 0)
			<div class="p-2 text-muted" style="font-size: .9em">
				No se han publicado declaraciones
			</div>
		@else
			<ul class="p-0">
				@foreach ($presses as $press)
					<li style="list-style: none" class="pb-3">
						<div class="declaration" style="font-size: .9em">
							<small class="text-muted">{{ $press->created_at->diffForHumans() }}</small>
							<div>
								<strong>{{ $press->title }}</strong>
							</div>
							<div class="text-muted pt-1">
								{{ $press->description }}
							</div>

						</div>
					</li>
				@endforeach
			</ul>
		@endif
	</div>

	@auth
		@if (user_is_participant(auth()->user()->id) && participant_of_user()->id == $participant->id)
			<div class="text-info mb-3">
				<small>Como manager del club, puedes convocar a la prensa para realizar breves declaraciones sobre cualquier tema relacionado con tu club <strong>una vez al día</strong>. Tus declaraciones además de aquí serán visibles en portada y en el canal de Telegram.</small>
			</div>

			@if (hours_to_new_press(participant_of_user()->id) == 0)
				<h5>Nueva declaración</h5>
				<form
				    id="frmEdit"
				    lang="{{ app()->getLocale() }}"
				    role="form"
				    method="POST"
				    action="{{ route('club.press.add', $participant->team->slug) }}"
				    enctype="multipart/form-data"
				    data-toggle="validator"
				    autocomplete="off"
				    style="font-size: .9em">
				    {{ csrf_field() }}

				    <div class="row">
				    	<div class="col-12">
						    <div class="form-group">
						    	<label class="m-0" for="title">Título</label>
						    	<small class="float-right d-none" id="title_counter">0 / 40</small>
						    	<input type="text" name="title" id="title" class="form-control" maxlength="40" placeholder="Escribe el titular" onkeyup="titleCounter()" onblur="titleCounterBlur()" onfocus="titleCounterFocus()" style="font-size: .9em">
						    </div>
							<div class="form-group">
								<label class="m-0" for="description">Descripción</label>
								<small class="float-right d-none" id="description_counter">0 / 120</small>
								<input type="text" class="form-control" name="description" id="description" onkeyup="descriptionCounter()" onblur="descriptionCounterBlur()" onfocus="descriptionCounterFocus()" maxlength="120" placeholder="Escribe la descripción" style="font-size: .9em">
							</div>

						    <div class="form-group">
						    	<input type="submit" class="btn btn-primary" value="Publicar declaración">
						    </div>
				    	</div>
				    </div>

				</form>
			@else
				<div class="text-danger">
					Debes esperar {{ hours_to_new_press(participant_of_user()->id) }} horas para poder publicar una nueva declaración...
				</div>
			@endif
		@endif
	@endauth
</div>
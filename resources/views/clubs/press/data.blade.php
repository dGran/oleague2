<div class="container">
	<div class="row">
		<div class="col-12">
			<ul>
			@foreach ($presses as $press)
				<li>
					<div>
						<small>{{ $press->created_at }}</small> - {{ $press->title }}

					</div>
				</li>
			@endforeach
			</ul>
		</div>
	</div>
	<form
	    id="frmEdit"
	    lang="{{ app()->getLocale() }}"
	    role="form"
	    method="POST"
	    action="{{ route('club.press.add', $participant->team->slug) }}"
	    enctype="multipart/form-data"
	    data-toggle="validator"
	    autocomplete="off">
	    {{ csrf_field() }}

	    <div class="row p-3">
	    	<div class="col-12">
			    <div class="form-group">
			    	<label for="title">Título</label>
			    	<small class="float-right d-none" id="title_counter">0 / 40</small>
			    	<input type="text" name="title" id="title" class="form-control" maxlength="40" placeholder="Escribe el titular" onkeyup="titleCounter()" onblur="titleCounterBlur()" onfocus="titleCounterFocus()">
			    </div>
				<div class="form-group">
					<label class="m-0" for="description">Descripción</label>
					<small class="float-right d-none" id="description_counter">0 / 120</small>
					<input type="text" class="form-control" name="description" id="description" onkeyup="descriptionCounter()" onblur="descriptionCounterBlur()" onfocus="descriptionCounterFocus()" maxlength="120" placeholder="Escribe la descripción">
				</div>

			    <div class="form-group">
			    	<input type="submit" class="btn btn-primary" value="Enviar nota de prensa">
			    </div>
	    	</div>
	    </div>

	</form>
</div>
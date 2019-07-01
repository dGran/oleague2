<div class="club-info">
	<h4 class="title-position">
		<div class="container clearfix">
			<span>Manager</span>
		</div>
	</h4>
	<div class="container p-3">
		@if ($participant->user->hasProfile())
			<img class="avatar rounded-circle" src="{{ $participant->user->profile->avatar }}">
		@endif
		<ul class="details">
			<li>
				Usuario: <strong>{{ $participant->user->name }}</strong>
			</li>
			<li>
				Localidad:
				@if ($participant->user->hasProfile())
					<strong>{{ $participant->user->profile->location }}</strong>
				@endif
			</li>
			<li>
				Edad:
				@if ($participant->user->hasProfile() && $participant->user->profile->age())
					<strong>{{ $participant->user->profile->age() }} años</strong>
				@endif
			</li>
			<li>
				Gamertag:
				@if ($participant->user->hasProfile())
					<strong>{{ $participant->user->profile->gamertag }}</strong>
				@endif
			</li>
		</ul>
		@if ($participant->user->hasProfile() && $participant->user->profile->gamertag)
			<img class="img-fluid pt-2" src="https://www.mygamerprofile.net/card/xosmall/{{ $participant->user->profile->gamertag }}.png" />
		@endif
	</div>
</div>
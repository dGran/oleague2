<div class="club-info">
	<h4 class="title-position border-bottom">
		<div class="container clearfix">
			<span>Manager</span>
		</div>
	</h4>
	<div class="container p-3" style="position : relative">
		@if ($participant->user && $participant->user->hasProfile())
			<img class="avatar" src="{{ asset($participant->user->profile->avatar) }}">
		@endif
		<ul class="details">
			<li>
				Usuario:
				@if ($participant->user && $participant->user->hasProfile())
					<strong>{{ $participant->user->name }}</strong>
				@endif
			</li>
			<li>
				Localidad:
				@if ($participant->user && $participant->user->hasProfile())
					<strong>{{ $participant->user->profile->location }}</strong>
				@endif
			</li>
			<li>
				Edad:
				@if ($participant->user && $participant->user->hasProfile() && $participant->user->profile->age())
					<strong>{{ $participant->user->profile->age() }} años</strong>
				@endif
			</li>
			<li>
				Gamertag:
				@if ($participant->user && $participant->user->hasProfile())
					<strong>{{ $participant->user->profile->gamertag }}</strong>
				@endif
			</li>
		</ul>
	</div>
</div>
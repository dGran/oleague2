<div class="club-header">
	<div class="container py-2">
		<div class="d-table-cell align-top">
			<img src="{{ $profile->getAvatarFormatted() }}" alt="Avatar">
		</div>
		<div class="d-table-cell pl-2 align-middle">
    		<h3>
    			{{ $profile->user->name }}
    		</h3>
    		<span class="subname">
    			{{ $profile->location }}
    		</span>
		</div>
	</div>
</div>
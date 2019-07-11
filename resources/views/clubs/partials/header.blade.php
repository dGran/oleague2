<div class="club-header">
	<div class="container py-2">
		<div class="d-table-cell align-top">
			<img src="{{ $participant->logo() }}" alt="">
		</div>
		<div class="d-table-cell pl-2 align-middle">
    		<h3>
    			{{ $participant->name() }}
    		</h3>
    		<span class="subname">
    			{{ $participant->sub_name() }}
    		</span>
		</div>
	</div>
</div>

<div class="club-menu">
	<div class="container">
		@include('clubs.partials.menu')
	</div>
</div>
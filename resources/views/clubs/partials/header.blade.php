<div class="club-header">
	<div class="container">
		<div class="d-table-cell align-top">
			<img src="{{ $participant->logo() }}" alt="">
		</div>
		<div class="d-table-cell pl-3 align-middle">
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
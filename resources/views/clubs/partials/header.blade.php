<div class="club-header">
	<div class="container py-2">
		<div class="d-table-cell align-top">
			<img src="{{ $participant->logo() }}" alt="" width="70">
		</div>
		<div class="d-table-cell pl-2 align-middle">
    		<h3 class="m-0 text-white">
    			{{ $participant->name() }}
    		</h3>
    		<span class="subname d-block text-white">
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
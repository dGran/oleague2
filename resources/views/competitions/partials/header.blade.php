<div class="competition-header">
	<div class="container">
		<div class="logo">
			<img src="{{ asset($group->phase->competition->img) }}" width="55" class="rounded">
		</div>
		<div class="title">
    		<h3>
    			{{ $group->phase->competition->name }}
    		</h3>
    		<span class="subtitle">
    			{{ active_season()->name }}
    		</span>
		</div>
	</div>
</div>

<div class="competition-menu">
	<div class="container">
		@include('competitions.partials.menu')
	</div>
</div>

@include('competitions.partials.phase_group_selector')

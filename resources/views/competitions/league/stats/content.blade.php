@include('competitions.league.stats.team_selector')

<div class="container">

	@if ($league->stats_goals)
		@include('competitions.league.stats.goals')
	@endif

	@if ($league->stats_assists)
		@include('competitions.league.stats.assists')
	@endif

	@if ($league->stats_yellow_cards)
		@include('competitions.league.stats.yellow_cards')
	@endif

	@if ($league->stats_red_cards)
		@include('competitions.league.stats.red_cards')
	@endif

</div>
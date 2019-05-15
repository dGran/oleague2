<p>
	Faltaría cambiar las query donde obtenemos las stats para que agrupe por jugador y sume los goles o bien no guardar por partido los goles lo cual nos haria perder las estadisticas de ese partido, por lo tanto INVIABLE
</p>
<p>
	o tabla stats donde guardamos los totales y stats detail donde guardamos el detalle de cada partido
</p>

<h1>Goles</h1>
<ul>
@foreach ($stats_goals as $stat)
	<li>{{ $stat->player->player->name }} - {{ $stat->goals }}</li>
@endforeach
</ul>

<h1>Asistencias</h1>
<ul>
@foreach ($stats_assists as $stat)
	<li>{{ $stat->player->player->name }} - {{ $stat->assists }}</li>
@endforeach
</ul>

<h1>Tarjetas amarillas</h1>
<ul>
@foreach ($stats_yellow_cards as $stat)
	<li>{{ $stat->player->player->name }} - {{ $stat->yellow_cards }}</li>
@endforeach
</ul>

<h1>Tarjetas rojas</h1>
<ul>
@foreach ($stats_red_cards as $stat)
	<li>{{ $stat->player->player->name }} - {{ $stat->red_cards }}</li>
@endforeach
</ul>
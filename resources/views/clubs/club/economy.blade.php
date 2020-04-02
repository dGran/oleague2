<div class="club-info pt-2">
	<div class="title-position">
		<div class="container clearfix">
			<h4>Economía</h4>
		</div>
	</div>
	<div class="container p-3">
		<ul class="details">
			<li>
				Presupuesto: <strong>{{ $participant->budget() }} M.</strong>
			</li>
			<li>
				Salarios: <strong>{{ $participant->salaries() }} M.</strong>
			</li>
			<li>
				Salario medio: <strong>{{ number_format($participant->salaries_avg(), 2) }} M.</strong>
			</li>
		</ul>
	</div>
</div>
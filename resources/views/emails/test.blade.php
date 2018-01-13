<html>
	<body>
		<h1 style="color: blue;">{{ $alert->name }}</h1>
		<p>Utilizatorul <b><u><a href="mailto:{{ $alert->user->email }}">{{ $alert->user->name }}</a></u></b> a postat o noua alerta. Ea este valabila de la <i>{{ $alert->start_timestamp }}</i> pana la <i>{{ $alert->end_timestamp }}</i> in locatia ({{ number_format($alert->lat, 3, '.', ',') }}, {{ number_format($alert->long, 3, '.', ',') }}).</p>
		<h3>Mesajul sau este urmatorul:</h3>
		<p>{{ $alert->description }}</p>
	</body>
</html>
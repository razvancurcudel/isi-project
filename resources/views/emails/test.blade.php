<html>
	<body>
		<h1 style="color: blue;">{{ $alert->name }}</h1>
		Utilizatorul <b>{{ $alert->user->name }} ({{ $alert->user->email }})</b> a postat o noua alerta. Ea este valabila de la <i>{{ $alert->start_timestamp }}</i> pana la <i>{{ $alert->end_timestamp }}</i> in locatia {{ $alert->lat }}, {{ $alert->long }}. <br><br>
		Mesajul sau este urmatorul: <br>
		{{ $alert->description }}
	</body>
</html>
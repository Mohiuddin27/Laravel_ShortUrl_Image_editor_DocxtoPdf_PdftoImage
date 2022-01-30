<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Links Directory</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="assets/css/style.css">
	</head>
	<body>
		<div class="container">
			<br><br>
			<a href="{{ route('welcome') }}">← Back to Home</a><br><br>
			<div class="jumbotron bg-success text-light">
				<h1 class="display-4">Links Directory</h1>
			</div>
			<table class="table">
				<thead>
				    <tr>
				      <th scope="col">Short Link</th>
				      <th scope="col">Destination</th>
				      <th scope="col">Date Added</th>
				      <th scope="col">User IP</th>
				      <th scope="col">Clicks</th>
				    </tr>
			    </thead>
				<tbody>
                        @foreach ($urls as $entries)
							<tr>
								<td><a href="{{ $entries->url }}" target="_blank">{{ $_SERVER['HTTP_HOST'].'/url/public/c/'.$entries->code }}<a></td>
				     			<td> {{ $entries->url }} </td>
				     			<td> {{ $entries->created_at->format('d/m/Y') }} </td>
				     			<td> {{ $entries->user_ip }} </td>
				     			<td> {{ $entries->clicks }} </td>
			     			</tr>
                        @endforeach
				</tbody>
			</table>
		</div>
	</body>
</html>
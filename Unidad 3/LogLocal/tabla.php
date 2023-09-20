<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>

<body>
	<div id="container_app">
		<h1>Welcome {{ logged }}</h1><br>

		<div>
			<h1>Users table</h1>
			<table>
			<tr>
				<th scope="col">Name</td>
				<th scope="col">Username</td>
				<th scope="col">E-mail</td>
				<th scope="col">Street</td>
				<th scope="col">City</td>
			</tr>
	
			<tr v-for = "user in users">
				<td>{{ user.name }}</td>
				<td>{{ user.username }}</td>
				<td>{{ user.email }}</td>
				<td>{{ user.address.street }}</td>
				<td>{{ user.address.city }}</td>
			</tr>

		</table>
		</div>
		
		
	</div>

	<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
	<script src="script.js"></script>
</body>
</html>
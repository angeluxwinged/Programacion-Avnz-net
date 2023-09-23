<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VUE.JS</title>

	<style>
		table {
			border:1px solid #b3adad;
			border-collapse:collapse;
			padding:5px;
		}
		table th {
			border:1px solid #b3adad;
			padding:5px;
			background: #f0f0f0;
			color: #313030;
		}
		table td {
			border:1px solid #b3adad;
			text-align:center;
			padding:5px;
			background: #ffffff;
			color: #313030;
		}

		.add-info{
			margin-top: 10px;
			margin-bottom: 10px;
		}

		.add-info input{
			text-align: center;
		}

		.container-addUsers{
			width: 200px;
			text-align: center;
		}
	</style>
</head>

<body>
    <div class="container" id="container_app">
		<div v-if="!logged || tableShow">
			<form>
				<fieldset>
					<legend>Login</legend>

					<label>E-mail</label>
					<input type="email" v-model="email">

					<label>Password</label>
					<input type="password" v-model="password">

					<button @click="login">Access</button>
				</fieldset>
			</form>
		</div>
		<div v-else>
			<h2>Table of Users</h2>
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

			<form action="">
				<div class="container-addUsers">
					<h3>Add a New User</h3>
					<div class="add-info">
						<label>Name:</label>
						<input type="text" v-model="name">
					</div>

					<div class="add-info">
						<label>Username:</label>
						<input type="text" v-model="username">
					</div>
					
					<div class="add-info">
						<label>Email:</label>
						<input type="text" v-model="email">
					</div>

					<div class="add-info">
						<label>Street:</label>
						<input type="text" v-model="street">
					</div>

					<div class="add-info">
						<label>City:</label>
						<input type="text" v-model="city">
					</div>

					<div class="add-info">
						<button type="button" v-on:click="addUser">Add New User</button>
					</div>
				</div>
			</form>
		</div>

    </div>

    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    
	<script>
		const { createApp, ref } = Vue

			createApp({
				setup() {
					return {
					users: ref([]),
					email: ref(''),
					password: ref(''),
					username: ref(''),
					logged: ref(localStorage.getItem('logged')),
					tableShow: ref(false),

					//push into users
					name: ref(''),
					username: ref(''),
					email: ref(''),
					street: ref(''),
					city: ref('')
					}
				},
					methods: {
						login(e) {
							e.preventDefault();
							var email_user = this.email;
							var passsword_user = this.password;
							
							var results = this.users.map(function(u) {
								return email_user.toLowerCase() === u.email.toLowerCase() && passsword_user === u.password;
							});

							if (results.includes(true)) {
								localStorage.setItem('logged', true);
								this.logged = localStorage.getItem('logged');
							} else {
								alert("Something went wrong...");
							}
						},

						addUser(){
							let usersToPush = {
								name: this.name,
								username: this.username,
								email: this.email,
								address: {
									street: this.street,
									city: this.city
								}
							};

								this.users.push(usersToPush)
							}
					},

				async mounted(){
					fetch('users.json')
					.then((res) => res.json())
					.then((json) => (this.users = json))
					.catch((err) => (console.log(err)))
				}
				
			}).mount('#container_app')
	</script>

</body>
</html>
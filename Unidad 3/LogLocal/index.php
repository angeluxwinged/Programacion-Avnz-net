<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VUE.JS</title>
</head>

<body>
    <div class="container" id="container_app">
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

    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="script.js"></script>
</body>
</html>
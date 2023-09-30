<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dist/css/login.css">
    <title>Login</title>
</head>

<body>
    <div class="container" id="container_app" v-cloak>
        <div class="login-page">
            <div v-if="loginForm">
                <h2>Crear una Cuenta</h2>
                <div class="form">
                    <form class="register-form">
                        <input type="text" placeholder="Nombre de usuario"/>
                        <input type="password" placeholder="Contraseña"/>
                        <input type="text" placeholder="Correo electronico"/>
                        <button>Crear</button>
                        <p class="message">¿Ya tiene una cuenta? <a type="button" @click="changeLoginForm" href="#">Iniciar Sesión</a></p>
                    </form>
                </div>
            </div>

            <div v-if="!loginForm">
                <h2>Iniciar Sesión</h2>
                <div class="form">
                    <form class="login-form" @submit.prevent="login">
                            <input  v-model="username" type="text" placeholder="Nombre de usuario"/>
                            <input  v-model="password" type="password" placeholder="Contraseña"/>
                            <button type="submit">login</button>
                            <p class="message">¿No te has registrado aún? <a type="button" @click="changeLoginForm" href="#">Crear una cuenta</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- VUE CDN -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <!-- VUE script -->
    <script src="dist/js/vue.js"> </script>
</body>
</html>
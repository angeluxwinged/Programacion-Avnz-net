<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>

    <style>
        [v-cloak] {
    display: none;
}

body{
    background: #03213a;
}

.container {
    color: #fff;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    padding: 20px;
}

.card {
    width: 350px;
    margin: 10px;
    border: 1px solid #2b2f33;
    border-radius: 5px;
    padding: 10px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    background-color: #1d5685;
}

.card-content {
    padding: 20px;
}

.card-title {
    font-size: 24px;
    font-weight: bolder;
    margin-bottom: 10px;
}

.card-text {
    background-color: #03213a;
    margin-top: 10px;
    border: 4px solid #1ad1b0;
    border-radius: 100px;
    color: white;
    padding: 10px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}

.card-date {
    color: rgb(240, 240, 240);
    margin-top: 10px;
    font-size: 16px;
}

.btn-details {
    background-color: #1ad1b0;
    margin-top: 10px;
    border: none;
    border-radius: 5px;
    color: white;
    padding: 10px 12px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
}

/* movie */
.movie{
    width: 100%;
}

.movie img{
    opacity: 20%;
    margin: 0;
    padding: 0;
    width: 100%;
    height: 650px;
    position: absolute;
}

.container-movie{
    color: #fff;
    display: flex;
}

.description{
    font-size: 16px;
}

.rate{
    margin-top: 10px;
    margin-bottom: 10px;
    position: relative;
}

.rate .btn-add{
    height: 30px;
    border-radius: 5px;
    margin: 5px;
    color: #fff;
    background: #eec407;
    cursor: pointer;
    border: 2px solid #272727;
}

.rate .btn-remove{
    height: 30px;
    border-radius: 5px;
    margin: 5px;
    color: #fff;
    background: #c61439;
    cursor: pointer;
    border: 2px solid #272727;
}

.poster img{
    opacity: unset;
    width: 300px;
    height: 500px;
    margin-left: 50px;
    margin-top: 70px;
    border-radius: 7px;
}

.movie-info{
    margin-left: 380px;
    margin-top: 150px;
}

.rate-icon{
    background-color: #03213a;
    border: 4px solid #1ad1b0;
    border-radius: 100px;
    padding: 10px 0;
    text-align: center;
    display: inline-block;
    font-size: 16px;
    margin-left: 10px;
    position: absolute;
    cursor: pointer;
    margin-top: 10px;
}

.rate-icon a{
    padding: 10px;
}

.fav-icon{
    background-color: #03213a;
    border: 4px solid #1ad1b0;
    border-radius: 100px;
    padding: 10px 0;
    text-align: center;
    display: inline-block;
    font-size: 16px;
    margin-left: 10px;
    position: absolute;
    cursor: pointer;
    margin-top: 10px;
    margin-left: 70px;
}

.fav-icon a{
    padding: 10px;
}
    </style>
</head>

<body>
    <div class="container" id="container_app" v-cloak>
        <div class="clearfix" v-for="m in movies">
            <div class="column">
                <div class="card">
                    <div class="card-content">
                        <div class="card-title">{{ m.original_title }}</div>
                        <div>
                            <img v-bind:src="'https://image.tmdb.org/t/p/w200/'+m.poster_path">
                        </div>
                        <div class="card-text">
                            {{ m.vote_average }}%
                        </div>
                        <div class="card-date">
                            {{ m.release_date }}
                        </div>
                        <a class="btn-details" v-bind:href="'movie.php?id='+m.id">Detalles</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- VUE CDN -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <!-- VUE script -->
    <script>
        const { createApp, ref } = Vue

        createApp({
            setup() {
                return {
                loginForm: ref(false),
                username: ref(''),
                password: ref(''),
                
                //movies
                movies: ref([]),
                id_details: ref(''),
                movie: ref([]),
                rate: ref(""),
                showRate: ref(false)
                }
            },
            
            methods: {
                async changeLoginForm(){
                    this.loginForm = !this.loginForm;
                },

                async changeShowRate(){
                    this.showRate = !this.showRate;
                },

                async login(){
                    var myHeaders = new Headers();
                        myHeaders.append("Authorization", "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkN2Q0ZjlkNDNmOTEyOTUyZTVjYjQ5MTM4MjhiMzJlYiIsInN1YiI6IjY1MTRiODYxYmRkNTY4MDEzZjU4MzBlNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.ugQlk93CxiFB9aGcRo0TInf0Z3nGHUtXBuHJXFwKPxo");
                        myHeaders.append("Content-Type", "application/json");

                        var raw = JSON.stringify({
                        "username": this.username,
                        "password": this.password,
                        "request_token": ""
                        });

                        var requestOptions = {
                        method: 'POST',
                        headers: myHeaders,
                        body: raw,
                        redirect: 'follow'
                        };

                        fetch("https://api.themoviedb.org/3/authentication/token/validate_with_login", requestOptions)
                        .then(response => response.json())
                        .then(result =>{
                            if(result.success === true){
                                localStorage.setItem('logged', true);
                                window.location.href = "movies.php";

                            }else{
                                this.username = '';
                                this.password = '';

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Algo salió mal...',
                                    text: 'Verifica que tu usuario y contraseña sean correctos.'
                                })
                            }
                        })
                        .catch(error => console.log('error', error));
                },

                async validateLogin(){
                    const loginURL = window.location.href;
                    console.log(localStorage.getItem('logged'))
                    if(localStorage.getItem('logged') === null && loginURL != "http://localhost/ApiMovies/index.php"){
                        window.location.href = "index.php"
                        
                    }
                },

                async addRate(){
                    var myHeaders = new Headers();
                    myHeaders.append("Content-Type", "application/json");
                    myHeaders.append("Authorization", "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkN2Q0ZjlkNDNmOTEyOTUyZTVjYjQ5MTM4MjhiMzJlYiIsInN1YiI6IjY1MTRiODYxYmRkNTY4MDEzZjU4MzBlNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.ugQlk93CxiFB9aGcRo0TInf0Z3nGHUtXBuHJXFwKPxo");

                    var raw = JSON.stringify({
                    "value": this.rate
                    });

                    var requestOptions = {
                    method: 'POST',
                    headers: myHeaders,
                    body: raw,
                    redirect: 'follow'
                    };

                    fetch("https://api.themoviedb.org/3/movie/"+this.id_details+"/rating", requestOptions)
                    .then(response => response.json())
                    .then(result => {
                        if(result.success === true){
                            Swal.fire({
                                icon: 'success',
                                title: 'Tu valoración ha sido guardada',
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    })
                    .catch(error => console.log('error', error));
                },

                async removeRate(){
                    var myHeaders = new Headers();
                    myHeaders.append("Authorization", "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkN2Q0ZjlkNDNmOTEyOTUyZTVjYjQ5MTM4MjhiMzJlYiIsInN1YiI6IjY1MTRiODYxYmRkNTY4MDEzZjU4MzBlNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.ugQlk93CxiFB9aGcRo0TInf0Z3nGHUtXBuHJXFwKPxo");

                    var requestOptions = {
                    method: 'DELETE',
                    headers: myHeaders,
                    redirect: 'follow'
                    };

                    fetch("https://api.themoviedb.org/3/movie/"+this.id_details+"/rating", requestOptions)
                    .then(response => response.json())
                    .then(result => {
                        if(result.success === true){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Tu valoración ha sido eliminada',
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    })
                    .catch(error => console.log('error', error));
                },

                async addFav(){
                    var myHeaders = new Headers();
                    myHeaders.append("Content-Type", "application/json");
                    myHeaders.append("Authorization", "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkN2Q0ZjlkNDNmOTEyOTUyZTVjYjQ5MTM4MjhiMzJlYiIsInN1YiI6IjY1MTRiODYxYmRkNTY4MDEzZjU4MzBlNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.ugQlk93CxiFB9aGcRo0TInf0Z3nGHUtXBuHJXFwKPxo");

                    var raw = JSON.stringify({
                    "media_type": "movie",
                    "media_id": this.id_details,
                    "favorite": true
                    });

                    var requestOptions = {
                    method: 'POST',
                    headers: myHeaders,
                    body: raw,
                    redirect: 'follow'
                    };

                    fetch("https://api.themoviedb.org/3/account/20503892/favorite", requestOptions)
                    .then(response => response.json())
                    .then(result => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Se ha guardado en favoritos',
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    })
                    .catch(error => console.log('error', error));
                }
            },

            async mounted(){
                //login
                this.validateLogin();
                const updateMovies = async () =>{
                        
                    var myHeaders = new Headers();
                    myHeaders.append("Authorization", "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkN2Q0ZjlkNDNmOTEyOTUyZTVjYjQ5MTM4MjhiMzJlYiIsInN1YiI6IjY1MTRiODYxYmRkNTY4MDEzZjU4MzBlNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.ugQlk93CxiFB9aGcRo0TInf0Z3nGHUtXBuHJXFwKPxo");

                    var requestOptions = {
                    method: 'GET',
                    headers: myHeaders,
                    redirect: 'follow'
                    };

                    fetch("https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=es-MX&page=1&sort_by=popularity.desc", requestOptions)
                    .then(response => response.json())
                    .then(result => {
                        this.movies = result.results
                    })
                    .catch(error => console.log('error', error));
                }
                updateMovies();

                //id movie
                const urlMovie = window.location.href;
                const lastParamMovie = urlMovie.split("/movie.php?id=").slice(-1)[0];
                this.id_details = lastParamMovie;

                // detalles movie
                const updateMovie = async () =>{
                var myHeaders = new Headers();
                    myHeaders.append("Authorization", "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkN2Q0ZjlkNDNmOTEyOTUyZTVjYjQ5MTM4MjhiMzJlYiIsInN1YiI6IjY1MTRiODYxYmRkNTY4MDEzZjU4MzBlNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.ugQlk93CxiFB9aGcRo0TInf0Z3nGHUtXBuHJXFwKPxo");

                    var requestOptions = {
                    method: 'GET',
                    headers: myHeaders,
                    redirect: 'follow'
                    };

                    fetch("https://api.themoviedb.org/3/movie/"+this.id_details+"?language=es-MX", requestOptions)
                    .then(response => response.json())
                    .then(result => {
                        this.movie = result
                        this.movie.vote_average = this.movie.vote_average.toFixed(1)
                    })
                    .catch(error => console.log('error', error));
                }
                updateMovie();

                //getRating
                var myHeaders = new Headers();
                myHeaders.append("Authorization", "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkN2Q0ZjlkNDNmOTEyOTUyZTVjYjQ5MTM4MjhiMzJlYiIsInN1YiI6IjY1MTRiODYxYmRkNTY4MDEzZjU4MzBlNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.ugQlk93CxiFB9aGcRo0TInf0Z3nGHUtXBuHJXFwKPxo");

                var requestOptions = {
                method: 'GET',
                headers: myHeaders,
                redirect: 'follow'
                };

                fetch("https://api.themoviedb.org/3/movie/"+this.id_details+"/account_states", requestOptions)
                .then(response => response.json())
                .then(result => {
                    if(result.rated.value != null){
                        var radios = document.getElementsByName("rateCheck");

                        for (var i = 0; i < radios.length; i++) {
                            var valRate = result.rated.value.toString()
                            if(radios[i].value === valRate){
                                radios[i].checked = true;
                                break;
                            }
                        }
                    }
                })
                .catch(error => console.log('error', error));
                        }
            
        }).mount('#container_app')
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles Movies</title>

    <style>
        body{
            margin: 0;
            padding: 0;
            background: #03213a;
        }

        [v-cloak] {
            display: none;
        }

        .container {
            color: #fff;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 20px;
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
    <div class="container-movie" id="container_app" v-cloak>
        <div class="movie" style="position: relative;">
        <img v-bind:src="'https://www.themoviedb.org/t/p/original/'+movie.backdrop_path">

            <div class="poster">
                <img :src="'https://www.themoviedb.org/t/p/original/'+movie.poster_path">
            </div>
            <div class="movie-info">
                <div>
                    <h1>{{ movie.original_title }}</h1>
                </div>

                <div class="description">
                    {{ movie.overview }}
                </div>
                <div class="card-date">
                    {{ movie.release_date }}
                </div>
                <div class="card-text">
                    {{ movie.vote_average }}%
                </div>

                <div class="rate-icon">
                    <a type="button" @click="changeShowRate">⭐</a>
                </div>

                <div class="fav-icon">
                    <a type="button" @click="addFav">💞</a>
                </div>

                <div v-show="showRate" class="rate">
                    <form>
                        <label><input name="rateCheck" type="radio" v-model="rate" value="1" />☆</label>
                        <br>
                        <label><input name="rateCheck" type="radio" v-model="rate" value="2" />☆☆</label>
                        <br>
                        <label><input name="rateCheck" type="radio" v-model="rate" value="3" />☆☆☆</label>
                        <br>
                        <label><input name="rateCheck" type="radio" v-model="rate" value="4" />☆☆☆☆</label>
                        <br>
                        <label><input name="rateCheck" type="radio" v-model="rate" value="5" />☆☆☆☆☆</label>
                        <br>
                        <button class="btn-add" type="button" @click="addRate">Calificar</button>
                        <button class="btn-remove" type="button" @click="removeRate">Eliminar Calificación</button>
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
    <script>
        const { createApp, ref } = Vue

            createApp({
                setup() {
                    return {
                    id_details: ref(''),
                    movie: ref([]),
                    rate: ref(""),
                    showRate: ref(false)
                    }
                },
                
                methods: {
                    async changeShowRate(){
                        this.showRate = !this.showRate;
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

                    //

                }
            }).mount('#container_app')
    </script>
</body>
</html>
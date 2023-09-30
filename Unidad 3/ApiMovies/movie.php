<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dist/css/movies.css">
    <title>Detalles</title>

    <style>
        body{
            margin: 0;
            padding: 0;
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

                <div class="rate">
                    <form>
                        <label><input type="radio" v-model="rate" value="1" />☆</label>
                        <br>
                        <label><input type="radio" v-model="rate" value="2" />☆☆</label>
                        <br>
                        <label><input type="radio" v-model="rate" value="3" />☆☆☆</label>
                        <br>
                        <label><input type="radio" v-model="rate" value="4" />☆☆☆☆</label>
                        <br>
                        <label><input type="radio" v-model="rate" value="5" />☆☆☆☆☆</label>
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
    <script src="dist/js/vue.js"> </script>
</body>
</html>
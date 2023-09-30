<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dist/css/movies.css">
    <title>Movies</title>
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
    <script src="dist/js/vue.js"> </script>
</body>
</html>
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
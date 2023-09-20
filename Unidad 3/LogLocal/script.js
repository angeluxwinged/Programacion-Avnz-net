 const { createApp, ref } = Vue

        createApp({
            setup() {
                return {
                users: ref([]),
				email: ref(''),
				password: ref(''),
                username: ref(''),
                logged: ref(localStorage.getItem('logged'))
                }
            },
                methods: {
                    login(e) {
                        e.preventDefault();
                        var email_user = this.email;
                        var passsword_user = this.password;
                        
                        var results = this.users.map(function(u) {
                            if (email_user.toLowerCase() === u.email.toLowerCase() && passsword_user === u.password) {
                                this.username = u.username;
                                localStorage.setItem('logged', this.username);
                            }
                            return email_user.toLowerCase() === u.email.toLowerCase() && passsword_user === u.password;
                        });

                        if (results.includes(true)) {
                            window.location.href = 'tabla.php';
                        } else {
                            alert("Something went wrong...");
                        }
                    }
            },

            mounted(){
				fetch('users.json')
				.then((res) => res.json())
				.then((json) => (this.users = json))
				.catch((err) => (console.log(err)))
			}
            
        }).mount('#container_app')
<template>
    <form @submit.prevent="login()">
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Login</p>
            </header>
            <section class="modal-card-body">
                <p>Use the following credentials:</p>
                <p class="mb-3 mt-3"><em>Email: </em>martymcfly@savetheclocktower.com<br/><em>password: </em>jennifer</p>
                <b-field label="Email">
                    <b-input
                        type="email"
                        v-model="creds.email"
                        placeholder="Your email"
                        required>
                    </b-input>
                </b-field>

                <b-field label="Password">
                    <b-input
                        type="password"
                        v-model="creds.password"
                        password-reveal
                        placeholder="Your password"
                        required>
                    </b-input>
                </b-field>
            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
                <button class="button is-primary">Login</button>
            </footer>
        </div>
    </form>
</template>

<script>
    export default {
        name: 'LoginForm',
        data() {
            return {
                creds: {
                    'email': 'martymcfly@savetheclocktower.com',
                    'password': 'jennifer',
                }
            }
        },
        methods: {
            async login() {
                let response = ''
                try {
                    response = await axios.post('/api/auth/login', this.creds)
                }  catch (e) {
                    console.error(e)
                    this.$toast.open({
                        message: `${e}`,
                        type: 'is-danger'
                    })
                }
                localStorage.setItem('jwt', response.data.access_token)
                axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.access_token}`
                this.$emit('close')
                this.$toast.open({
                    message: `Logged in!`,
                    type: 'is-success'
                })
                this.$router.go(this.$router.currentRoute)
            },
        }
    }
</script>

<style scoped>

</style>

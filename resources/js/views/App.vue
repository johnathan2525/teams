<template>
    <div>
        <nav-bar></nav-bar>
        <main>
            <router-view></router-view>
        </main>

        <b-modal :active.sync="isModalActive" has-modal-card>
            <LoginForm v-on:close="close()"></LoginForm>
        </b-modal>
    </div>
</template>


<script>
    import NavBar from './NavBar'
    import LoginForm from './../components/LoginForm'
    export default {
        name: 'App',
        components: {LoginForm, NavBar},
        beforeMount(){
            if(!axios.defaults.headers.common['Authorization'] && localStorage.getItem('jwt')) {
                axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('jwt')}`
            }
        },
        data() {
            return {
                isModalActive: false
            }
        },
        created() {
            window.intercepted.$on('response', data => {
                if (data.status === 401) {
                    this.isModalActive = true
                } else {
                    this.isModalActive = false
                }
            });
        },
        methods: {
            close() {
                this.isModalActive = false
            }
        }
    }
</script>

<style scoped>

</style>

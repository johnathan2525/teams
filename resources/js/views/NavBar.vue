<template>
    <nav class="navbar mb-4" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <router-link class="navbar-item" :to="{ name: 'home' }">
                TEAMS
            </router-link>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <div class="navbar-item has-dropdown is-hoverable">
                    <router-link class="navbar-item" :to="{ name: 'teams.index' }">
                        Teams
                    </router-link>
                    <div class="navbar-dropdown is-boxed">
                        <router-link class="navbar-item" :to="{ name: 'teams.create' }">
                            Create
                        </router-link>
                    </div>
                </div>

                <div class="navbar-item has-dropdown is-hoverable">
                    <router-link class="navbar-item" :to="{ name: 'players.index' }">
                        Players
                    </router-link>
                    <div class="navbar-dropdown is-boxed">
                        <router-link class="navbar-item" :to="{ name: 'players.create' }">
                            Create
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        name: 'Nav',
        mounted() {
            let navbar = document.querySelector('.navbar-burger');
            navbar.addEventListener('click', function () {
                let target = navbar.dataset.target;
                let $target = document.getElementById(target);
                navbar.classList.toggle('is-active');
                $target.classList.toggle('is-active');
            });
        }
    }
</script>

<style scoped>

</style>

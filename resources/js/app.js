window.Vue = require('vue');
require('./axios')
require('vue-axios-interceptors');
import VueRouter from 'vue-router'
import Buefy from 'buefy';
import 'buefy/dist/buefy.css';
Vue.use(Buefy);

import App from './views/App'
import TeamsIndex from './views/TeamsIndex'
import TeamsShow from './views/TeamsShow'
import TeamsCreate from './views/TeamsCreate'
import PlayersIndex from './views/PlayersIndex'
import PlayersShow from './views/PlayersShow'
import PlayersCreate from './views/PlayersCreate'
import Home from './views/Home'
Vue.use(VueRouter)
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'base',
            component: Home
        },
        {
            path: '/home',
            name: 'home',
            component: Home
        },
        {
            path: '/teams',
            name: 'teams.index',
            component: TeamsIndex
        },
        {
            path: '/teams/create',
            name: 'teams.create',
            component: TeamsCreate
        },
        {
            path: '/teams/:id',
            name: 'teams.show',
            component: TeamsShow
        },
        {
            path: '/players',
            name: 'players.index',
            component: PlayersIndex
        },
        {
            path: '/players/create',
            name: 'players.create',
            component: PlayersCreate
        },
        {
            path: '/players/:id',
            name: 'players.show',
            component: PlayersShow
        },
    ],
});

new Vue({
    components: { App },
    router,
}).$mount('#app');

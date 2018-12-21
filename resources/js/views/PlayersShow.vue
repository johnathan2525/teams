<template>
    <div>
        <form @submit.prevent="update()" v-if="player !== null">
            <b-field label="ID">
                <b-input v-model="player.id" disabled type="number"></b-input>
            </b-field>
            <b-field label="First Name">
                <b-input v-model="player.first_name" type="text" required></b-input>
            </b-field>
            <b-field label="Last Name">
                <b-input v-model="player.last_name" type="text" required></b-input>
            </b-field>

            <b-field label="Team" loading="teamLoading">
                <b-select placeholder="Select a name" v-model="player.team_id">
                    <option></option>
                    <option
                        v-for="team in this.teams"
                        :value="team.id"
                        :key="team.id">
                        {{ team.name }}
                    </option>
                </b-select>
            </b-field>
            <b-field><!-- Label left empty for spacing -->
                <p class="control">
                    <button class="button is-primary">
                        Update
                    </button>
                </p>
            </b-field>
        </form>
        <b-loading :is-full-page="true" :active.sync="isLoading" :can-cancel="false"></b-loading>
    </div>
</template>

<script>
    import BField from 'buefy/src/components/field/Field'

    export default {
        name: 'PlayersShow',
        components: {BField},
        data() {
            return {
                id: 0,
                isLoading: null,
                player: null,
                teams: [],
                teamLoading: true,
            };
        },
        computed: {
            team() {
                if (this.player === null || this.player.relationships.team.data === null) {
                    return false
                }
                if (this.player.relationships.team.data.length < 1) {
                    return false
                }
                return this.player.relationships.team.data
            },
        },
        mounted() {
            this.getTeams()
            this.id = this.$route.params.id
            this.fetchData()
        },
        methods: {
            async getTeams() {
                this.teamLoading = true;
                let teams;
                try {
                    teams = await axios.get(`/api/teams`)
                } catch (e) {
                    console.error(e)
                    this.$toast.open({
                        duration: 5000,
                        message: `Could not load teams`,
                        type: 'is-danger',
                    })
                    this.teamLoading = false
                    return
                }
                this.teams = teams.data
                this.teamLoading = false
            },
            async update() {
                this.isLoading = true
                let response;
                try {
                    response = await axios.put(`/api/players/${this.id}`, this.player)
                } catch (e) {
                    console.error(e)
                    this.$toast.open({
                        duration: 5000,
                        message: `${e}`,
                        type: 'is-danger',
                    })
                    this.isLoading = false
                    return
                }
                this.$toast.open({
                    message: 'Updated!',
                    type: 'is-success',
                })
                this.isLoading = false
            },
            async fetchData() {
                this.isLoading = true
                let response;
                try {
                    response = await axios.get(`/api/players/${this.id}`)
                } catch (e) {
                    console.error(e)
                    this.isLoading = false
                    return
                }
                this.player = response.data
                this.isLoading = false
            },
        },
    }
</script>

<style scoped>
    .pointer {
        cursor: pointer;
    }
</style>

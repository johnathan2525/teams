<template>
    <div>
        <form @submit.prevent="update()" v-if="team !== null">
            <b-field label="ID">
                <b-input v-model="team.id" disabled type="number"></b-input>
            </b-field>
            <b-field label="Name">
                <b-input v-model="team.name" type="text" required></b-input>
            </b-field>
            <b-field ><!-- Label left empty for spacing -->
                <p class="control">
                    <button class="button is-primary">
                        Update
                    </button>
                </p>
            </b-field>
        </form>
        <ul v-if="players">
            <div class="title is-4 mt-3 mb-2">Players</div>
            <li v-for="player in players">
                <span v-text="player.first_name"></span> <span v-text="player.last_name"></span>
                <span @click="removePlayer(player)" class="remove pointer text-danger">[x]</span>
            </li>
        </ul>
        <b-loading :is-full-page="true" :active.sync="isLoading" :can-cancel="false"></b-loading>
    </div>
</template>

<script>
    import BField from 'buefy/src/components/field/Field'
    export default {
        name: 'TeamsShow',
        components: {BField},
        data() {
            return {
                id: 0,
                isLoading: null,
                team: null,
            };
        },
        computed: {
          players() {
              if (this.team === null) {
                  return false
              }
              if (this.team.relationships.players.data.length <  1) {
                  return false
              }
              return this.team.relationships.players.data
          }
        },
        mounted() {
            this.id = this.$route.params.id
            this.fetchData()
        },
        methods: {
            async removePlayer(player) {
                this.isLoading = true
                player.team_id = null
                let response;
                try {
                    response = await axios.put(`/api/players/${player.id}`, player)
                } catch (e) {
                    console.error(e)
                    this.$toast.open({
                        duration: 5000,
                        message: `${e}`,
                        type: 'is-danger'
                    })
                    this.isLoading = false
                    return
                }
                this.isLoading = false
                this.fetchData()
                this.$toast.open({
                    message: 'Player Removed!',
                    type: 'is-success'
                })
            },
            async update() {
                this.isLoading = true
                let response;
                try {
                    response = await axios.put(`/api/teams/${this.id}`, this.team)
                } catch (e) {
                    console.error(e)
                    this.$toast.open({
                        duration: 5000,
                        message: `${e}`,
                        type: 'is-danger'
                    })
                    this.isLoading = false
                    return
                }
                this.$toast.open({
                    message: 'Updated!',
                    type: 'is-success'
                })
                this.isLoading = false
            },
            async fetchData() {
                this.isLoading = true
                let response;
                try {
                    response = await axios.get(`/api/teams/${this.id}`)
                } catch (e) {
                    console.error(e)
                    this.isLoading = false
                    return
                }
                this.team = response.data
                this.isLoading = false
            }
        }
    }
</script>

<style scoped>
.pointer {
    cursor: pointer;
}
</style>

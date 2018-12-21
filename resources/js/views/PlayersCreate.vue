<template>
    <div>
    <form @submit.prevent="add()">
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
        <b-field ><!-- Label left empty for spacing -->
            <p class="control">
                <button class="button is-primary">
                    Add
                </button>
            </p>
        </b-field>
    </form>
    <b-loading :is-full-page="true" :active.sync="isLoading" :can-cancel="false"></b-loading>
    </div>
</template>

<script>
    import TeamSelect from '../mixins/TeamSelect'

    export default {
        name: 'PlayersCreate',
        mixins: [TeamSelect],
        data() {
            return {
                isLoading: false,
                player: {
                    first_name: null,
                    last_name: null,
                    team_id: null,
                }
            };
        },
        methods: {
            async add() {
                this.isLoading = true;
                let response;
                try {
                    response = await axios.post(`/api/players`, this.player)
                } catch (e) {
                    console.error(e)
                    this.$toast.open({
                        duration: 5000,
                        message: `${e}`,
                        type: 'is-danger'
                    })
                    this.isLoading = false;
                    return
                }
                this.$toast.open({
                    message: 'Added!',
                    type: 'is-success'
                })
                this.player = response.data
                this.isLoading = false;
                this.$router.push({ name: 'players.show', params: { id: this.player.id}})
            },
        }
    }
</script>

<style scoped>

</style>

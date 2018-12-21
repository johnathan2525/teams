<template>
    <div>
    <form @submit.prevent="add()">
        <b-field label="Name">
            <b-input v-model="team.name" type="text" required></b-input>
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
    export default {
        name: 'TeamsCreate',
        data() {
            return {
                isLoading: false,
                team: {}
            };
        },
        methods: {
            async add() {
                this.isLoading = true;
                let response;
                try {
                    response = await axios.post(`/api/teams`, this.team)
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
                this.team = response.data
                this.isLoading = false;
                this.$router.push({ name: 'teams.show', params: { id: this.team.id}})
            },
        }
    }
</script>

<style scoped>

</style>

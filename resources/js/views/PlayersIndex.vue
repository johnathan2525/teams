<template>
    <div>
        <b-table :data="players"
                 :bordered="false"
                 :striped="true"
                 :hoverable="true"
                 :loading="isLoading"
        >
            <template slot-scope="props">
                <b-table-column field="name" label="Name">
                    <router-link :to="{ name: 'players.show', params: { id: props.row.id }}">{{ props.row.first_name }}
                        {{ props.row.last_name }}
                    </router-link>
                </b-table-column>
            </template>

            <template slot="empty">
                <section class="section">
                    <div class="content has-text-grey has-text-centered">
                        <p>
                            <b-icon
                                icon="emoticon-sad"
                                size="is-large">
                            </b-icon>
                        </p>
                        <p>Nothing here.</p>
                    </div>
                </section>
            </template>

        </b-table>
    </div>
</template>

<script>
    export default {
        name: 'PlayersIndex',
        data() {
            return {
                isLoading: true,
                players: [],
            };
        },
        mounted() {
            this.fetchData();
        },
        methods: {
            async fetchData() {
                this.isLoading = true;
                this.players = [];
                let response;
                try {
                    response = await axios.get('/api/players')
                } catch (e) {
                    console.error(e)
                    this.isLoading = false
                    return
                }
                this.isLoading = false
                this.players = response.data
            },
        },
    }
</script>

<style scoped>

</style>

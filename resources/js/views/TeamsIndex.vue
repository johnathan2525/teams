<template>
    <div>
        <b-table :data="teams"
                 :bordered="true"
                 :striped="true"
                 :hoverable="true"
                 :loading="isLoading"
        >
            <template slot-scope="props">
                <b-table-column field="name" label="Name">
                    <router-link :to="{ name: 'teams.show', params: { id: props.row.id }}">{{ props.row.name }}
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
        name: 'TeamsIndex',
        data() {
            return {
                isLoading: true,
                teams: [],
            };
        },
        mounted() {
            this.isLoading = true;
            this.fetchData();
            this.isLoading = false
        },
        methods: {
            async fetchData() {
                this.teams = [];
                let response;
                try {
                    response = await axios.get('/api/teams')
                } catch (e) {
                    console.error(e)
                    return
                }
                this.teams = response.data
            },
        },
    }
</script>

<style scoped>

</style>

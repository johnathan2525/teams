export default {
    data() {
      return {
          teams: [],
          teamLoading: false,
      }
    },
    mounted() {
      this.getTeams()
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
    },
};

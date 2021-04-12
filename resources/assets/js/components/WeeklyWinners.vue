<script>

import Multiselect from 'vue-multiselect'

export default {

    components: { Multiselect },

    data() {
        return {
            // form: { week: "", password: "" },
            options: [],
            loading: false,
            weeks: [],
            selectedWeek: null,
            selectedYear: null,
            selectedPlayers: null,
        };
    },

    mounted() {
        axios
            .get("/admin/weekly-winners")
                .then(response => this.weeks = response.data);
    },

    methods: {
        customLabel (option) {
            return `${option.user.name}`
        },

        submit() {
            console.log(`Week: ${this.selectedWeek.id}`);
            console.log(`Players: ${this.selectedPlayers[0].id}`);
        }
    },

    watch: {
        selectedWeek() {
            axios
                .get(`/admin/players?year=${this.selectedWeek.year.name}`)
                    .then(response => this.options = response.data);
        }
    }
};
</script>
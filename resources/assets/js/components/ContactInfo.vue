<script>
export default {

    props: ['email', 'phone'],

    data() {
        return {
            form: { email: this.email, phone: this.phone },
            feedback: "",
            loading: false
        };
    },

    methods: {
        submit() {
            this.loading = true;

            axios
                .post("/user/info/", this.form)
                .then(() => {
                    this.$modal.hide('contact-info');
                    flash('Your contact info has been updated!');
                })
                .catch(error => {
                    this.feedback = error.response.data;
                    this.loading = false;
                });
        }
    }
};
</script>
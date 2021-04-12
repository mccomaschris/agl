<script>
export default {
    data() {
        return {
            form: { username: "", password: "" },
            feedback: "",
            loading: false
        };
    },

    methods: {
        login() {
            this.loading = true;

            axios
                .post("/login", this.form, {
                    headers:{
                        'Content-Type':'application/json',
                        'Accept':'application/json'
                    }
                })
                .then(({data: {redirect}}) => {
                    location.assign(redirect);
                })
                .catch(error => {
                    this.feedback = "The given credentials are incorrect. Please try again.";
                    this.loading = false;
                });
        }
    }
};
</script>
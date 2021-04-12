<template>
    <button @click="post"  :class="loading ? 'loader' : ''" :disabled="loading">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: ['endpoint'],

         data() {
            return {
                loading: false
            }
        },

        methods: {
            post() {
                this.loading = true;

                axios
                    .get(this.endpoint)
                    .then(({data: {message}}) => {
                        this.loading = false;
                        flash(message);
                    })
                    .catch(error => {
                        this.feedback = "The was a dang error.";
                        this.loading = false;
                    });
            }
        }
    }
</script>

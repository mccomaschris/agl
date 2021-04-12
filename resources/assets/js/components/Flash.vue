<template>
    <div class="bg-grey-900 text-green-bright px-8 py-6 rounded alert-flash shadow-md" role="alert z-50" v-show="show">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="h-12 w-12 text-white fill-current mr-4"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/></svg>
            <div class="flex flex-col">
                <strong class="font-bold mb-2">Success!</strong>
                <span class="block sm:inline">{{ body }}</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['message'],

        data() {
            return {
                body: '',
                show: false
            }
        },

        created() {
            if (this.message) {
                this.flash(this.message);
            }

            window.events.$on(
                'flash', message => this.flash(message)
            );
        },

        methods: {
            flash(message) {
                this.body = message;
                this.show = true;
                this.hide();
            },

            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            }
        }
    };
</script>

<style>
    .alert-flash {
        position: fixed;
        right: 25px;
        bottom: 25px;
    }
</style>
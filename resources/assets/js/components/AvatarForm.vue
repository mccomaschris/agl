<template>
    <div class="w-full lg:w-1/3 mx-auto px-4 lg:px-0 mt-8">

        <h1 class="text-lg lg:text-2xl uppercase mb-4">Upload Profile Photo</h1>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 border-t-4 border-green-500 text-center">
            <div class="inline-block rounded-full h-24 w-24 overflow-hidden">
                <img :src="avatar">
            </div>
            <form v-if="canUpdate" class="mt-2" method="POST" enctype="multipart/form-data">
                <image-upload name="avatar" class="mr-1" @loaded="onLoad"></image-upload>
            </form>
        </div>
    </div>
</template>

<script>
    import ImageUpload from './ImageUpload.vue';

    export default {
        props: ['user'],

        components: { ImageUpload },

        data() {
            return {
                avatar: this.user.avatar_path
            };
        },

        computed: {
            canUpdate() {
                return this.authorize(user => user.id === this.user.id);
            }
        },

        methods: {
            onLoad(avatar) {
                this.avatar = avatar.src;

                this.persist(avatar.file);
            },

            persist(avatar) {
                let data = new FormData();

                data.append('avatar', avatar);

                axios.post(`/api/users/${this.user.name}/avatar`, data)
                    .then(() => flash('Avatar uploaded!'));
            }
        }
    }
</script>
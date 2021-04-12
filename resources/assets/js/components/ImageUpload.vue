<template>
    <div class="relative overflow-hidden inline-block cursor-pointer">
        <button class="btn btn-green cursor-pointer">Upload a file</button>
        <input type="file" accept="image/*" @change="onChange" class="opacity-0 absolute pin-t pin-l" style="font-size: 100px;">
    </div>
</template>

<script>
    export default {
        methods: {
            onChange(e) {
                if (! e.target.files.length) return;

                let file = e.target.files[0];

                let reader = new FileReader();

                reader.readAsDataURL(file);

                reader.onload = e => {
                    let src = e.target.result;

                    this.$emit('loaded', { src, file });
                };
            }
        }
    }
</script>
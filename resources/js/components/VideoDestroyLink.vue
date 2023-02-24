<template>
    <a class="text-red-600 hover:text-indigo-900 cursor-pointer" @click="remove()">
        Delete
    </a>
</template>

<script>
export default {
    name: "VideoDestroyLink",
    props: {
        video: {
            type: Object,
            required: true
        }
    },
    methods:{
        async remove() {
            await window.casteaching.video.destroy(this.video.id)
        }
    }
}
</script>

<style scoped>

</style>

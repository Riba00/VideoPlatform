<template>
    <a @click="edit" class="text-green-600 hover:text-indigo-900 cursor-pointer">Edit</a>
</template>

<script>
import bus from "../bus";

export default {
    name: "VideoEditLink",
    props: {
        video: {
            type: Object,
            required: true
        }
    },
    methods:{
        edit(){
            bus.$emit('edit',this.video)
        }
    }
}
</script>

<style scoped>

</style>

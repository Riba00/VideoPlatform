<template>
    <div>
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">
                                VIDEOS
                                <button @click="refresh">REFRESH</button>
                            </h3>
                        </div>
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    ID
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">TITLE
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    DESCRIPTION
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">URL
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            <tr class="bg-white" v-for="video in videos">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                    {{ video.id }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ video.title }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ video.description }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ video.url }}
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <video-show-link :video="video"></video-show-link>
                                    <video-edit-link :video="video"></video-edit-link>
                                    <video-destroy-link :video="video" @removed="refresh()"></video-destroy-link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VideoShowLink from "./VideoShowLink.vue";
import VideoEditLink from "./VideoEditLink.vue";
import VideoDestroyLink from "./VideoDestroyLink.vue";
import bus from "../bus";

export default {
    name: "VideosList",
    components: {
        'video-show-link' : VideoShowLink,
        'video-edit-link' : VideoEditLink,
        'video-destroy-link' : VideoDestroyLink
    },
    data() {
        return {
            videos: []
                // {
                //     "id": 1,
                //     "title": "Title here",
                //     "description": "Description here 1",
                //     "url": "https://youtu.be/w8j07_DBl_I",
                //     "published_at": "2020-12-13T20:00:00.000000Z",
                //     "previous": null
                // },
                // {
                //     "id": 2,
                //     "title": "Title here 2",
                //     "description": "Description here 2",
                //     "url": "https://youtu.be/w8j07_DBl_I",
                //     "published_at": "2020-12-13T20:00:00.000000Z",
                //     "previous": null
                // },
                // {
                //     "id": 3,
                //     "title": "Title here 3",
                //     "description": "Description here 3",
                //     "url": "https://youtu.be/w8j07_DBl_I",
                //     "published_at": "2020-12-13T20:00:00.000000Z",
                //     "previous": null
                // }
        }
    },
    async created() {
        this.getVideos()
        bus.$on('created',async () =>{
            await this.refresh()
        });
        bus.$on('updated',async () =>{
            await this.refresh()
        });
    },
    methods: {
        async getVideos() {
            this.videos = await window.casteaching.videos()
        },
        async refresh(){
            await this.getVideos()
        }
    }
}
</script>

<style scoped>

</style>

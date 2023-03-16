<x-casteaching-layout>

    <button id="getVideos" type="submit" class="inline-flex justify-center py-2 px-2 border">
        GET VIDEOS
    </button>

    <script>
        document.getElementById('getVideos').addEventListener('click', async function (){
            try {
                const videos = await window.casteaching.videos()
                console.log(videos);
            } catch (error){
                console.log('ERROR:')
                console.log(error)
            }
        })
    </script>
</x-casteaching-layout>

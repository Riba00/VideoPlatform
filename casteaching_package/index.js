import axios from 'axios'
export default {
    videos: async function(){
        const response = await axios.get('http://casteachingriba.test/api/videos')
        return response.data
    }
}

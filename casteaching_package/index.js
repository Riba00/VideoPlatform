import axios from 'axios'
export default {
    videos: async function(){
        const response = await axios.get('http://casteachingriba.test/api/videos')
        return response.data
    }
}
D5oIbky96g7sslYU6gRNw0ui6qV2TyqnVdQ-pw

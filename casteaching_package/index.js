import axios from 'axios'

const apiClient = axios.create({
    baseURL: 'http://casteachingriba.test/api',
    withCredentials: false,
    headers:{
        Accept: 'application/json',
        "Content-Type": 'application/json'
    }

})

export default {
    videos: async function(){
        const response = await apiClient.get('/videos')
        return response.data
    },
    video: {
        create: async function(data){
            const response = await apiClient.post('/videos',data)
            return response.data
        },
        show: async function(id){
            const response = await apiClient.get('/videos/'+id)
            return response.data
        },
        update: async function(id, data){
            const response = await apiClient.put('/videos/'+ id,data)
            return response.data
        },
        destroy: async function(id){
            const response = await apiClient.delete('/videos/'+id)
            return response.data
        },
    }
}

import axios from "axios";

const axiosClient = axios.create({
    
});


axiosClient.interceptors.request.use(config=>{
    config.headers.Authorization = `Bearer ${localStorage.getItem('jwt')}`
    //config.headers.Authorization = `Bearer 4|as3naPYaAWp60eBKLUxHnUfFK6EXBFVKqpmCWgFM`
    return config;
})
export default axiosClient;
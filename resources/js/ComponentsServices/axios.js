import axios from "axios";

export default function useAxios(){

    const config = { headers: {'content-Type':"multipart/form-data" }}
    const formData = new FormData()

    const axios_post = async (url,data)=>{
        for(let key in data){
            formData.append(key,data[key])
        }
        return await axios.post(url,formData,config)
    }
    const axios_get = async (url)=>{
        return await axios.get(url)
    }
    const axios_post_simple = async (url,data)=>{
        return await axios.post(url,data,config)
    }

    return{
        axios_post,
        axios_get,
        axios_post_simple,
        config
    }
}
import {ref} from 'vue'

export default function useDashBord(){


    const message_courrier = ref()
    const message_audience = ref()

   
    window.Echo.channel('courrier-channel').listen('CreateCourrierEvent',(event)=>{
        message_courrier.value = event
        console.log(event);
    })
    window.Echo.channel('audience-channel').listen('CreateAudienceEvent',(event)=>{
        message_audience.value = event
        console.log(event);
    })



    return {
        message_courrier,
        message_audience
    }
}
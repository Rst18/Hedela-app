import {ref} from 'vue'

export default function useDashBord(){


    const message_courrier = ref()
    const message_audience = ref()

   const courrierEvent = ()=>  window.Echo.channel('courrier-channel')
    // window.Echo.channel('courrier-channel').listen('CreateCourrierEvent',(event)=>{
    //     message_courrier.value = event
    //   //  stat_courrier.value.total_courrier += 1 
    //     console.log(event);
    // })
    const audienceEvent = ()=> window.Echo.channel('audience-channel')
    // window.Echo.channel('audience-channel').listen('CreateAudienceEvent',(event)=>{
    //     message_audience.value = event
    //     console.log(event);
    // })

    const presenceEvent = ()=>{
       return window.Echo.join('presence-channel')
        // .here((users)=>{
        //     users_connected.value = users
        //     console.log({users},'conctd')
        // })
        // .joining((user)=>{
        //     console.log({user}, 'joined')
        // })
        // .leaving((user)=>{
        //     console.log({user}, 'leaved')
        // })
    }


    return {
        message_courrier,
        message_audience,
        presenceEvent,
        courrierEvent,
        audienceEvent
    }
}
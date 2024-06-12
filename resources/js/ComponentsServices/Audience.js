
import {ref} from 'vue'

export default function UseAudience(){

    const get_status = (statut)=>{

        return statut_audience.value.filter((s)=>s.id == statut)[0];
    }

   const  statut_audience = ref([
        {
            id:1,
            name:'En attente...',
            color:'bg-blue-200'  
        },
        {
            id:2,
            name:'Acceptee, rendez-vous ',
            color:'bg-green-300'  
        },
        {
            id:3,
            name:'refuse',
            color:'bg-red-400'  
        },
        {
            id:4,
            name:'Cloturée',
            color:'bg-green-600'  
        },
    ]);

    return{
        statut_audience,
        get_status
    }
}
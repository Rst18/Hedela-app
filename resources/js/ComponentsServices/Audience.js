
import {ref} from 'vue'

export default function UseAudience(){

    const get_status = (statut)=>{

        return statut_audience.value.filter((s)=>s.id == statut)[0];
    }

   const  statut_audience = ref([
        {
            id:1,
            name:'En attente...',
            color:''  
        },
        {
            id:2,
            name:'Acceptee, rendez-vous ',
            color:''  
        },
        {
            id:3,
            name:'Encours',
            color:''  
        },
        {
            id:4,
            name:'Cloturée',
            color:''  
        },
    ]);

    return{
        statut_audience,
        get_status
    }
}
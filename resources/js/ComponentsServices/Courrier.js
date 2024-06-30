import {ref} from 'vue'

export default function UseCourrier(){

    const getColorCourrier = (status)=>{

        return courrier_status.value.filter((c)=>c.id == status)
    }
    const getColorNote = (status)=>{

        return note_status.value.filter((c)=>c.id == status)
    }

    const courrier_status = ref([
        {
            id:1,
            name:'Enregistrer',
            color:'bg-red-500'
        },
        {
            id:2,
            name:'Dispatch',
            color:'bg-orange-400'
        },
        {
            id:3,
            name:'Note Technique',
            color:'bg-blue-500'
        },
        {
            id:4,
            name:'Fin',
            color:'bg-green-300'
        },


    ])

    const note_status = ref([
        {
            id:1,
            name:'Enregistrer',
            color:'bg-blue-200'
        },
        {
            id:2,
            name:'Valider',
            color:'bg-green-300'
        },
        {
            id:3,
            name:'Refuser',
            color:'bg-green-600'
        },
        {
            id:4,
            name:'Imprimmer',
            color:'bg-green-600'
        },


    ])
    return {
        courrier_status,
        getColorCourrier,
        note_status,
        getColorNote
    }
}
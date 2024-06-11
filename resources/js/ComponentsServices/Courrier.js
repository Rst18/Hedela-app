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
            color:'bg-blue-200'
        },
        {
            id:2,
            name:'Dispatch',
            color:'bg-teal-200'
        },
        {
            id:3,
            name:'Note Technique',
            color:'bg-orange-200'
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
            name:'Fin',
            color:'bg-green-300'
        },


    ])
    return {
        courrier_status,
        getColorCourrier,
        note_status,
        getColorNote
    }
}
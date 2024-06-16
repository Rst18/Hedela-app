export default function useTimesheet(){

    const priorites = [
        {
            id:1,
            name:'Très élevé',
            color:'text-red-600'

        },
        {
            id:2,
            name:'Elevé',
            color:'text-grenn-600'

        },
        {
            id:3,
            name:'Moyen',
            color:'text-gray-600'

        },
        {
            id:4,
            name:'Faible',
            color:'text-slive-600'

        },
    ]
    const statuts = [
        {
            id:1,
            name:'Ouvert',
            color:'text-green-600'

        },
        {
            id:2,
            name:'Fermé',
            color:'text-red-600'

        },
        {
            id:3,
            name:'Suspendu',
            color:'text-gray-600'

        },
    ]

    return {

        priorites,
        statuts

    }
}
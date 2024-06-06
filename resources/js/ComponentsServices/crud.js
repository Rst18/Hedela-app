export default function useCrud(){

    const modifiy_element_in_array_objet = (array_obj,event)=>{

        return array_obj.map(obj => {

            if (obj.id === event.id ) {
                
                return { ...obj, name: event.name };
            }
            return obj;
        });

    }
    const modifiy_element_in_array_objet_compteP = (array_obj,event)=>{

        return array_obj.map(obj => {

            if (obj.numCompteP === event.numCompteP ) {
                
                return { ...obj,
                    description: event.description,
                    type:event.type,
                    sous_type:event.sous_type,
                    nature:event.nature,
                    masse_id:event.masse_id
                };
            }
            return obj;
        });

    }

    const modifiy_element_in_array_objet_compte = (array_obj,event)=>{

        return array_obj.map(obj => {

            if (obj.numCompte === event.numCompte ) {
                
                return { ...obj,
                    description: event.description,
                    numCompteP:event.numCompteP
                };
            }
            return obj;
        });

    }

    return {
        modifiy_element_in_array_objet,
        modifiy_element_in_array_objet_compteP,
        modifiy_element_in_array_objet_compte
    }
}
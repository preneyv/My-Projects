
/**
 * import de différentes méthodes utiles 
 */
import {turnItemActivated, setSelectedGallery,setGalleryImages} from '../listFunctions.js'

/**
 *  
 * @param {*} el il s'agit du nouvel élément qui sera ajouté au DOM par la suite. Dans le cas de notre de liste de galerie il
 * s'agit d'une div représentant une ligne de l'objet listOfGallery. Celui ci est crée lorsqu'est retourné par la méthod get  de la fontion loadThemeAndGallery()
 *  dans listFunctions.js, response.data.listOfGallery (l 29-31)
 * @returns retourne l'abre qui permettra de dessiner l'élément du dom qui va être créer.
 */

function getRoot(elm){
    return{
        racine : {
            tag : 'div',
            class : ['itemGallery'],
            id : elm._id.$oid,
            child:[
                {
                    tag:'h3',
                    text:elm.title
                }
            ],
            methodToDo: function(el){
                setSelectedGallery(turnItemActivated(el));
                setGalleryImages()
            }
            
        }
    }
  
}

export{getRoot};


/**
 * import de différentes méthodes utiles 
 */
import {setBigImage} from '../listFunctions.js'

/**
 *  
 * @param {*} srcNewImage il s'agit du nom de l'image utilisé par nouvel élément qui sera ajouté au DOM par la suite. 
 * Dans le cas de notre de liste d'images il  * s'agit d'une div d'une ligne du tableau contenu dans arrayOfImages de  l'objet listOfGallery.
 *  Celui-ci est créé avec la méthod setGalleryImages de listFunctions.js (l 62-75).
 * @returns retourne l'abre qui permettra de dessiner l'élément du dom qui va être créer.
 */

function getRoot(srcNewImage){
    return{
        racine : {
            tag : 'div',
            class : ['imageOfSelectedGallery'],
            child:[
                {
                    tag:'img',
                    src:`../imagesGallery/${srcNewImage}`,
                    alt:srcNewImage
                }
            ],
            methodToDo: function(el){
                setBigImage(el);
            } 
        }
    }
  
}

export{getRoot};
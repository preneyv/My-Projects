


/**
 * import de différentes méthodes utiles 
 */
import {addImageToGallery} from '../listFunctions.js'

/**
 *  
 * @param {*} el il s'agit du nouvel élément qui sera ajouté au DOM par la suite. Dans le cas de notre de liste de thème il
 * s'agit d'une ligne de l'élement response.data.listOfImages retourné par la méthod get au niveau de la fontion loadThemeAndGallery() dans listFunctions.js (l.33 à 38)
 * @returns retourne l'abre qui permettra de dessiner l'élément du dom qui va être créer.
 */
function getRoot(el){
    return{
        racine : {
            tag : 'li',
            class : ['image'],
            id : el._id.$oid,
            title: el.src,
            child:[
                {
                    tag:'div',
                    class:['imageIcon'],
                    style:[{type:'background-image', value:`url(../imagesGallery/${el.src})`}]
                },
                {
                    tag:'div',
                    class:['bottomBarImage'],
                    child:[
                        {
                            tag:'h4',
                            class:['titleImage'],
                            text:el.title,
                            title:el.title
                        },
                        {
                            tag:'i',
                            class:["fas", "fa-plus", "fa-1x"],
                            title:`Ajouter à la galerie sélectionnée.`,
                            methodToDo: function(elmt){
                                addImageToGallery(elmt.parentNode.parentNode);
                            }
                        }
                    ]
                }
            ]
    
        }
    }
    
}

export{getRoot};
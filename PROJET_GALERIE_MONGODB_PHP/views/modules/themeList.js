
/**
 * import de différentes méthodes utiles 
 */
import {turnItemActivated, setGallery, setSelectedTheme, setSelectedGallery, emptyListThemeAndGallery} from '../listFunctions.js'

/**
 *  
 * @param {*} el il s'agit du nouvel élément qui sera ajouté au DOM par la suite. Dans le cas de notre de liste de thème il
 * s'agit d'une ligne de l'élement réponse.data.listOfTheme retourné par la méthod get au niveau de la fontion loadThemeAndGallery() dans listFunctions.js (l.22 à 26)
 * @returns retourne l'abre qui permettra de dessiner l'élément du dom qui va être créer.
 */

function getRoot(el){
    return{
      racine : {
            tag : 'li',
            class : ['theme'],
            id : el._id.$oid,
            child:[
                {
                    tag:'h3',
                    text:el.title
                }
            ],
            methodToDo: function(elmt){
               
                setSelectedTheme(turnItemActivated(elmt));
                setSelectedGallery({});
                setGallery();
                emptyListThemeAndGallery("listImageOfGallery");
            }
      }
  }
  
}

export{getRoot};
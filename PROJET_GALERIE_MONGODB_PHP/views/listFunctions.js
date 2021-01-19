/**
 * Imports nécessaires à l'utilisation des modules
 * fonctionnent tels des paramètres pour les fonctions
 */
import {getRoot as getRootImagesList} from './modules/freeImagesList.js';
import {getRoot as getRootThemeList} from './modules/themeList.js';
import {getRoot as getRootGalleryList} from './modules/galleryList.js';
import {getRoot as getRootImagesOfGalleryList} from './modules/imagesOfGalleryList.js';

/** 
 * Variables globales 
 */

var listOfTheme={};//récuperera la liste des thèmes de la BDD une fois la requète asynchrone effectuée : l-28

var listOfGallery={};//récuperera la liste des galeries de la BDD une fois la requète asynchrone effectuée : l-34

var listOfImages={};//récuperera la liste des images proposées de la BDD une fois la requète asynchrone effectuée : l-39

var selectedTheme = {} ;//récupère le thème séléctionné lorsque l'événement click est déclenché sur un des éléments de la liste HTML de thème ! l-28 de themeList.js

var selectedGallery = {};//récupère la galerie séléctionnée lorsque l'événement click est déclenché sur un des éléments de la liste HTML de galerie ! l-27 de galerieList.js

/**
 * @param {*} val nouvelle valeur que va prendre l'objet selectedTheme
 */
function setSelectedTheme(val){selectedTheme = val}

/**
 * @param {*} val nouvelle valeur que va prendre l'objet selectedGalerie
 */
function setSelectedGallery(val){selectedGallery = val}


/**
 * loadThemeAndImages()
 * Methode utilisée au démarrage de la page web (plus d'explications dans le lisezmoi.txt)
 */
function loadThemeAndImages(){
    axios.get("../controllers/controller.php?ctrl=gallerie&fc=start")
         .then(response=>{
          
            console.log(response);
            for( let elTh of response.data.listOfTheme)
            {
                listOfTheme[elTh.tab._id.$oid] = elTh;
                let nItem = addToParent(getRootThemeList(elTh.tab).racine);
                let nb = document.createElement('span');
                nb.textContent = elTh.nbImage === null || elTh.nbImage === 0 ? "" : ` (${elTh.nbImage} images)`;
                nItem.appendChild(nb);
                document.getElementsByClassName('themeList-line')[0].appendChild(nItem);  
            }

            for(let elGall of response.data.listOfGallery){
                listOfGallery[elGall._id.$oid]= elGall;
            }

            if(document.querySelector('.imagesList-line'))
            {
                for(let img of response.data.listOfImages)
                {
                    listOfImages[img._id.$oid] =  img;
                    let nItem = addToParent(getRootImagesList(img).racine);
                    document.querySelector('.imagesList-line').appendChild(nItem);
                }    
            }
            
            
         }).catch(error=>{
            console.log(error);
         });
         //window.location.href="../controllers/controller.php?ctrl=gallerie&fc=start";
}


/**
 *     setGallery()
 * Permet de découvrir la liste de galeries associées au thème séléctionné.
 */
function setGallery(){
            
    emptyListThemeAndGallery("listGallery");
    for( let elm in listOfGallery)
    {
        if(listOfGallery[elm].theme == selectedTheme.title)
        {
            
            let nItem = addToParent(getRootGalleryList(listOfGallery[elm]).racine);
            if(listOfGallery[elm].arrayOfImages.length>0)nItem.style.backgroundImage = `url(../imagesGallery/${listOfGallery[elm].arrayOfImages[0]})`;
            document.getElementsByClassName('listGallery')[0].appendChild(nItem);
           
        }
    }
}

/**
 *    setGalleryImages()
 * On affiche les images correspondantes à la galerie séléctionnée. 
 */
function setGalleryImages(){
          
    //reset les images affichées
    emptyListThemeAndGallery("listImageOfGallery");

    //affiche les images de la galerie selectionnée
    for(let img of listOfGallery[selectedGallery.id].arrayOfImages)
    {
        let nItem = addToParent(getRootImagesOfGalleryList(img).racine);
        document.getElementsByClassName('listImageOfGallery')[0].appendChild(nItem);
                        
    }  
}

/**
 *  setBigImage()
 * @param {*} el lien de l'image a afficher en gros.
 * Lors du clique sur une image du centre elle s'affiche en gros sur l'écran
 */
function setBigImage(el){

      document.getElementById('imageSelected').setAttribute('style', `background-image : url(${el.children[0].getAttribute('src')})`);
      switchClassPanel('divAfficheImageSelected','active');
}

/**
 *  addGallery()
 * Permet d'ajouter une galerie à la BDD (voir lisezmoi.txt pour plus d'infos) 
 */
function addGallery(){
    let nameNewGallery = document.getElementById('newGalleryInput').value;
    axios.get(`../controllers/controller.php?ctrl=gallerie&fc=addGallery&gallery=${nameNewGallery}&theme=${selectedTheme.title}`)
         .then(response=>{
            let res = response.data;

                if(res.succeed==true)
                {
                    listOfGallery[res.tabRes[0]._id.$oid] = res.tabRes[0] ;
                    let nItem = addToParent(getRootGalleryList(res.tabRes[0]).racine);
                    if(listOfGallery[res.tabRes[0]._id.$oid].arrayOfImages.length>0)nItem.style.backgroundImage = `url(../imagesGallery/${listOfGallery[elm].arrayOfImages[0]})`;
                    document.getElementsByClassName('listGallery')[0].appendChild(nItem);
                    
                }
                raiseInfoPanel(res.panelInfo);
                
        }).catch(error=>{
            console.log(error);
        });
        //window.location.href=`../controllers/controller.php?ctrl=gallerie&fc=addGallery&gallery=${nameNewGallery}&theme=${selectedTheme.title}`;
    window.event.preventDefault();  
}


/**
 *    addTheme()
 * Permet d'ajouter une thème à la BDD( voir lisezmoi.txt pour plus d'infos)
 */
function addTheme(){

    let nameNewTheme = document.getElementById('newThemeInput').value;
    axios.get(`../controllers/controller.php?ctrl=gallerie&fc=addTheme&theme=${nameNewTheme}`)
         .then(response=>{
            let res = response.data;

                if(res.succeed==true)
                {
                    listOfTheme[res.tabRes[0]._id.$oid] = res.tabRes[0] ;
                    let nItem = addToParent(getRootThemeList(res.tabRes[0]).racine);
                    document.getElementsByClassName('themeList-line')[0].appendChild(nItem);
                    
                }
                raiseInfoPanel(res.panelInfo);   
        }).catch(error=>{
            console.log(error);
        });
     window.event.preventDefault();  
}


/**
 *    addImageToGallery()
 * permet d'ajouter une image à la galerie. Lorsque celle-ci est ajoutée depuis la liste d'images proposées.
 * @param {*} el nom (du type titre.jpg) de l'image
 */
function addImageToGallery(el){
    let srcNewImage = el.title;
    axios.get(`../controllers/controller.php?ctrl=gallerie&fc=addImageToGallery&image=${srcNewImage}&gallery=${selectedGallery.id}`)
         .then(response=>{
                let res = response.data;
                if(res.succeed==true)
                {
                    if(listOfGallery[selectedGallery.id].arrayOfImages.length==0)document.getElementById(selectedGallery.id).style.backgroundImage = `url(../imagesGallery/${srcNewImage})`;
                    listOfGallery[selectedGallery.id].arrayOfImages.push(srcNewImage);
                    let nItem = addToParent(getRootImagesOfGalleryList(srcNewImage).racine);
                    document.getElementsByClassName('listImageOfGallery')[0].appendChild(nItem);
                   
                }
                raiseInfoPanel(res.panelInfo);     
        }).catch(error=>{
            console.log(error);
        });
   window.event.preventDefault();  
}

/**
 *  emptyListThemeAndGallery()
 * @param {*} parent élement qui va se voir supprimer ses enfants
 * Cette méthode permet de vider l'élément parent de ses enfants afin d'y insérer de nouveau.
 */
function emptyListThemeAndGallery(parent)
{
    let parentNoeud = document.getElementsByClassName(parent)[0];

    while (parentNoeud.firstChild) { 
        parentNoeud.removeChild(parentNoeud.firstChild); 
    } 
}

/**
 *   turnItemActivated()
 * @param {*} el element qui va se voir ajouter la class isSelected pour indiquer viuellement quel élément de la liste est actif/.
 * Est utilisé lorsqu'un thème est sélécionné et qu'une galerie l'est aussi. Cela défini également selectedTheme si la méthode est appelé par un élément de la liste de thème,
 * et selectedGallery si c'est pas un élément de la liste de galerie.
 */
function turnItemActivated(el){

   
    let parent = el.parentNode;
    let tabRes={};
    for(let elm of parent.children)
    {
        if(elm.classList.contains('isSelected'))elm.classList.remove('isSelected');
    }
    el.classList.toggle('isSelected');
    tabRes = {title:el.firstElementChild.textContent,id:el.id};
    console.log(tabRes);
    return tabRes;       
}

/**
 *   switchClassPanel()
 * @param {*} el élément qui va se voir changer de classe
 * @param {*} wantedState nouvelle classe à attribuer.
 * Permet de changer de classe (voir lisezmoi.txt)
 * 
 */
function switchClassPanel(el, wantedState)
{
       el = document.getElementById(el);
       el.classList=[wantedState];
}

/**
 *   raiseInfoPanel()
 * @param {*} tabInfo tableau contenant les informations à afficher.
 * Permet de lever un panneau d'alert/information sur l'état des actions effectuées 
 */
function raiseInfoPanel(tabInfo)
{

            let panelInfoDiv = document.getElementById('infoAlert');
            panelInfoDiv.style.backgroundColor = tabInfo.color;
            panelInfoDiv.firstElementChild.textContent = tabInfo.text;
            switchClassPanel("infoAlert",'active');
}

/**
 * addToParent()
 * @param {*} tree plan qui dessine l'arborescence du nouvel élément à créer. Voir l'objet racine dans les fichiers galleryList.js, themeList.js, freeImagesOfList.js et imagesOfGalleryList.js
 * Permet d'ajouter de manière dynamique les éléments au dom (voir listFunction.js pour plus d'informations)
 */
function addToParent(tree){
            
    let newChild = document.createElement(tree['tag']);
    if(tree['class'])newChild.classList.add(...tree['class']);
    if(tree['id'])newChild.id = tree['id'];
    if(tree['title'])newChild.setAttribute('title',tree['title']);
    if(tree['src'])newChild.setAttribute('src', tree['src']);
    if(tree['text'])newChild.textContent = tree['text'];
    if(tree['alt'])newChild.setAttribute('alt',tree['alt']);
    if(tree['style'])
    {
        for(let st of tree['style'])
        {
            newChild.setAttribute('style',`${st.type} : ${st.value}`);
        }
    }

    if(tree.methodToDo!==undefined)
    {
        newChild.addEventListener('click',()=>{
            tree.methodToDo(newChild);
        },false)
    }
    

    if(tree.child)
    {
        for(let i of tree.child)
        {
            newChild.appendChild(addToParent(i));
        }
    }
            
    return newChild;
}


export {addImageToGallery, turnItemActivated, setGallery,setSelectedTheme, setSelectedGallery, setGalleryImages, setBigImage, loadThemeAndImages, addTheme, addGallery, switchClassPanel, emptyListThemeAndGallery};
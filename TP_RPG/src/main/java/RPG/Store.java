package RPG;
import static RPG.RpgMain.clearConsole;
import static RPG.RpgMain.sleepOneTime;
import java.awt.AWTException;
import java.util.*;
import java.util.concurrent.TimeUnit;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author Valere
 */
public class Store {
    
      private static final ArrayList<Weapon> weaponStore = new ArrayList<>();
      private static final ArrayList<Double> storePrice = new ArrayList<>();
      
      public Store(){
          
              Weapon hacheClodo = new Axes(5, "Hache de clochard");
              weaponStore.add(hacheClodo);
              storePrice.add(5.0);
              Weapon hachePasMal = new Axes(8, "Hache pas si bien que ca");
              weaponStore.add(hachePasMal);
              storePrice.add(10.0);
              Weapon hacheTop = new Axes(15, "Hache qui peut faire un peu mal");
              weaponStore.add(hacheTop);
              storePrice.add(20.0);
              Weapon hacheMortel = new Axes(25, "Hache qui tape");
              weaponStore.add(hacheMortel);
              storePrice.add(37.0);
              Weapon hacheDeTaMere = new Axes(55, "Hache qui tabasse sa mere");
              weaponStore.add(hacheDeTaMere);
              storePrice.add(50.0);
              Weapon hacheDuPourfandeur = new Axes(100, "Hache du pourfandeur");
              weaponStore.add(hacheDuPourfandeur);
              storePrice.add(78.5);


      }
      
      /**
       * 
       * @param j player that goes into the Store
       * if choiceWeaponStore is not one of the possibilities, 
       * the seller asks to an other answer. If it's 0, the player quit.
       * Once a buying has been done, the seller aks the player for another item to buy.
       */
      public void goToTheMall(Player j) throws AWTException
      {
          clearConsole();
          sleepOneTime();
          System.out.println("Bienvenue dans mon atelier !! Je fabrique les meilleurs armes !");
          System.out.println("###############################################################");
          
          
          int choiceWeaponStore=-1 ;
          while(choiceWeaponStore != 0)
          {
              this.getArticle();
              Scanner scanner = new Scanner(System.in);
              try{
                  choiceWeaponStore = scanner.nextInt();
              }catch(Exception e)
              {
                  System.out.println("[MESSAGE ERREUR : Saisir un chiffre]");
                  
              }
              
              if(choiceWeaponStore >0 && (choiceWeaponStore-1)<= this.weaponStore.size())
              {
                  
                              if(j.getMoney()- storePrice.get(choiceWeaponStore-1) >= 0)
                              {
                                      j.buyWeapon(weaponStore.get(choiceWeaponStore-1), storePrice.get(choiceWeaponStore-1));
                                      weaponStore.remove(choiceWeaponStore-1);
                                      storePrice.remove(choiceWeaponStore-1);
                                      System.out.println("Merci pour cet achat mon bon monsieurs ! Voulez-vous acheter autre chose ? Oui pour continuer, non pour quitter");
                                      String choiceReBuy=null;
                                      while(!"oui".equals(choiceReBuy) && !"non".equals(choiceReBuy))
                                      {
                                          choiceReBuy=scanner.next();
                                          if("oui".equals(choiceReBuy)){System.out.println("Je vous laisse regarder à nouveau !");}
                                          if("non".equals(choiceReBuy)){ System.out.println("Merci à vous! Bien le bonsoir !"); choiceWeaponStore =0;}
                                          if(!"oui".equals(choiceReBuy) && !"non".equals(choiceReBuy)){System.out.println("[MESSAGE ERREUR : Saisissez une valeur correcte !");}
                                      }

                              }else{
                                  System.out.println("Vous n'avez pas assez d'argent pour acheter cette arme");
                              }

              }else if(choiceWeaponStore !=0){
                      System.out.println("Je n'ai pas ça ici ! Desolé mon gars ! (tapez un nom d'arme comprise dans la liste 0 pour sortir)");
              }else{
                  System.out.println("Merci à vous! Bien le bonsoir !");
              }
                
             
          }
           sleepOneTime();
          
      }
      
      
      /**
       * show all weapons the seller got
       */
      public void getArticle()
      {
          System.out.println("Voici ce que j'ai dans mon magasin : ");
          for( int i =0; i<this.weaponStore.size();i++)
          {
              System.out.println("- "+(i+1)+") "+this.weaponStore.get(i).getName()+" pour le prix de "+this.storePrice.get(i)+" percons");
          }
          System.out.println("Laquelle vous interesse ? (entrez le numéro de l'arme qui vous interesse ou tapez 0 pour quitter le magasin)");
         
      }

}

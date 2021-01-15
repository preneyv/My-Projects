
package RPG;

import java.awt.AWTException;
import java.awt.Robot;
import java.awt.event.KeyEvent;
import java.io.IOException;
import java.util.Scanner;
import java.util.concurrent.TimeUnit;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author Valere
 */
public class RpgMain {
    public static void main(String[] args) throws IOException, InterruptedException, AWTException {
        
        /**
         * Ask the player to enter some required information before the game begins
         * The Size of the map.
         * Wich class will he play
         * And finally a name.
         */
        
        System.out.println("Bienvenue sur ce nouveau jeu !!");
        System.out.println("Il nous faut quelques informations avant de pouvoir démarrer");
        
        int lengthMap=0;
        int widthMap=0;
        while((lengthMap < 10 || lengthMap > 25) || (widthMap < 10 || widthMap > 100) )
        {
            Scanner scanner = new Scanner(System.in);
            System.out.println("################################################################################################################### ");
            System.out.println("Saisissez la taille de la carte : la hauteur de la carte doit être comprise entre 10 et 25 et la longueur entre 10 et 100");
            System.out.println("Saisir la hauteur : ");
            try{
                lengthMap = scanner.nextInt();
            }catch(Exception e)
            {
                System.out.println("Saisissez une valeur valide");
            }
            
            System.out.println("Saisir la longueur : ");
           try{
                widthMap = scanner.nextInt();
            }catch(Exception e)
            {
                System.out.println("Saisissez une valeur valide");
            }
        }
        Map mapGame = new Map(lengthMap, widthMap);
        Store storeInstance = new Store();
        
        
        System.out.println("Il faut maintenant choisir votre classe !");
        int choiceClass=-1;
        while(choiceClass <= 0 || choiceClass > 3)
        {   Scanner scanner2 = new Scanner(System.in);
            System.out.println("Quelle classe choisissez-vous entre :\n1)Paladin\n2)Witcher\n3)Welfgor");
            try{
                choiceClass = scanner2.nextInt();
            }catch(Exception e)
            {
                System.out.println("Saisissez une valeur valide");
            }
        }
        
        System.out.println("Enfin choisissez un nom pour votre personnage !");
        String choiceName=null;
        System.out.println("Quelle nom choisissez-vous");
        Scanner scanner3 = new Scanner(System.in);
        choiceName=scanner3.next();
        Player p1 = null;
        switch(choiceClass)
        {
            case 1 : p1 = new Paladin(1,1,choiceName);
                     break;
            case 2 : p1 = new Witcher(1,1,choiceName);
                     break;
            case 3 : p1 = new Welfgor(1,1,choiceName);
                     break;
        }
        
        /**
         * END OF ASKED REQUIRED INFORMATIONS
         * THE GAME BEGINS
         */
        Scanner scanner4 = new Scanner(System.in);
        if(p1 != null){
            
                mapGame.addIntoMap(p1);
                String choiceMenu = null;
                while(!"x".equals(choiceMenu))
                {
                    gameOperation();
                    System.out.print(mapGame.drawMap());
                    
                    try{
                        choiceMenu = scanner4.next();
                    }catch(Exception e){

                        System.out.println("Veuillez saisir une lettre valide");
                    }

                    switch(choiceMenu)
                    {
                        case "q" : p1.moveLeft(mapGame);
                                    break;
                        case "z" : p1.moveTop(mapGame);
                                   break;
                        case "d" : p1.moveRight(mapGame);
                                   break;
                        case "s" : p1.moveBottom(mapGame);
                                   break;
                        case "m" : storeInstance.goToTheMall(p1);
                                   break;
                        case "b" : p1.showBag();
                                   break;
                        case "i" : p1.showInfoPlayer();
                                   break;
                    }
                    clearConsole();
                }
        }
          
    }

    public static void gameOperation(){
        System.out.println("################################################################");
        System.out.println("# Voici les différentes touches utilisable pendant la partie : #");
        System.out.println("# - z pour se déplacer en haut.                                #");
        System.out.println("# - s pour se déplacer en bas.                                 #");
        System.out.println("# - q pour se déplacer à gauche.                               #");
        System.out.println("# - d pour se déplacer à droite.                               #");
        System.out.println("# - m pour aller au magasin d'arme.                            #");
        System.out.println("# - b pour afficher le contenu du sac.                         #");
        System.out.println("# - i pour afficher les informations du personnage.            #");
        System.out.println("################################################################");
    }
        
    /**
     * Use to simulate a fluid player movement in the map. Unfortunately, it creates sometimes display issues. But it can be solve by adding a 1 seconds sleep after 
     * clearConsole
     * @throws AWTException 
     */
    public static void clearConsole() throws AWTException {
            Robot robot = new Robot();
            robot.keyPress(KeyEvent.VK_CONTROL);
            robot.keyPress(KeyEvent.VK_L);
            robot.keyRelease(KeyEvent.VK_L);
            robot.keyRelease(KeyEvent.VK_CONTROL);
    }
    
    public static void sleepOneTime()
    {
        try {
                  TimeUnit.SECONDS.sleep(1);
              } catch (InterruptedException ex) {
                  Logger.getLogger(Paladin.class.getName()).log(Level.SEVERE, null, ex);
              }
    }
    
}

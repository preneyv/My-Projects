
package RPG;
import static RPG.RpgMain.sleepOneTime;
import java.util.Scanner;
import java.util.concurrent.TimeUnit;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author Valere
 * I've decided to make a class for all battles. I've been thinking like in Database Conception.
 * But I'm  not saying that's the right way to do.
 * There is three things involved into the battle : The player, the Breakable(Monster or Barrier) and the Map.
 * Each has a one - one cardinality. So we can put them together into one class  : Battle
 */
public class Battle {
    
    
    private Monster monster=null;
    private Player gamer=null;
    private Barrier barrier =null;
    private Map map=null;
    
    /**
     * 
     * @param m Monster of the fight
     * @param j Player of the fight
     * @param c Map where the fight is.
     */
    public Battle(Monster m, Player j, Map c){
        
        this.monster = m;
        this.gamer = j;
        this.map=c;
    }
    
    /**
     * 
     * @param o Barrier of the fight
     * @param j Player of the fight
     * @param c Map where the fight is.
     */
    public Battle(Barrier o, Player j, Map c){
        this.barrier = o;
        this.gamer = j;
        this.map=c;
    }
    
    /**
     * 
     * @return winner of the fight : null - Joueur - Monstre
     * According to whether the Breakable is a Monster or a Barrier, the matching method is called.
     */
    public String fight()
    {
        
        String resFight = null;
        if(this.monster != null){resFight = this.startFightMonster();}
        if(this.barrier != null){resFight = this.startDestroyBarrier();}
        this.gamer.reUpMana();
        this.gamer.reUpLife();
        return resFight;
    }
    
    /**
     * 
     * @return winner of the fight : Joueur - null(if the player give up the fight) - Monstre
     * There is two menu : first one to go to the battle or not. So, while the user
     * didn't choose 1(Fuir) or 2(Affronter le monstre), a correct answer will be asked.
     * Case 1 the battle is stopped. Case 2 , it goes into the second menu :
     * The fight goes on while the monster's life is greater than 0 and the player's choice is 
     * not equals to 4. That is the right choice to quit.
     * At the end of the fight the game is Stopped if the player is dead, otherwise, the player 
     * take the money and the weapon onto the Monster.
     */
    private String startFightMonster(){
        
        String resFight=null;
        System.out.println("Un combat terrible s'annonce !!!\n"
                         + "Vous êtes face à  "+this.monster.getName());
        System.out.println("#########################################");
        int choiceGoToBattle = 0;
        while( choiceGoToBattle != 1 && choiceGoToBattle != 2)
        {
            System.out.println("Que souhaitez-vous faire ? \n 1) Fuir. \n 2) Affronter le monstre");
            Scanner scanner = new Scanner(System.in);
            
            try{
                choiceGoToBattle = scanner.nextInt();
               
            }catch(Exception e)
            {
                System.out.println("Veuillez saisir un chiffre valide");
            }
            
            switch(choiceGoToBattle)
            {
                   case 1 : System.out.println("Vous fuyez le combat !");
                            break;
                         
                   case 2 : {
                                    int choiceIntoBattle = 0;
                                    System.out.println("Choisissez une arme avant de démarrer le combat !");
                                    this.gamer.chooseWeapon();
                                    while(this.monster.getLife() >0 && choiceIntoBattle != 4)
                                    {
                                        System.out.println("1) Frapper avec arme. \n2) Frapper avec le pouvoir \n3) Attaquer au poing \n4) Rebrousser chemin");
                                        
                                        Scanner scanner2 = new Scanner(System.in);
                                        try{
                                            choiceIntoBattle = scanner2.nextInt();
                                            
                                        }catch(Exception ex)
                                        {
                                                System.out.println("Veuillez saisir un chiffre valide");
                                        }
                                            
                                            switch(choiceIntoBattle)
                                            {
                                            case 1 : this.gamer.useWeaponForAttack(this.monster);
                                                     break;

                                            case 2 : this.gamer.usePowerForAttack(this.monster);
                                                     break;

                                            case 3 : this.gamer.usePunchForAttack(this.monster);
                                                     break;
                                                     
                                            case 4 : System.out.println("Vous fuyez pendant le combat !");
                                                     break;

                                            default : System.out.println("Saisir un chiffre parmis les choix proposé");
                                                      break;
                                            }
                                            if(this.monster.getLife() >0)
                                            {
                                                System.out.println(this.monster.getName()+" essaie de frapper !");
                                                sleepOneTime();
                                                int chanceOfTouch = 1 + (int)(Math.random() * ((2 - 1) + 1));
                                                if(chanceOfTouch == 2){
                                                    this.monster.attackPlayer(this.gamer);
                                                    System.out.println("Le monstre vous a touché !!");
                                                }else{
                                                    System.out.println("Vous avez esquivé ! Bien joué");
                                                }
                                                
                                                System.out.println(this.monster.getName()+" a encore "+this.monster.getLife()+" points de vie.");
                                                System.out.println("Il vous reste "+this.gamer.getLife()+" points de vie.");
                                            }
                                        
                                    }

                                    if(this.gamer.getLife() <= 0 &&  this.monster.getLife()>0)
                                    {
                                            resFight="Monstre";
                                            
                                    }else if(this.monster.getLife()<=0 && this.gamer.getLife() >0){
                                                System.out.println("Vous avez vaincu le monstre !! Félicitation !!");
                                                this.gamer.takeWeaponOnMonster(this.monster);
                                                this.gamer.takeMoneyOnMonster(this.monster);
                                                this.gamer.getMoreXP(150);
                                                resFight="Joueur";

                                      }

                                        
                                    break;
                                }
            }
            
        }
        
       return resFight;  
    }
    
    /**
     * 
     * @return winner of the fight : Joueur - null(if the player give up the demolition)
     * Identical than the previous method except the player can not die
     */
    private String startDestroyBarrier(){
    
        String resFight=null;
        System.out.println( "Vous êtes face à un(e) "+this.barrier.getName());
        System.out.println("#########################################");
        int choiceGoToBattle = 0;
        while( choiceGoToBattle != 1 && choiceGoToBattle != 2)
        {
            System.out.println("Que souhaitez-vous faire ? \n 1) Rebrousser chemin. \n 2) Detruire l'obstacle");
            Scanner scanner = new Scanner(System.in);
            
            try{
                choiceGoToBattle = scanner.nextInt();
            }catch(Exception e)
            {
                System.out.println("[MESSAGE ERREUR : Saisir un chiffre valide]");
            }
            
            switch(choiceGoToBattle)
            {
                   case 1 : System.out.println("Vous rebroussez chemin !");
                            break;
                   case 2 : {
                                    int choiceIntoBattle = 0;
                                    System.out.println("Choisissez une arme avant de commencer la destruction !");
                                    this.gamer.chooseWeapon();
                                    while(this.barrier.getLife() >0 && choiceIntoBattle != 4)
                                    {
                                        System.out.println("1) Frapper avec arme. \n2) Frapper avec le pouvoir \n3) Attaquer au poing \n4) Rebrousser chemin");

                                        Scanner scanner2 = new Scanner(System.in);
                                        try{
                                            choiceIntoBattle = scanner2.nextInt();

                                        }catch(Exception ex)
                                        {
                                           System.out.println("[MESSAGE ERREUR : Saisir un chiffre valide]");
                                        }

                                        switch(choiceIntoBattle)
                                        {
                                            case 1 : this.gamer.useWeaponForAttack(this.barrier);
                                            break;

                                            case 2 : this.gamer.usePowerForAttack(this.barrier);
                                            break;

                                            case 3 : this.gamer.usePunchForAttack(this.barrier);
                                            break;

                                            case 4 : System.out.println("Vous abandonnez la destuction !");
                                            break;

                                            default : System.out.println("[MESSAGE ERREUR : Saisir un chiffre valide]");
                                                      break;

                                        }

                                        System.out.println(this.barrier.getName()+" a encore "+this.barrier.getLife()+" points de vie.");
                                        System.out.println("Il vous reste "+this.gamer.getLife()+" points de vie.");
                                    }


                                    if(this.barrier.getLife()<=0){
                                            System.out.println("Vous avez enfin détruit l'obstacle  !! Félicitation !!");
                                            resFight="Joueur";
                                    }
                                    break;
                            }
                }
            
            
        }
        
       return resFight;  
    }
}

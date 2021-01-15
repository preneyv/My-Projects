package RPG;
import static RPG.RpgMain.clearConsole;
import static RPG.RpgMain.sleepOneTime;
import java.awt.AWTException;
import java.util.ArrayList;
import java.util.Scanner;
import java.util.concurrent.TimeUnit;
import java.util.logging.Level;
import java.util.logging.Logger;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Valere
 */
abstract public class Player extends Entity implements isMovable {
    

    protected String speciality;
    protected double money = 10;
    protected int xp = 0;
    protected  int mana = 50;
    protected Weapon usedWeapon = null;
    protected static double PUNCH_DAMAGE = 2;
    protected  ArrayList<Weapon> bag = new ArrayList();
    
    public Player( int posX, int posY, String name, String c){
        super(posX, posY, name);
        this.speciality=c;
    }
    
    /* 1)THESE METHODS DON'T DO ANYTHING - USE TO SHOW RELATED INFORMATIONS */
    
    /**
     * 
     * @return all the important properties of the player
     */
    public void showInfoPlayer() throws AWTException{
        
        
        String leaveShowInfo=null;
        while(!"x".equals(leaveShowInfo))
        {
            
            clearConsole();
            sleepOneTime();
            System.out.println( "INFOS : \n############\nNom : "+super.name+"\n"+
                "Argent : "+this.money+"\n"+
                "XP : "+this.xp+"\n"+
                "Mana : "+this.mana+"\n"+
                "Arme en main : "+(this.usedWeapon == null ? "Aucune" : this.usedWeapon.getName())+"\n");
            
            System.out.println("tapez x pour sortir");
            Scanner scan = new Scanner(System.in);
            leaveShowInfo = scan.next();
        }
                
    }
    
    /**
     * Show the contained of the bag
     */
    public void showBag() throws AWTException
    {
        String leaveShowBag=null;
        while(!"x".equals(leaveShowBag)){
            clearConsole();
            sleepOneTime();
            if(this.bag.isEmpty())
            {
                System.out.println("Votre sac est vide.");
            }else{

                System.out.println("Voici ce que contient votre sac : ");
                for( Weapon a : this.bag)
                {
                    System.out.println("- "+a.getName());
                }
            }
            System.out.println("tapez x pour sortir");
            Scanner scan = new Scanner(System.in);
            leaveShowBag = scan.next();
        }

    }
    
    /**
     * 
     * @return remaining life of the player
     */
    public double getLife(){return super.life;}
    
    /**
     * 
     * @return the remaining amount of money the player got
     * This method is used when the player has entered into the store
     */
    public double getMoney(){return this.money;}
    
    
    /**
     * 
     * @param a Weapon to buy
     * @param price amount of the Weapon the player is going to buy
     */
    public void buyWeapon(Weapon a, double price){
        
        this.money-=price;
        this.bag.add(a);
    }
      
    
    /*2) THESE METHODS ARE USED WHEN THE FIGHT IS OVER */
    
    /**
     * Got the mana full back
     */
    public void reUpMana(){
        while(this.mana<50)
        {
            mana++;
            System.out.println("Regain mana en cours... \r");
            sleepOneTime();
        }
    }
    
    public void reUpLife(){
        
        super.life = 100;
    }
    
    /**
     * 
     * @param m monster from whom the money is taken
     * these amount is added to the money of the player
     */
    public void takeMoneyOnMonster(Monster m)
    {
        this.money += m.getMoney();
    }
    
     /**
     * 
     * @param m monster from whom the weaon is taken
     * these amount is added to bag of the player
     */
    public void takeWeaponOnMonster(Monster m)
    {
        this.bag.add(m.getWeapon());
    }
    
    /**
     * 
     * @param addedXP amount of xp the player wins.
     * This amount is added to the money of the player
     */
    public void getMoreXP(int addedXP)
    {
        this.xp+=addedXP;
    }
    
    /* 3) THESE METHODS ARE USE FOR FIGHT */
    /**
     * 
     * @param d Entity to kill or break
     * Fight with a weapon
     */
    public void useWeaponForAttack(Breakable d) {
        double damage = this.usedWeapon == null ? 0 :this.usedWeapon.getDamage();
        d.gotHit(damage);
        
    }
    
    /**
     * 
     * @param d Entity to kill or break
     * Fight with arms
     */
    public void usePunchForAttack(Breakable d) {
        double damage = PUNCH_DAMAGE;
        d.gotHit(damage);
        
    }
    
    /**
     * Méthod used when player has got to choose a weapon so he can kill or 
     * destroy the monster or barrier
     */
    public void chooseWeapon(){
        System.out.println("Vous avez dans votre sac : ");
        if (this.bag.isEmpty()){
            System.out.println("Rien - Vous ne pouvez attaquer avec une arme. Utilisez votre pouvoir ou attaquez au poing");
        }else{
            for(Weapon ar : this.bag)
            {
                System.out.println((this.bag.indexOf(ar)+1)+") " + ar.getName());
            }
            System.out.println();
            System.out.println("Choisissez l'item");
            Scanner scan = new Scanner(System.in);
            int weaponChoice = scan.nextInt();
            this.usedWeapon = this.bag.get(weaponChoice-1);
            
        }
        
    }
      
    /* 4) Moving methods */
    @Override
    public void moveLeft(Map m)
    {
        String resFight = "Joueur";
        if(super.posY>1)
        {
            if(m.mapToDrawXAxe.get(super.posX).get(super.posY-1) != null)
            {
                try {
                    clearConsole();
                } catch (AWTException ex) {
                    Logger.getLogger(Player.class.getName()).log(Level.SEVERE, null, ex);
                }
                Battle fgt;
                if(("Monster".equals(m.mapToDrawXAxe.get(super.posX).get(super.posY-1).getClass().getSimpleName())))
                {
                    fgt = new Battle((Monster) m.mapToDrawXAxe.get(super.posX).get(super.posY-1),this,m);
                    resFight=fgt.fight();
                }else if(("Barrier".equals(m.mapToDrawXAxe.get(super.posX).get(super.posY-1).getClass().getSimpleName()))){
                    
                    fgt = new Battle((Barrier) m.mapToDrawXAxe.get(super.posX).get(super.posY-1),this,m);
                    resFight = fgt.fight();
                   
                }
                
            }
            
            if("Joueur".equals(resFight)){
                m.removeFromMap(this);
                super.posY--;
                m.addIntoMap(this);
            }else if("Monster".equals(resFight))
            {
                m.removeFromMap(this);
               
            }
        }
    }
    
    @Override
    public void moveRight(Map m)
    {
        String resFight = "Joueur";
        if(super.posY<m.mapToDrawXAxe.get(super.posX).size()-2)
        {
            
            if(m.mapToDrawXAxe.get(super.posX).get(super.posY+1) != null)
            {
                try {
                    clearConsole();
                } catch (AWTException ex) {
                    Logger.getLogger(Player.class.getName()).log(Level.SEVERE, null, ex);
                }
                Battle fgt;
                if(("Monster".equals(m.mapToDrawXAxe.get(super.posX).get(super.posY+1).getClass().getSimpleName())))
                {
                    fgt = new Battle((Monster) m.mapToDrawXAxe.get(super.posX).get(super.posY+1),this,m);
                    resFight=fgt.fight();
                }else if(("Barrier".equals(m.mapToDrawXAxe.get(posX).get(posY+1).getClass().getSimpleName()))){
                    
                    fgt = new Battle((Barrier) m.mapToDrawXAxe.get(super.posX).get(super.posY+1),this,m);
                    resFight = fgt.fight();
                }
                
            }
            
            if("Joueur".equals(resFight)){
                m.removeFromMap(this);
                super.posY++;
                m.addIntoMap(this);
            }else if("Monster".equals(resFight))
            {
                m.removeFromMap(this);
               
            }
            
        }
    }
    
    @Override
    public void moveTop(Map m)
    {
        String resFight = "Joueur";
        if(super.posX>1)
        {
            
            if(m.mapToDrawXAxe.get(super.posX-1).get(super.posY) != null)
            {
                try {
                    clearConsole();
                } catch (AWTException ex) {
                    Logger.getLogger(Player.class.getName()).log(Level.SEVERE, null, ex);
                }
                Battle fgt;
                if(("Monster".equals(m.mapToDrawXAxe.get(super.posX-1).get(super.posY).getClass().getSimpleName())))
                {
                    fgt = new Battle((Monster) m.mapToDrawXAxe.get(super.posX-1).get(super.posY),this,m);
                    resFight=fgt.fight();
                }else if(("Barrier".equals(m.mapToDrawXAxe.get(super.posX-1).get(super.posY).getClass().getSimpleName()))){
                    
                    fgt = new Battle((Barrier) m.mapToDrawXAxe.get(super.posX-1).get(super.posY),this,m);
                    resFight = fgt.fight();
                   
                }
                
            }
            
            if("Joueur".equals(resFight)){
                m.removeFromMap(this);
                super.posX--;
                m.addIntoMap(this);
            }else if("Monster".equals(resFight))
            {
                m.removeFromMap(this);
               
            }
        }
    }
    
    @Override
    public void moveBottom(Map m)
    {
        String resFight = "Joueur";
        if(super.posX<m.mapToDrawXAxe.size()-2)
        {
            if(m.mapToDrawXAxe.get(super.posX+1).get(super.posY) != null)
            {
                try {
                    clearConsole();
                } catch (AWTException ex) {
                    Logger.getLogger(Player.class.getName()).log(Level.SEVERE, null, ex);
                }
                Battle fgt;
                if(("Monster".equals(m.mapToDrawXAxe.get(super.posX+1).get(super.posY).getClass().getSimpleName())))
                {
                    fgt = new Battle((Monster) m.mapToDrawXAxe.get(super.posX+1).get(super.posY),this,m);
                    resFight=fgt.fight();
                }else if(("Barrier".equals(m.mapToDrawXAxe.get(posX+1).get(posY).getClass().getSimpleName()))){
                    
                    fgt = new Battle((Barrier) m.mapToDrawXAxe.get(super.posX+1).get(super.posY),this,m);
                    resFight = fgt.fight();
                }
                
            }
            
            if("Joueur".equals(resFight)){
                m.removeFromMap(this);
                super.posX++;
                m.addIntoMap(this);
            }else if("Monster".equals(resFight))
            {
                m.removeFromMap(this);
               
            }
        }
    }
    
    /**
     * Méthode abstraite
     * @param d le Destructible à attaquer
     */
    abstract public void usePowerForAttack(Breakable d);
    
    
     
}

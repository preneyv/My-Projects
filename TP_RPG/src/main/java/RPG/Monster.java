package RPG;

/**
 *
 * @author Valere
 * This class extends from Breakable
 */
public class Monster extends Breakable{
    
    private Weapon weapon;
    private double money;
    
    /**
     * 
     * @param posX X Axis position of the monster.
     * @param posY Y Axis position of the monster.
     * @param a Weapon the monster got.
     * @param name monster's name.
     * @param m amount of money the monster has.
     */
    public Monster( int posX, int posY, Weapon a,String name, double m)
    {
        super(posX, posY, name);
        this.weapon = a;
        this.money = m;
    }
    
    public void attackPlayer(Player j)
    {
        j.gotHit(15);
       
    }
    
    /**
     * 
     * @return the amount of money the monster has.
     */
    public double getMoney(){return this.money;}
    
    /**
     * 
     * @return the weapon the monster got.
     */
    public Weapon getWeapon(){return this.weapon;}
 
}

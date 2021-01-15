package RPG;

/**
 *
 * @author Valere
 * Define the mother class of Bow, Hammer and Axes.
 * Properties are defined by calling super() from children class
 */
abstract class Weapon {
    
    protected static int DAMAGE;
    protected String name;
    
    public Weapon(int d, String n){
        this.name = n;
        DAMAGE = d;
    }
    
    /**
     * 
     * @return damage of the weapon
     */
    public double getDamage(){return DAMAGE;}
    
    /**
     * 
     * @return name of the Weapon 
     */
    public String getName(){return this.name;}
    
    /**
     * 
     * @return an ASCII Draw of the matching child class
     */
    abstract public String getAsciArt();

}

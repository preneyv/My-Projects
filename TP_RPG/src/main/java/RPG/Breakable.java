package RPG;

/**
 *
 * @author Valere
 */
public class Breakable extends Entity{

    public Breakable( int posX, int posY, String name)
    {
        super(posX,posY,name);
    }

    /**
     * Methods that put forward some information about the object.
     * Aren't doing anything
     */
    
    /**
     * 
     * @return remaining life
     */
    public double getLife(){return super.life;}
    
    /**
     * 
     * @return name of the breakable
     */
     public String getName(){return super.name;}
}

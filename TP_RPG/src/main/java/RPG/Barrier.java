package RPG;

/**
 *
 * @author Valere
 * This class extends from Breakable
 */
public class Barrier extends Breakable{
    
    /**
     * 
     * @param posX X Axis position of the barrier
     * @param posY Y Axis position of the barrier
     * @param name name to identify what kind of barrier it is (Stone - Tree ...)
     */
    public Barrier( int posX, int posY, String name)
    {
        super(posX, posY, name);
        
    }

}

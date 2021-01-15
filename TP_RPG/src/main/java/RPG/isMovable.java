package RPG;

/**
 *
 * @author Valere
 * Interface for all move a player can do.
 */
public interface isMovable {
    
    abstract public void moveRight(Map m);
    abstract public void moveLeft(Map m);
    abstract public void moveTop(Map m);
    abstract public void moveBottom(Map m);
}

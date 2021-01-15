package RPG;

/**
 *
 * @author Valere
 * Represent all things that have a position into the map.
 * It's the mother class of Player and Breakable
 * Only position absissa (posX) and orderly (posY) are defined here.
 */
public class Entity {
    
    protected int posX;
    protected int posY;
    protected double life = 100.00;
    protected String name;
    
    public Entity(int x, int y, String n){
        posX=x;
        posY=y;
        name=n;
    }
    
    public void gotHit(double d){life = life-d < 0 ? 0 : life-d;}
}

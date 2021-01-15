package RPG;

/**
 *
 * @author Valere
 */
public class Welfgor extends Player{

    private static final  int POWER_DAMAGE = 30; // amount of life taking point from the monster or barrier
    private static final int MANA_LOSE_PER_ATTACK = 2;// the player lose 2 points of mana when he uses power.
    
    /**
     * 
     * @param posX X Axis position of the welgor.
     * @param posY Y Axis position of the welfgor.
     * @param name paladin's name
     */
    public Welfgor( int posX, int posY,String name) {
        super(posX, posY,name,"Welfgor");
    }

     /**
     * 
     * @param d breakable (monster or barrier to fight)
     * When the player use power in a fight, it takes mana.
     */
    @Override
    public void usePowerForAttack(Breakable d) {
        if (super.mana>=MANA_LOSE_PER_ATTACK)
        {
            d.gotHit(POWER_DAMAGE);
            super.mana-=MANA_LOSE_PER_ATTACK;
        }else{
            System.out.println("Vous n'avez pas assez de mana. Essayez de combattre avec une arme ou au poing");
        }
        
    }
    
}

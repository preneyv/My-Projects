package RPG;

/**
 *
 * @author Valere
 * Class Hammer extended from Weapon Class.
 * Theirs properties are define when the class is created. Each hammer has his own DAMAGE and name.
 * 
 */
public class Hammer extends Weapon{

    public Hammer(int d, String n){
        super(d, n);   
    }

    /**
     * 
     * @return an ASCII Draw of the Hammer
     */
    @Override
    public String getAsciArt() {
                return " _ _ \n" +
                       "|_|_|\n" +
                        " | \n" +
                        " | \n";
    }
}


    


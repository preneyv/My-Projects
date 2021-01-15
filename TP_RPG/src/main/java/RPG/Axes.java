package RPG;

/**
 *
 * @author Valere
 * Class Axes extended from Weapon Class.
 * Theirs properties are define when the class is created. Each Axe has his own DAMAGE and name.
 * 
 */
public class Axes extends Weapon{

    public Axes(int d, String n){
        super(d, n); 
    }
    
    /**
     * 
     * @return an ASCII Draw of the Axe
     */
    @Override
    public String getAsciArt(){
        
        return
                "  /’-./\\ \n"+
                " :    ||,>\n"+
                " \\.-’|| \n"+
                "      ||\n"+
                "      ||\n"+
                "      ||\n";
    }
}

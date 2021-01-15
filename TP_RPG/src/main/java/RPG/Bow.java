package RPG;


/**
 *
 * @author Valere
 * Class Bow extended from Weapon Class.
 * Theirs properties are define when the class is created. Each bow has his own DAMAGE and name.
 * 
 */

public class Bow extends Weapon{
    

    
    public Bow(int d, String n){
        super(d, n);
        
    }
    
    /**
     * 
     * @return an ASCII Draw of the Bow
     */
    @Override
    public String getAsciArt(){
        return "( \n"+
               "\\ \n"+
               "  )\n"+
           "##-------->\n"+ 
               "  )\n"+
               " /\n"+
               "(\n";
    }
}


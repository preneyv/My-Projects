
package RPG;

import java.util.ArrayList;

/**
 *
 * @author Valere
 */
public final class Map {
        
    ArrayList<ArrayList<Entity>> mapToDrawXAxe = new ArrayList<>();
    private final int length ;
    private final int width;

    /**
     * 
     * @param l length of the map (will be the size of mapToDrawXAxe)
     * @param w width of the map (will be the size of mapToDrawYAxe)
     */
    public Map( int l, int w)
    {
        this.length = l;
        this.width =w;
        this.mapInit();
    }
    
    
    /**
     * create the map
     * then add monsters and barriers
     */
    public void mapInit()
    {
        for(int i=0; i<this.length; i++)
        {
                ArrayList<Entity> mapToDrawYAxe = new ArrayList<>();
                for(int j=0; j<this.width; j++)
                {
                    
                     mapToDrawYAxe.add(j, null);
                    
                }
                this.mapToDrawXAxe.add(mapToDrawYAxe);
        }
        
        this.addMonster();
        this.addBarrier();
        
    }
    
    /**
     * this method add monsters to the map.
     * arrays are monster's names and their weapons. A bound is made up between two arrays thanks to the index
     * The X axis position and the Y one are random maded.
     * a weapon is created and the monster too. Then the monster is added into the map.
     */
    public void addMonster()
    {
        String[] monstersNames = {"Max Le pourfandeur", "Tom","Beth le Débile", "Orgie la cochonne", "Péggie", "Isra le dévoreur", "Titi le pacidoux"};
        String[] weaponsNames = {"Marteau final", "Marteau du noir-Levé", "Marteau Smash", "Marteau-teau-teau","Marteau de l'oppresseur", "Marteau qui n'en est pas un", "ToMar"};
        for( int i=0; i<monstersNames.length; i++)
        {
            int posX = 1 + (int)(Math.random() * (((this.mapToDrawXAxe.size()-1) - 1)));
            int posY = 1 + (int)(Math.random() * (((this.mapToDrawXAxe.get(posX).size()-1) - 1)));
            Weapon badGuyWeapon = new Hammer(10, weaponsNames[i]);
            Breakable d = new Monster( posX, posY, badGuyWeapon,monstersNames[i], 10.0);
            this.addIntoMap(d);
        }
    }
    
    
    /**
     * this method add barriers to the map.
     * arrays are barrier's names.
     * The X axis position and the Y one are random maded.
     * the barrier is created. Then the barrier is added into the map.
     */
    public void addBarrier()
    {
        String[] barriersNames = {"Pierre", "Arbre","Racines Profondes", "Rocher", "Barrage", "Pierre", "Mur de Plantes"};
        for( String name : barriersNames)
        {
            int posX = 1 + (int)(Math.random() * (((this.mapToDrawXAxe.size()-1) - 1)));
            int posY = 1 + (int)(Math.random() * (((this.mapToDrawXAxe.get(posX).size()-1) - 1)));
            Breakable d = new Barrier( posX, posY,name);
            this.addIntoMap(d);
        }
    }
    

    /**
     * 
     * @param j entity to add into the map
     * 
     */
    public void addIntoMap(Entity j)
    {
        this.mapToDrawXAxe.get(j.posX).remove(j.posY);
        this.mapToDrawXAxe.get(j.posX).add(j.posY, j);
    }

    /**
     * 
     * @param e entity to remove from the map
     */
    public void removeFromMap(Entity e)
    {
        this.mapToDrawXAxe.get(e.posX).remove(e.posY);
        this.mapToDrawXAxe.get(e.posX).add(e.posY,null);
    }
    
    /**
     * 
     * @return the draw of the map for the standart out.
     * sides are represented by #, Player by J, Monster by M and Barrier by O
     */
    public String drawMap()
    {
     String res="";
        for(int i=0; i<this.mapToDrawXAxe.size(); i++)
            {
                for(int j=0; j<this.mapToDrawXAxe.get(i).size(); j++)
                {
                     
                    if((i==0 || i==this.mapToDrawXAxe.size()-1) || (j==0 || j==this.mapToDrawXAxe.get(i).size()-1))
                    {

                            res+="#";   
                        
                    }else{
                        if(this.mapToDrawXAxe.get(i).get(j) != null)
                        {
                            
                            if(  (("Paladin").equals(this.mapToDrawXAxe.get(i).get(j).getClass().getSimpleName()))
                                 || (("Witcher").equals(this.mapToDrawXAxe.get(i).get(j).getClass().getSimpleName()))
                                 || (("Welfgor").equals(this.mapToDrawXAxe.get(i).get(j).getClass().getSimpleName()))
                               ){res+="J";}
                            if("Monster".equals(this.mapToDrawXAxe.get(i).get(j).getClass().getSimpleName())){res+="M";} 
                            if("Barrier".equals(this.mapToDrawXAxe.get(i).get(j).getClass().getSimpleName())){res+="O";} 
                        }else{
                            res+=" "; 
                        }

                    }
                }
                res+="\n";
            }
        return (res+"\b");
    }
    
}

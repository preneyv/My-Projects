package com.tarot.model;

/**
 * extented from Card. This is one of the three type of Card
 */
public class ArcanesMajestueuses extends Card{

    /**
     * planet value of the choosen planet
     */
    private final String planet;

    /**
     * constructor
     * @param n number of the card
     * @param p picture of the card (only the path)
     * @param nm name of the card
     * @param pl planet of the card
     */
    public ArcanesMajestueuses(String n, String p, String nm, String pl) {
        super(n, p, nm);
        this.planet = pl;
    }

    /**
     * inherited method of Card
     * Useless here.
     * Here remains a question : Is it a good thing to implements useless methods
     * but not so for other class inherited from card
     */
    @Override
    public String getSortOf() {return null;}

    @Override
    public String getElement() {return null;}

    @Override
    public String getDom() {return null;}


    /**
     *
     * @return the value of planet property
     */
    @Override
    public String getPlanet() {
        return this.planet;
    }

    /**
     *
     * toString() what !
     */
    @Override
    public String toString() {return "<html>Nom de la carte : "+this.name+
                                     "<br/><br> Chiffre : "+this.number+
                                     "<br><br>Planete : "+this.planet+"</html>";}
}

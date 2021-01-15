package com.tarot.model;

/**
 * extented from Card. This is one of the three type of Card
 */


public  class ArcanesMineures extends Card{

    private final String dom;

    /**
     * Constructor
     * @param number number of the card
     * @param p picture of the card
     * @param nm name of the card
     * @param dom domain of the card
     */
    public ArcanesMineures( String number,String p,  String nm,  String dom) {
        super(number, p, nm);
        this.dom = dom;

    }

    /**
     *
     * @return the domain value
     */
    public String getDom() {return this.dom;}

    /**
     * toString() what !
     */
    @Override
    public String toString(){return "<html>Nom de la carte : <br>"+this.name+"</html>";}

    /**
     * inherited method of Card
     * Useless here.
     * Here remains a question : Is it a good thing to implements useless methods
     * but not so for other class inherited from card
     *
     */
    public String getSortOf(){return null;}
    public  String getElement(){return null;}
    public String getPlanet() {return null;}
}

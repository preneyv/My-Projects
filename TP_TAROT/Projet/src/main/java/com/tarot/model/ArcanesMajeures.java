package com.tarot.model;

/**
 * extented from Card. This is one of the three type of Card
 */
public class ArcanesMajeures extends Card {

    private final String sortOf;
    private final String element;

    /**
     * Constructor
     * @param n number of the card
     * @param p picture of the card (only the path)
     * @param nm name of the card
     * @param sf sortOf of the card
     * @param el element of the card
     */
    public ArcanesMajeures(String n, String p, String nm, String sf, String el) {
        super(n, p, nm);
        this.sortOf = sf;
        this.element = el;
    }

    /**
     *
     * @return the sortOf value
     */
    public String getSortOf(){return this.sortOf;}

    /**
     *
     * @return the element value
     */
    public String getElement(){return this.element;}

    /**
     * toString() what !
     *
     */
    @Override
    public String toString(){return "<html>Nom de la carte : "+this.name+
                                    "<br/><br> Chiffre : "+this.number+
                                    "<br><br>Genre : "+this.sortOf+
                                    "<br><br>Element : "+this.element+"</html>";}
    /**
     * inherited method of Card
     * Useless here.
     * Here remains a question : Is it a good thing to implements useless methods
     * but not so for other class inherited from card
     *
     */
    @Override
    public String getDom() {return null;}
    @Override
    public String getPlanet() {return null;}
}

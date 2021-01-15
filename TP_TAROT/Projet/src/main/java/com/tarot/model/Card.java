package com.tarot.model;

import javax.swing.*;
import java.awt.*;

/**
 * Mother class representing Card entity
 */
public abstract class Card {

    protected String number;
    protected String picture;
    protected String name;

    /**
     * Contructor
     * @param n number of the card
     * @param p picture of the card
     * @param nm name of the card
     */
    public Card(String n, String p, String nm)
    {
        this.number = n;
        this.picture = p;
        this.name = nm;
    }

    /**
     * set the name of the card
     * @param n new name value
     */
    public void setName(String n){this.name = n;}

    /**
     *
     * @return the value of the picture (only the path)
     */
    public String getPicture(){return this.picture;}

    /**
     *
     * @return name of the card
     */
    public String getNom(){return this.name;}

    /**
     *
     * @return number of the card
     */
    public String getNumber(){return this.number;}

    /**
     * resize the image so it can fill into the Card panel
     * @param width new width of the image
     * @param height new height of the image
     * @return the new ImageIcon
     */
    public ImageIcon resizeImage(int width, int height)
    {
       ImageIcon imgToResize = new ImageIcon(getClass().getResource("/images/").getPath()+this.picture);
       Image img = imgToResize.getImage().getScaledInstance(width, height, Image.SCALE_SMOOTH);
        return new ImageIcon(img);
    }

    /**
     * abstract methods
     *
     */
    public abstract String getSortOf();
    public abstract String getElement();
    public abstract String getDom();
    public abstract String getPlanet();
    public abstract String toString();


}

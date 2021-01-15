package com.tarot.model;

import com.tarot.observer.*;
import java.util.ArrayList;

/**
 * this class is the mother class of player
 * this is the one that informs the observer of any change and update them so the view either.
 */
public abstract class AbstractModel implements Observable{

    private ArrayList<Observer> listObserver = new ArrayList<>();

    public abstract void addCard(Card c);
    public abstract void removeCard(Card c);
    public abstract void setPlayer(String f, String s);
    public abstract void setPlayer(String f, String s, ArrayList<Card> c);
    public abstract void setCard(Card cToRm,Card cToAdd);

    /**
     * add observer to the list
     * @param obs observer to add
     */
    public void addObserver(Observer obs){this.listObserver.add(obs);}

    /**
     * remove all the observer from the list
     */
    public void removeObserver(){this.listObserver = new ArrayList<>();}

    /**
     * inform all the observer for any change
     * @param p the model that change
     */
    public void notifyObserver(Player p){
        for(Observer o : this.listObserver)
        {
            o.update(p);
        }
    }




}

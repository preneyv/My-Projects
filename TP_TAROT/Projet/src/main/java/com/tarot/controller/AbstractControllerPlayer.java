package com.tarot.controller;
import com.tarot.model.AbstractModel;
import com.tarot.model.Card;
import com.tarot.model.Player;

/**
 *This Abstract  class is usefull in case we create several classes inherited from this one. Here there is only
 * one, but in a good developping mood, it's the good to do.
 */
public abstract class AbstractControllerPlayer {

    /**
     * absModel the abstractModel the controller has got an eye to keep on
     * firstname the name of the player that is going to be set
     * sexuality idem
     * card the card that will be set, remove or add to the collection card
     */
    protected AbstractModel absModel;
    protected String firstname;
    protected String sexuality;
    protected Card card;

    /**
     * Constructor
     * @param aM the abstract model the controller has got an eye to keep on.
     */
    public AbstractControllerPlayer(AbstractModel aM)
    {
        this.absModel = aM;
    }

    /**
     * add a card to the player collction
     * @param c the card to add
     */
    public void addCollectionCardPlayer( Card c)
    {

        this.card = c;
        controlAddCard();
    }

    /**
     * remove a card from the player collection
     * @param c the card to remove
     */
    public void removeCollectionCardPlayer( Card c)
    {

        this.card = c;
        controlRemoveCard();
    }

    /**
     * set the name and the sexuality of the player
     * @param f the new name value
     * @param s the new sexuality value
     */
    public void setPlayer( String f, String s)
    {
        this.firstname = f;
        this.sexuality = s;
        controlSetPlayer();
    }

    /**
     * set a card by modify one of their properties in the paneldetailcard
     * it remove the old one and add the new one created after the user has validated the changes
     * @param cToRm card to remove
     * @param cToAdd new card taking the place of the card to remove
     */
    public void setCard(Card cToRm, Card cToAdd)
    {
        this.card = cToAdd;
        controlSetCard(cToRm);

    }

    /**
     * save the profil
     */
    public void savePlayerProfile(){
        ((Player)this.absModel).objToJson();
    }

    abstract void controlAddCard();
    abstract void controlRemoveCard();
    abstract void controlSetPlayer();
    abstract void controlSetCard(Card cToRm);
}

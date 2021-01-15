package com.tarot.controller;

import com.tarot.model.AbstractModel;
import com.tarot.model.Card;

/**
 * The real controller class. Extended from AbstractControllerPlayer
 */
public class ControllerPlayer extends AbstractControllerPlayer {

    /**
     * constructor
     * @param aM abstract model(here the player) to watch
     */
    public ControllerPlayer(AbstractModel aM) {
        super(aM);
    }

    /**
     * ask to the model to add the card to his collection
     */
    @Override
    public void controlAddCard() {
        this.absModel.addCard(this.card);
    }

    /**
     * ask to the model to remove the card to his collection
     */
    @Override
    public void controlRemoveCard(){
        this.absModel.removeCard(this.card);
    }

    /**
     * ask to the model to set his firstname and sexuality values
     */
    @Override
    public void controlSetPlayer() {this.absModel.setPlayer(this.firstname, this.sexuality);}

    /**
     * ask to the model to replace the old card by the new one
     * @param cToRm card to remove (old card)
     */
    @Override
    public void controlSetCard(Card cToRm) {this.absModel.setCard(cToRm, this.card);}
}

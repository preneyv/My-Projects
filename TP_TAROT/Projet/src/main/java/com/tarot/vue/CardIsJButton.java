package com.tarot.vue;

import com.tarot.model.Card;

import javax.swing.*;
import java.awt.*;


/**
 * Represents a card of the collection. It's a formated button so the panel detail can be set.
 */
public class CardIsJButton extends JButton {

    private final Card cardOfLabel;

    /**
     * Constructor
     * @param c card linked to the button
     */
    public CardIsJButton(Card c)
    {
        this.cardOfLabel = c;
        this.setIcon(cardOfLabel.resizeImage(90,172));
        this.setText(this.cardOfLabel.getNom());
        this.setHorizontalTextPosition(SwingConstants.CENTER);
        this.setVerticalTextPosition(SwingConstants.BOTTOM);
        this.setBackground(null);
        this.setOpaque(false);
        this.setContentAreaFilled(false);
        this.setBorderPainted(false);
        this.setPreferredSize(new Dimension(100,190));
        this.setMargin(new Insets(5,-15,0 ,0));
        this.setBorder(null);
        this.setForeground(Color.WHITE);
    }

    /**
     *
     * @return the card linked to the button
     */
    public Card getCard(){return this.cardOfLabel;}



}

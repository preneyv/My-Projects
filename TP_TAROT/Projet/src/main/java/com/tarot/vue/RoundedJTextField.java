package com.tarot.vue;

import javax.swing.*;
import java.awt.*;

/**
 * To make a rounded JTextField. Useless here, but interesting to learn
 */
public class RoundedJTextField extends JTextField {

    public RoundedJTextField(int size)
    {
        super(size);
        this.setBackground(new Color(50,51,50));
        this.setForeground(Color.WHITE);
        this.setToolTipText("Entre votre prénom");

    }
    @Override protected void paintComponent(Graphics g) {
        if (!isOpaque() && getBorder() instanceof RoundedCornerBorder) {
            Graphics2D g2 = (Graphics2D) g.create();
            g2.setPaint(getBackground());
            g2.fill(((RoundedCornerBorder) getBorder()).getBorderShape(
                    0, 0, getWidth() , getHeight()));
            g2.dispose();

        }

        super.paintComponent(g);
    }
    @Override public void updateUI() {
        super.updateUI();
        setOpaque(true);
        setBorder(new RoundedCornerBorder());
    }
}

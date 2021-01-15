package com.tarot.vue;


import java.awt.*;
import java.awt.event.*;

/**
 * Button Action Listener
 * The method will be activeted thanks to the hashmap (see vueMain)
 */
public class ButtonAction implements MouseListener {


    @Override
    public void mouseClicked(MouseEvent e) {
        Component clickedJbtn = (Component)e.getSource();
        if(VueTest.mapBtnClickAction.get(clickedJbtn) != null)
            VueTest.mapBtnClickAction.get(clickedJbtn).pressBtn(clickedJbtn);
    }

    @Override
    public void mousePressed(MouseEvent e) {

    }

    @Override
    public void mouseReleased(MouseEvent e) {

    }

    @Override
    public void mouseEntered(MouseEvent e) {
        Component hoveredBtn = (Component)e.getSource();
        if(VueTest.mapBtnHoverAction.get(hoveredBtn) != null)
            VueTest.mapBtnHoverAction.get(hoveredBtn).hoverIn(hoveredBtn);
    }

    @Override
    public void mouseExited(MouseEvent e) {
        Component hoveredBtn = (Component)e.getSource();
        if(VueTest.mapBtnHoverAction.get(hoveredBtn) != null)
            VueTest.mapBtnHoverAction.get(hoveredBtn).hoverOut(hoveredBtn);

    }
}

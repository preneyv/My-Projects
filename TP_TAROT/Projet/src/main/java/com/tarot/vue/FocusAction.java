package com.tarot.vue;

import java.awt.*;
import java.awt.event.FocusEvent;
import java.awt.event.FocusListener;

/**
 * Focus Action Listener
 * The method will be activeted thanks to the hashmap (see vueMain)
 */
public class FocusAction implements FocusListener {
    @Override
    public void focusGained(FocusEvent e) {
        Component clickedJbtn = (Component)e.getSource();
        if(VueTest.mapFocusComponent.get(clickedJbtn) != null)
            VueTest.mapFocusComponent.get(clickedJbtn).focusOn(clickedJbtn);
    }

    @Override
    public void focusLost(FocusEvent e) {

        Component clickedJbtn = (Component)e.getSource();
        if(VueTest.mapFocusComponent.get(clickedJbtn) != null)
            VueTest.mapFocusComponent.get(clickedJbtn).focusOut(clickedJbtn);
    }
}

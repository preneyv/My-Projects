package com.tarot.vue;

import javax.swing.*;
import java.awt.event.ItemEvent;
import java.awt.event.ItemListener;

/**
 * ComboBox Action Listener
 * The method will be activeted thanks to the hashmap (see vueMain)
 */
public class ComboBoxAction implements ItemListener {
    @Override
    public void itemStateChanged(ItemEvent e) {
        JComboBox comboBoxClicked = (JComboBox) e.getSource();
        if(VueTest.mapBtnComboBoxItemChange.get(comboBoxClicked) != null)
            VueTest.mapBtnComboBoxItemChange.get(comboBoxClicked).itemChange(comboBoxClicked);
    }
}

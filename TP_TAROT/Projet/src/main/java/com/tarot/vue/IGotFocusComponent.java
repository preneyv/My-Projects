package com.tarot.vue;

import java.awt.*;

/**
 * For all classes that have a component with a focus event
 */
public interface IGotFocusComponent {

    void focusOn(Component c);
    void focusOut(Component c);
}

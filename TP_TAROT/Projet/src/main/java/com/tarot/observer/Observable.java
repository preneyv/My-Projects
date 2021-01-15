package com.tarot.observer;
import com.tarot.model.Player;

/**
 * Interface for observed classes (here the Abstract Model)
 */
public interface Observable {

    void addObserver(Observer obs);
    void removeObserver();
    void notifyObserver(Player p);
}

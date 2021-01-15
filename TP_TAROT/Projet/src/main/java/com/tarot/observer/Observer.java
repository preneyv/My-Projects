package com.tarot.observer;
import com.tarot.model.Player;

/**
 * Interface for Observer so they can update when a change has been revealed.
 */
public interface Observer {
    void update(Player p);
}

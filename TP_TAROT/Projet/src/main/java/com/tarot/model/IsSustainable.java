package com.tarot.model;

/**
 * Interface that save object. I've prefered an interface because it makes the application easier to add other
 * sustainable object
 */
public interface IsSustainable {

    void objToJson();
    Player jsonToObj();
}

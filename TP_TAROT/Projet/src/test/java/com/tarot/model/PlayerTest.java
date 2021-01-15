package com.tarot.model;

import junit.framework.TestCase;

import java.util.ArrayList;

public class PlayerTest extends TestCase {

    private  Player pl;
    public PlayerTest(String name){
        super(name);
    }

    @Override
    protected void setUp() throws Exception{
        super.setUp();
        pl = new Player("prenom","homme", new ArrayList<Card>());
    }

    @Override
    protected void tearDown() throws Exception {
        super.tearDown();
        pl = null;
    }

    public void testPlayer(){
        assertNotNull("Linstance n'est pas créée",pl);
    }

    public void testSetPlayer()
    {
        pl.setPlayer("prenom2","femme");
        assertEquals("Le nom est incorrect","prenom2",pl.getFirstname());
        assertEquals("Le sexe est incorrect","feme",pl.getSexuality());
    }
}

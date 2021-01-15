package com.tarot.model;

import org.junit.Test;

class mainTest {


        @Test
        public static void main(String args[]) throws Exception {
                PlayerTest plTest= new PlayerTest("TestPlayer");
                plTest.setUp();
                plTest.testPlayer();
        }

}
package models.tests;

import models.animal.Animal;
import models.animal.enumerations.HealAnimal;
import models.animal.species.Wolf;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.BeforeEach;
import static org.junit.jupiter.api.Assertions.*;

class AnimalTest {

   private static Animal animalTest;

    @BeforeEach
    void setup() {
        animalTest = new Wolf("Name");
    }

    @Test
    void hungerTest() {
        assertFalse(animalTest.getHunger());
        animalTest.setHunger(true);
        assertTrue(animalTest.getHunger());
    }

    @Test
    void sleepTest() {
        assertFalse(animalTest.getSleep());
        animalTest.setSleep(true);
        assertTrue(animalTest.getSleep());
    }

    @Test
    void healthTest() {
        assertSame(animalTest.getHeal(), HealAnimal.GOOD);
        animalTest.setHeal(HealAnimal.SICK);
        assertSame(animalTest.getHeal(), HealAnimal.SICK);
    }

    @Test
    void feedTest() {
        animalTest.setHunger(true);
        assertTrue(animalTest.feed());
        assertFalse(animalTest.getHunger());
        animalTest.setHunger(true);
        animalTest.setSleep(true);
        assertFalse(animalTest.feed());
    }

    @Test
    void soundTest() {
        assertEquals("Name pousse un cri.", animalTest.sound());
    }

    @Test
    void healTest() {
        animalTest.setHeal(HealAnimal.SICK);
        animalTest.heal();
        assertSame(HealAnimal.GOOD, animalTest.getHeal());
    }

    @Test
    void toggleSleepTest() {
        assertFalse(animalTest.getSleep());
        animalTest.toggleSleep();
        assertTrue(animalTest.getSleep());
    }

}
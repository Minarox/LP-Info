package models.tests;

import models.animal.Animal;
import models.animal.species.Whale;
import models.animal.species.Wolf;
import models.enclosure.Enclosure;
import models.enclosure.enumerations.CleanlinessEnclosure;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import static org.junit.jupiter.api.Assertions.*;

class EnclosureTest {

    private static Enclosure enclosureTest;

    @BeforeEach
    void setup() {
        enclosureTest = new Enclosure("Name", 15.7, 1);
    }

    @Test
    void cleanlinessTest() {
        assertSame(CleanlinessEnclosure.GOOD, enclosureTest.getCleanliness());
        enclosureTest.setCleanliness(CleanlinessEnclosure.CORRECT);
        assertSame(CleanlinessEnclosure.CORRECT, enclosureTest.getCleanliness());
    }

    @Test
    void animalTest() {
        Animal loup1 = new Wolf("Name");
        assertEquals(0, enclosureTest.getAnimalsPresent());
        enclosureTest.addAnimal(loup1);
        assertEquals(1, enclosureTest.getAnimalsPresent());
        assertSame(loup1, enclosureTest.getAnimals().get(0));
        enclosureTest.addAnimal(loup1);
        assertEquals(1, enclosureTest.getAnimalsPresent());
        enclosureTest.removeAnimal(loup1);
        assertEquals(0, enclosureTest.getAnimalsPresent());
        Animal loup2 = new Wolf("Name");
        enclosureTest.addAnimal(loup1);
        assertThrows(IllegalArgumentException.class, () -> enclosureTest.addAnimal(loup2));
    }

    @Test
    void feedAnimals() {
        Animal loup = new Wolf("Name");
        loup.setHunger(true);
        enclosureTest.addAnimal(loup);
        enclosureTest.feedAnimals();
        assertFalse(loup.getHunger());
    }

    @Test
    void isCompatible() {
        Animal loup = new Wolf("Name");
        assertTrue(enclosureTest.isCompatible(loup));
        Animal baleine = new Whale("Name");
        assertFalse(enclosureTest.isCompatible(baleine));
    }

    @Test
    void isEmpty() {
        assertTrue(enclosureTest.isEmpty());
        Animal loup = new Wolf("Name");
        enclosureTest.addAnimal(loup);
        assertFalse(enclosureTest.isEmpty());
    }

    @Test
    void maintain() {
        assertEquals("L'enclos n'a pas besoin d'être nettoyé.", enclosureTest.maintain());
        Animal loup = new Wolf("Name");
        enclosureTest.addAnimal(loup);
        assertEquals("L'enclos doit être vide pour pouvoir le nettoyer.", enclosureTest.maintain());
        enclosureTest.setCleanliness(CleanlinessEnclosure.BAD);
        assertEquals("L'enclos doit être vide pour pouvoir le nettoyer.", enclosureTest.maintain());
        enclosureTest.removeAnimal(loup);
        assertEquals("L'enclos à été nettoyé.", enclosureTest.maintain());
    }

    @Test
    void isFull() {
        Animal loup = new Wolf("Name");
        enclosureTest.addAnimal(loup);
        assertTrue(enclosureTest.isFull());
    }

}
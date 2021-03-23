package models.tests;

import models.animal.Animal;
import models.animal.species.Eagle;
import models.animal.species.Whale;
import models.enclosure.Aviarie;
import models.enclosure.enumerations.CleanlinessEnclosure;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.*;

class AviarieTest {

    private static Aviarie aviarieTest;

    @BeforeEach
    void setup() {
        aviarieTest = new Aviarie("Name", 13.4, 3, 17);
    }

    @Test
    void CleanlinessRoof() {
        assertSame(CleanlinessEnclosure.GOOD, aviarieTest.getCleanlinessRoof());
        aviarieTest.setCleanlinessRoof(CleanlinessEnclosure.CORRECT);
        assertSame(CleanlinessEnclosure.CORRECT, aviarieTest.getCleanlinessRoof());
    }

    @Test
    void isCompatible() {
        Animal aigle = new Eagle("Name");
        assertTrue(aviarieTest.isCompatible(aigle));
        Animal baleine = new Whale("Name");
        assertFalse(aviarieTest.isCompatible(baleine));
    }

}
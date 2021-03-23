package models.tests;

import models.animal.Animal;
import models.animal.species.Eagle;
import models.animal.species.Whale;
import models.enclosure.Aquarium;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.*;

class AquariumTest {

    public static Aquarium aquariumTest;

    @BeforeEach
    void setup() {
        aquariumTest = new Aquarium("Name", 24.2, 3, 12);
    }

    @Test
    void salinityTest() {
        assertEquals(1.0, aquariumTest.getSalinity());
        aquariumTest.setSalinity(0.4);
        assertEquals(0.4, aquariumTest.getSalinity());
    }

    @Test
    void isCompatible() {
        Animal baleine = new Whale("Name");
        assertTrue(aquariumTest.isCompatible(baleine));
        Animal aigle = new Eagle("Name");
        assertFalse(aquariumTest.isCompatible(aigle));
    }

}
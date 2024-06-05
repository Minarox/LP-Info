package models.tests;

import models.animal.Animal;
import models.animal.species.Wolf;
import models.employee.Employee;
import models.employee.enumerations.SexEmployee;
import models.enclosure.Enclosure;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import models.zoo.Zoo;

import static org.junit.jupiter.api.Assertions.*;

class ZooTest {

    private static Zoo zooTest;
    private static Employee employeeTest;
    private static Enclosure enclosureTest;

    @BeforeEach
    void setup() {
        employeeTest = new Employee("Name", SexEmployee.MAN, 32);
        enclosureTest = new Enclosure("Name", 14.7, 2);
        zooTest = new Zoo("Name", employeeTest, 3);
        zooTest.addEnclosure(enclosureTest);
    }

    @Test
    void enclosureTest() {
        assertEquals(1, zooTest.getAllEnclosures().size());
        assertThrows(IllegalArgumentException.class, () -> zooTest.addEnclosure(null));
        assertThrows(IllegalArgumentException.class, () -> zooTest.addEnclosure(enclosureTest));
        Animal loup = new Wolf("Name");
        enclosureTest.addAnimal(loup);
        assertThrows(IllegalArgumentException.class, () -> zooTest.removeEnclosure(null));
        assertThrows(IllegalArgumentException.class, () -> zooTest.removeEnclosure(enclosureTest));
        enclosureTest.removeAnimal(loup);
        zooTest.removeEnclosure(enclosureTest);
        assertEquals(0, zooTest.getAllEnclosures().size());
    }

    @Test
    void numberAnimalsZoo() {
        Animal loup = new Wolf("Name");
        enclosureTest.addAnimal(loup);
        assertEquals(1, zooTest.numberAnimalsZoo());
        enclosureTest.removeAnimal(loup);
        assertEquals(0, zooTest.numberAnimalsZoo());
    }

    /*@Test
    void animalsEnclosure() {
    }*/
}
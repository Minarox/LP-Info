package models.tests;

import models.animal.Animal;
import models.animal.species.Wolf;
import models.employee.Employee;
import models.employee.enumerations.SexEmployee;
import models.enclosure.Aquarium;
import models.enclosure.Enclosure;
import models.enclosure.enumerations.CleanlinessEnclosure;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import static org.junit.jupiter.api.Assertions.*;

class EmployeeTest {

    private static Employee employeeTest;

    @BeforeEach
    void setup() {
        employeeTest = new Employee("Name", SexEmployee.MAN, 31);
    }

    @Test
    void examineEnclosure() {
        Enclosure enclosure = new Enclosure("Name", 17.3 ,2);
        assertEquals("L'enclos est propre.", employeeTest.examineEnclosure(enclosure));
        enclosure.setCleanliness(CleanlinessEnclosure.CORRECT);
        assertEquals("La propreté de l'enclos est correcte.", employeeTest.examineEnclosure(enclosure));
        enclosure.setCleanliness(CleanlinessEnclosure.BAD);
        assertEquals("L'enclos est sale et doit être lavé.", employeeTest.examineEnclosure(enclosure));

    }

    @Test
    void cleanEnclosure() {
        Enclosure enclosure = new Enclosure("Name", 17.3 ,2);

        assertEquals("L'enclos n'a pas besoin d'être nettoyé.", employeeTest.cleanEnclosure(enclosure));
        Animal loup = new Wolf("Name");
        enclosure.addAnimal(loup);
        assertEquals("L'enclos doit être vide pour pouvoir le nettoyer.", employeeTest.cleanEnclosure(enclosure));
        enclosure.setCleanliness(CleanlinessEnclosure.BAD);
        assertEquals("L'enclos doit être vide pour pouvoir le nettoyer.", employeeTest.cleanEnclosure(enclosure));
        enclosure.removeAnimal(loup);
        assertEquals("L'enclos à été nettoyé.", employeeTest.cleanEnclosure(enclosure));

    }

    @Test
    void feedAnimalsEnclosure() {
        Enclosure enclosure = new Enclosure("Name", 17.3 ,2);
        Animal loup = new Wolf("Name");
        loup.setHunger(true);
        enclosure.addAnimal(loup);
        employeeTest.feedAnimalsEnclosure(enclosure);
        assertFalse(loup.getHunger());
    }

    @Test
    void transferAnimals() {
        Enclosure enclosure1 = new Enclosure("Name", 17.3 ,2);
        Enclosure enclosure2 = new Enclosure("Name", 12.8 ,1);
        Enclosure enclosure3 = new Aquarium("Name", 12.8 ,1, 12);
        Animal loup1 = new Wolf("Name");
        Animal loup2 = new Wolf("Name");
        enclosure1.addAnimal(loup1);
        enclosure1.addAnimal(loup2);
        assertEquals("L'animal à été transféré dans l'enclos Name.", employeeTest.transferAnimals(enclosure1, enclosure2, loup1));
        assertEquals("L'animal ne peut pas être transféré dans le même enclos.", employeeTest.transferAnimals(enclosure2, enclosure2, loup1));
        assertEquals("L'animal ne peut pas être transféré car l'enclos d'arrivée n'est pas adapté.", employeeTest.transferAnimals(enclosure2, enclosure3, loup1));
        assertEquals("L'animal ne peut pas être transféré car les enclos d'arrivée est plein.", employeeTest.transferAnimals(enclosure1, enclosure2, loup2));
    }

}
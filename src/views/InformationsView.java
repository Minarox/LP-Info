package views;

import models.employee.Employee;
import models.enclosure.Enclosure;
import models.zoo.Zoo;

import java.util.List;

public class InformationsView {

    public InformationsView() {}

    public void menu() {
        System.out.println("\nMenu d'informations du Zoo :\n" +
                "1 - Liste des enclos\n" +
                "2 - Nombre d'animaux dans le Zoo\n" +
                "3 - Animaux par enclos\n" +
                "4 - Informations du Zoo\n" +
                "5 - Informations de l'employé\n" +
                "6 - Retour");
    }

    public void listEnclosures(List<String> enclosures) {
        System.out.println("Liste des enclos du Zoo :\n" +
                enclosures);
    }

    public void numberAnimal(int number) {
        System.out.println("Nombre d'animaux présent dans les cages :\n" +
                number);
    }

    public void animalsByEnclosures(String sortedMisOfThings) {
        System.out.println("Enclos et leurs animaux triés par nom :\n" +
                sortedMisOfThings);
    }

    public void informationsZoo(String zoo) {
        System.out.println("Informations du zoo :\n" +
                zoo);
    }

    public void informationsEmployee(String employee) {
        System.out.println("Informations de l'employé :\n" +
                employee);
    }

}

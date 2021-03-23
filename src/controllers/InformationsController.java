package controllers;

import models.animal.Animal;
import models.employee.Employee;
import models.enclosure.Enclosure;
import models.zoo.Zoo;
import views.InformationsView;

import java.util.*;
import java.util.stream.Collectors;

public class InformationsController {

    private static final MasterController masterController = new MasterController();
    private static final InformationsView informationsView = new InformationsView();
    private static final Scanner scanner = new Scanner(System.in);
    private static Zoo zoo;

    public InformationsController(Zoo zoo) {
        InformationsController.zoo = zoo;
    }

    public void menu() {
        informationsView.menu();
        int selected = scanner.nextInt();
        switch (selected) {
            case 1:
                listEnclosures();
                break;
            case 2:
                numberAnimalZoo();
                break;
            case 3:
                animalsByEnclosures();
                break;
            case 4:
                informationsZoo();
                break;
            case 5:
                informationsEmployee();
                break;
            case 6:
                masterController.menu();
                break;
            default:
                throw new IllegalArgumentException("Sélection en dehors du menu.");
        }
    }

    public void listEnclosures() {
        List<Enclosure> enclosures = zoo.getAllEnclosures();
        informationsView.listEnclosures(enclosures.stream().map(Enclosure::toString).collect(Collectors.toList()));
    }

    public void numberAnimalZoo() {
        int number = zoo.numberAnimalsZoo();
        informationsView.numberAnimal(number);
    }

    public void animalsByEnclosures() {
        SortedSet<Enclosure> enclosuresByName = new TreeSet<>(zoo.getAllEnclosures());
        StringBuilder sortedOutput = new StringBuilder();
        for (Enclosure enclosure : enclosuresByName) {
            sortedOutput.append(enclosure.getName()).append(":\n");
            SortedSet<Animal> animals = new TreeSet<>(enclosure.getAnimals());
            for (Animal animal : animals) {
                sortedOutput.append("\t").append(animal.toString()).append("\n");
            }
        }
        informationsView.animalsByEnclosures(sortedOutput.toString());
    }

    public void informationsZoo() {
        informationsView.informationsZoo(zoo.toString());
    }

    public void informationsEmployee() {
        Employee employee = MasterController.getEmployee();
        informationsView.informationsEmployee(employee.toString());
    }
}

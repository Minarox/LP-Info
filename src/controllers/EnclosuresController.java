package controllers;

import models.animal.Animal;
import models.animal.AnimalRegistry;
import models.animal.species.*;
import models.employee.Employee;
import models.enclosure.Aquarium;
import models.enclosure.Aviarie;
import models.enclosure.Enclosure;
import models.zoo.Zoo;
import views.AnimalsView;
import views.EnclosureView;

import java.util.List;
import java.util.Scanner;
import java.util.stream.Collectors;

public class EnclosuresController {

    private static final MasterController masterController = new MasterController();
    private static final EnclosureView enclosureView = new EnclosureView();
    private static final AnimalsView animalsView = new AnimalsView();
    private static final Scanner scanner = new Scanner(System.in);
    private static Zoo zoo;
    private static final Employee employee = MasterController.getEmployee();
    private static Enclosure enclosure;

    public EnclosuresController(Zoo zoo) {
        EnclosuresController.zoo = zoo;
    }

    public void menu() {
        enclosureView.menu();
        int selected = scanner.nextInt();
        switch (selected) {
            case 1:
                menuCreateEnclosure();
                break;
            case 2:
                menuExamineEnclosure();
                break;
            case 3:
                menuAddAnimal();
                break;
            case 4:
                menuRemoveAnimal();
                break;
            case 5:
                menuTransfertAnimal();
                break;
            case 6:
                menuCleanEnclosure();
                break;
            case 7:
                menuFeedAnimals();
                break;
            case 8:
                menuInformationsEnclosure();
                break;
            case 9:
                masterController.menu();
                break;
            default:
                throw new IllegalArgumentException("Sélection en dehors du menu.");
        }
    }

    public void menuCreateEnclosure() {
        enclosureView.menuCreateEnclosure();
        int selected = scanner.nextInt();
        enclosureView.getNameEnclosure();
        String nameEnclosure = scanner.next();
        enclosureView.getAreaEnclosure();
        double areaEnclosure = scanner.nextDouble();
        enclosureView.getMaxAnimalsEnclosure();
        int maxAnimalsEnclosure = scanner.nextInt();
        switch (selected) {
            case 1:
                enclosure = new Enclosure(nameEnclosure, areaEnclosure, maxAnimalsEnclosure);
                zoo.addEnclosure(enclosure);
                break;
            case 2:
                enclosureView.getHeightAviaries();
                int heightAviarie = scanner.nextInt();
                enclosure = new Aviarie(nameEnclosure, areaEnclosure, maxAnimalsEnclosure, heightAviarie);
                zoo.addEnclosure(enclosure);
                break;
            case 3:
                enclosureView.getDeepnessAquarium();
                int deepnessAquarium = scanner.nextInt();
                enclosure = new Aquarium(nameEnclosure, areaEnclosure, maxAnimalsEnclosure, deepnessAquarium);
                zoo.addEnclosure(enclosure);
                break;
            default:
                throw new IllegalArgumentException("Sélection en dehors du menu.");
        }
        enclosureView.successCreate();
    }

    public void menuExamineEnclosure() {
        if (zoo.getAllEnclosures().isEmpty()) {
            enclosureView.errorNumberEnclosure();
            return;
        }
        enclosure = selectEnclosure();
        String state = employee.examineEnclosure(enclosure);
        enclosureView.examineEnclosure(state);
    }

    public void menuInformationsEnclosure() {
        if (zoo.getAllEnclosures().isEmpty()) {
            enclosureView.errorNumberEnclosure();
            return;
        }
        enclosure = selectEnclosure();
        enclosureView.informationsEnclosure(enclosure.toString());
    }

    public Enclosure selectEnclosure() {
        enclosureView.getTypeEnclosure();
        int selected = scanner.nextInt();

        Class<? extends Enclosure> selectedType = null;
        switch (selected) {
            case 1:
                selectedType = Enclosure.class;
                break;
            case 2:
                selectedType = Aviarie.class;
                break;
            case 3:
                selectedType = Aquarium.class;
                break;
        }

        selected = -1;
        List<? extends Enclosure> enclosures = zoo.getEnclosuresByType(selectedType);
        List<String> names = enclosures.stream().map(Enclosure::getName).collect(Collectors.toList());
        while (selected < 0 || selected >= enclosures.size()) {
            enclosureView.getEnclosure(names);
            selected = scanner.nextInt() - 1;
        }

        return enclosure = enclosures.get(selected);

    }

    public void menuTransfertAnimal() {
        Animal targetAnimal = selectAnimal();

        enclosure = this.selectEnclosure();
        while(!enclosure.isCompatible(targetAnimal)) {
            enclosure = this.selectEnclosure();
        }

        Enclosure fromEnclosure = zoo.getEnclosureOf(targetAnimal);
        if(fromEnclosure != null)
            fromEnclosure.removeAnimal(targetAnimal);
        enclosure.addAnimal(targetAnimal);

    }

    public void menuCleanEnclosure() {
        if (zoo.getAllEnclosures().isEmpty()) {
            enclosureView.errorNumberEnclosure();
            return;
        }
        enclosure = this.selectEnclosure();
        employee.cleanEnclosure(enclosure);
        String state = employee.cleanEnclosure(enclosure);
        enclosureView.examineEnclosure(state);
    }

    public void menuFeedAnimals() {
        if (zoo.getAllEnclosures().isEmpty()) {
            enclosureView.errorNumberEnclosure();
            return;
        }

        enclosure = this.selectEnclosure();
        employee.feedAnimalsEnclosure(enclosure);
        enclosureView.successFeed();
    }

    public void menuAddAnimal() {
        Animal targetAnimal = selectAnimal();
        enclosure = this.selectEnclosure();
        enclosure.addAnimal(targetAnimal);
        enclosureView.succesAddAnimal();
    }

    public void menuRemoveAnimal() {
        Animal targetAnimal = selectAnimal();
        enclosure = this.selectEnclosure();
        enclosure.removeAnimal(targetAnimal);
        enclosureView.succesRemoveAnimal();
    }

    private Animal selectAnimal() {
        if (zoo.getAllEnclosures().isEmpty()) {
            enclosureView.errorNumberEnclosure();
            return null;
        }
        animalsView.getTypeAnimal();
        int selected = scanner.nextInt();
        Class<? extends Animal> clazz = null;
        switch (selected) {
            case 1:
                clazz = Bear.class;
                break;
            case 2:
                clazz = Eagle.class;
                break;
            case 3:
                clazz = Goldfish.class;
                break;
            case 4:
                clazz = Penguin.class;
                break;
            case 5:
                clazz = Shark.class;
                break;
            case 6:
                clazz = Tiger.class;
                break;
            case 7:
                clazz = Whale.class;
                break;
            case 8:
                clazz = Wolf.class;
                break;
            default:
                throw new IllegalArgumentException("Sélection en dehors du menu.");
        }
        List<Animal> animalsOfSelectedType = AnimalRegistry.getRegisteredAnimalsByClass(clazz);
        List<String> animalsOfSelectedTypeStr = animalsOfSelectedType.stream()
                .map(Animal::getName)
                .collect(Collectors.toList());
        animalsView.displayAnimalList(animalsOfSelectedTypeStr);
        String animalSelected = "";
        while(!animalsOfSelectedTypeStr.contains(animalSelected)) {
            animalsView.getAnimal();
            animalSelected = scanner.next();
        }
        String finalAnimalSelected = animalSelected;
        return animalsOfSelectedType.stream()
                .filter(animal1 -> animal1.getName().equals(finalAnimalSelected))
                .findAny().orElseThrow();
    }
}

package controllers;

import models.animal.Animal;
import models.animal.AnimalRegistry;
import models.animal.species.*;
import models.employee.Employee;
import models.zoo.Zoo;
import views.AnimalsView;

import java.util.List;
import java.util.Scanner;
import java.util.stream.Collectors;

public class AnimalsController {

    private static final MasterController masterController = new MasterController();
    private static final AnimalsView animalsView = new AnimalsView();
    private static final Scanner scanner = new Scanner(System.in);
    private static final Employee employee = MasterController.getEmployee();
    private static Animal animal;
    private static Zoo zoo;

    public AnimalsController(Zoo zoo) {
        AnimalsController.zoo = zoo;
    }

    public void menu() {
        animalsView.menu();
        int selected = scanner.nextInt();
        switch (selected) {
            case 1:
                menuCreateAnimal();
                break;
            case 2:
                menuHealAnimal();
                break;
            case 3:
                menuFeedAnimal();
                break;
            case 4:
                menuInformationsAnimal();
                break;
            case 5:
                masterController.menu();
                break;
            default:
                throw new IllegalArgumentException("Sélection en dehors du menu.");
        }
    }

    public void menuCreateAnimal() {
        animalsView.menuCreateAnimal();
        int selected = scanner.nextInt();
        animalsView.getNameAnimal();
        String nameAnimal = scanner.next();
        switch (selected) {
            case 1:
                animal = new Bear(nameAnimal);
                break;
            case 2:
                animal = new Eagle(nameAnimal);
                break;
            case 3:
                animal = new Goldfish(nameAnimal);
                break;
            case 4:
                animal = new Penguin(nameAnimal);
                break;
            case 5:
                animal = new Shark(nameAnimal);
                break;
            case 6:
                animal = new Tiger(nameAnimal);
                break;
            case 7:
                animal = new Whale(nameAnimal);
                break;
            case 8:
                animal = new Wolf(nameAnimal);
                break;
            default:
                throw new IllegalArgumentException("Sélection en dehors du menu.");
        }
        animalsView.successCreate();
    }

    public void menuInformationsAnimal() {
        if (zoo.numberAnimalsZoo() == 0) {
            animalsView.errorNumberAnimal();
            return;
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
        Animal targetAnimal = animalsOfSelectedType.stream()
                .filter(animal1 -> animal1.getName().equals(finalAnimalSelected))
                .findAny().orElseThrow();
        animalsView.informationsAnimal(targetAnimal.toString());
    }

    public void menuFeedAnimal() {
        if (zoo.numberAnimalsZoo() == 0) {
            animalsView.errorNumberAnimal();
            return;
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
        Animal targetAnimal = animalsOfSelectedType.stream()
                .filter(animal1 -> animal1.getName().equals(finalAnimalSelected))
                .findAny().orElseThrow();
        if (targetAnimal.feed()) {
            animalsView.feedAnimal();
        } else {
            animalsView.errorFeedAnimal();
        }
    }

    public void menuHealAnimal() {
        if (zoo.numberAnimalsZoo() == 0) {
            animalsView.errorNumberAnimal();
            return;
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
        Animal targetAnimal = animalsOfSelectedType.stream()
                .filter(animal1 -> animal1.getName().equals(finalAnimalSelected))
                .findAny().orElseThrow();
        targetAnimal.heal();
        animalsView.healAnimal();
    }
}

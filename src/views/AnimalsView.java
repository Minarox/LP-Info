package views;

import models.animal.Animal;

import java.util.List;

public class AnimalsView {

    public AnimalsView() {}

    public void menu() {
        System.out.println("\nMenu de gestion des animaux :\n" +
                "1 - Créer un nouvel animal\n" +
                "2 - Soigner un animal\n" +
                "3 - Nourrir un animal\n" +
                "4 - Consulter les informations d'un animal\n" +
                "5 - Retour");
    }

    public void menuCreateAnimal() {
        System.out.println("Création d'un nouvel animal.\n" +
                "Quel type d'animal voulez vous ajouter au Zoo ?\n" +
                "1 - Un Ours\n" +
                "2 - Un Aigle\n" +
                "3 - Un Poisson rouge\n" +
                "4 - Un Pingouin\n" +
                "5 - Un Requin\n" +
                "6 - Un Tigre\n" +
                "7 - Une Baleine\n" +
                "8 - Un Loup");
    }

    public void getNameAnimal() {
        System.out.println("Quel nom voulez vous donner à l'animal ?");
    }

    public void successCreate() {
        System.out.println("L'animal a été correctement créé.");
    }

    public void getTypeAnimal() {
        System.out.println("Quel type d'animal voulez vous sélectionner ?\n" +
                "1 - Un Ours\n" +
                "2 - Un Aigle\n" +
                "3 - Un Poisson rouge\n" +
                "4 - Un Pingouin\n" +
                "5 - Un Requin\n" +
                "6 - Un Tigre\n" +
                "7 - Une Baleine\n" +
                "8 - Un Loup");
    }

    public void getAnimal() {
        System.out.println("Quel animal voulez vous sélectionner ?");
    }

    public void informationsAnimal(String animal) {
        System.out.println("Informations de l'animal :\n" +
                animal);
    }

    public void feedAnimal() {
        System.out.println("L'animal à été nourrit.");
    }

    public void errorFeedAnimal() {
        System.out.println("L'animal n'a pas été nourrit car celui-ci dors.");
    }

    public void healAnimal() {
        System.out.println("L'animal à été soigné");
    }

    public void errorNumberAnimal() {
        System.out.println("\nIl n'y a pas d'enclos contenant des animaux dans le Zoo.");
    }

    public void displayAnimalList(List<String> list) {
        System.out.println("Voici la liste des animaux : ");
        list.forEach(System.out::println);
    }
}

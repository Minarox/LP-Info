package views;

import models.enclosure.Enclosure;

import java.util.List;

public class EnclosureView {

    public EnclosureView() {}

    public void menu() {
        System.out.println("\nMenu de gestion des enclos :\n" +
                "1 - Créer un nouvel enclos\n" +
                "2 - Examiner un enclos\n" +
                "3 - Ajouter un animal à un enclos\n" +
                "4 - Supprimer un animal d'un enclos\n" +
                "5 - Transférer les animaux d'un enclos à un autre\n" +
                "6 - Nettoyer un enclos\n" +
                "7 - Nourrir les animaux d'un enclos\n" +
                "8 - Consulter les informations d'un enclos\n" +
                "9 - Retour");
    }

    public void menuCreateEnclosure() {
        System.out.println("Création d'un nouvel enclos.\n" +
                "Quel type d'enclos voulez vous ajouter au Zoo ?\n" +
                "1 - Un enclos normal\n" +
                "2 - Une volière\n" +
                "3 - Un aquarium");
    }

    public void getNameEnclosure() {
        System.out.println("Quel nom voulez vous donner à l'enclos ?");
    }

    public void getAreaEnclosure() {
        System.out.println("Quel est la superficie de l'enclos ?");
    }

    public void getMaxAnimalsEnclosure() {
        System.out.println("Quel est le nombre maximal d'animaux pouvant être mit dans l'enclos ?");
    }

    public void getHeightAviaries() {
        System.out.println("Quel est la hauteur de la volière ?");
    }

    public void getDeepnessAquarium() {
        System.out.println("Quel est la profondeur de l'aquarium ?");
    }

    public void successCreate() {
        System.out.println("L'enclos a été correctement créé.");
    }

    public void getTypeEnclosure() {
        System.out.println("Quel est le type de l'enclos ?\n" +
                "1 - Enclos normal\n" +
                "2 - Volière\n" +
                "3 - Aquarium");
    }

    public void getEnclosure(List<String> enclosureNames) {
        System.out.println("Quel enclos voulez vous sélectionner ?");
        for (int i = 0; i < enclosureNames.size(); i++) {
            System.out.println((i+1) + " - " + enclosureNames.get(i));
        }
    }

    public void errorNumberEnclosure() {
        System.out.println("Il n'y a pas d'enclos dans le Zoo.");
    }

    public void examineEnclosure(String state) {
        System.out.println(state);
    }

    public void informationsEnclosure(String enclosure) {
        System.out.println("Informations de l'enclos :\n" +
                enclosure);
    }

    public void successFeed() {
        System.out.println("Les animaux de l'enclos ont été nourrit.");
    }

    public void succesAddAnimal() {
        System.out.println("L'animal à été correctement ajouté à l'enclos.");
    }

    public void succesRemoveAnimal() {
        System.out.println("L'animal à été correctement ajouté à l'enclos.");
    }
}

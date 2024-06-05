/*
Consignes globales :
  - Doit pouvoir contenir plusieurs animaux
  - Animaux du même type, pas de mélange d'espèces

Caractéristiques d'un enclos :
  - Un nom
  - Une superficie
  - Le nombre maximum d'animaux qu'il peut contenir
  - Le nombre d'animaux présents
  - Les animaux présents
  - Un degré de propreté (au moins : "Mauvais", "Correct" et "Bon")

Fonctions d'un enclos :
  - Afficher ses caractéristiques ainsi que les caractéristiques des animaux qu'il contient
  - Ajouter et enlever des animaux
  - Nourrir les animaux qu'il contient
  - Donner la possibilité d'être entretenu lorsqu'il est sale et vide
*/

package models.enclosure;

import models.animal.Animal;
import models.animal.interfaces.Walk;
import models.enclosure.enumerations.CleanlinessEnclosure;
import models.helpers.RandomPicker;
import models.helpers.TemporalReactor;

import java.util.ArrayList;
import java.util.Collections;
import java.util.List;

public class Enclosure extends TemporalReactor implements Comparable<Enclosure> {

    private String name;
    private double area;
    private int maxAnimals;
    private List<Animal> animals;
    private CleanlinessEnclosure cleanliness;

    /**
     * Constructeur d'enclos
     * @param name
     * @param area
     * @param maxAnimals
     */
    public Enclosure(String name, double area, int maxAnimals) {
        if (name == null || name.isBlank()) {
            throw new IllegalArgumentException("Le nom de l'enclos ne peut pas être vide.");
        }
        if (area <= 0d) {
            throw new IllegalArgumentException("La superficie de l'enclos doit être supérieur à zéro.");
        }
        if (maxAnimals <= 0d) {
            throw new IllegalArgumentException("Le nombre d'animaux dans l'enclos doit être supérieur à zéro.");
        }
        this.name = name;
        this.area = area;
        this.maxAnimals = maxAnimals;
        this.cleanliness = CleanlinessEnclosure.GOOD;
        this.animals = new ArrayList<>();
    }

    /**
     * Renvoie le nom de l'enclos
     * @return String
     */
    public String getName() {
        return name;
    }

    /**
     * Renvoie les animaux de l'enclos
     * @return List
     */
    public List<Animal> getAnimals() {
        return Collections.unmodifiableList(animals);
    }

    /**
     * Renvoie les animaux de l'enclos
     * @return int
     */
    public int getAnimalsPresent() {
        return animals.size();
    }

    /**
     * Renvoie l'état de propreté de l'enclos
     * @return propreté
     */
    public CleanlinessEnclosure getCleanliness() {
        return cleanliness;
    }

    /**
     * Permet de modifier l'état de propreté de l'enclos
     * @param cleanliness
     */
    public void setCleanliness(CleanlinessEnclosure cleanliness) {
        this.cleanliness = cleanliness;
    }

    /**
     * Permet d'ajouter un animal à l'enclos
     * @param animal
     */
    public void addAnimal(Animal animal) {
        if(animal == null) {
            throw new IllegalArgumentException("L'animal ne peut pas être null.");
        }
        if(animals.contains(animal)) {
            return;
        }
        if(getAnimalsPresent() < maxAnimals) {
            animals.add(animal);
        } else {
            throw new IllegalArgumentException("L'enclos est plein.");
        }
    }

    /**
     * Permet de supprimer un animal de l'enclos
     * @param animal
     */
    public void removeAnimal(Animal animal) {
        if(animal == null) {
            throw new IllegalArgumentException("L'animal ne peut pas être null.");
        }
        animals.remove(animal);
    }

    /**
     * Permet de nourrir tous les animaux de l'enclos
     */
    public void feedAnimals() {
        animals.forEach(Animal::feed);
    }

    /**
     * Permet de savoir si un animal est compatible avec l'enclos
     * @param animal
     * @return true s'il est compatible, false sinon
     */
    public boolean isCompatible(Animal animal) {
        if(animal == null) {
            throw new IllegalArgumentException("L'animal ne peut pas être null.");
        }
        return animal instanceof Walk;
    }

    /**
     * Renvoie l'état de remplissage de l'enclos
     * @return true si c'est vide, false sinon
     */
    public boolean isEmpty() {
        return getAnimalsPresent() == 0;
    }

    /**
     * Permet de maintenir l'enclos
     * @return String
     */
    public String maintain() {
        boolean empty = isEmpty();
        if (empty && getCleanliness() == CleanlinessEnclosure.BAD) {
            setCleanliness(CleanlinessEnclosure.GOOD);
            return "L'enclos à été nettoyé.";
        } else if(!empty) {
            return "L'enclos doit être vide pour pouvoir le nettoyer.";
        } else {
            return "L'enclos n'a pas besoin d'être nettoyé.";
        }
    }

    /**
     * Renvoie l'état de remplissage de l'enclos
     * @return true si c'est plein, false sinon
     */
    public boolean isFull() {
        return getAnimalsPresent() >= maxAnimals;
    }

    /**
     * Changement de l'affichage de l'enclos
      * @return
     */
    @Override
    public String toString() {
        return "Enclosure {" +
                "name = " + this.name +
                ", area = " + this.area +
                ", animalsPresent = " + this.getAnimalsPresent() +
                ", maxAnimals = " + this.maxAnimals +
                ", animals = " + this.animals +
                "}";
    }

    /**
     * Permet de modifier aléatoire les valeurs de l'aquarium
     */
    @Override
    public void tick() {
        if (RandomPicker.randomInt() < 20) {
            setCleanliness(RandomPicker.randomEnum(CleanlinessEnclosure.class));
        }
    }

    /**
     * Compare cet enclos à un autre enclos
     * La comparaison s'effectue sur un nom
     * @param o
     * @return
     */
    @Override
    public int compareTo(Enclosure o) {
        return String.CASE_INSENSITIVE_ORDER.compare(name, o.getName());
    }
}

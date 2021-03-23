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

Spécificités d'un aquarium :
  - Ne peut contenir que des animaux aquatiques
  - Doit comprendre la hauteur du bassin ainsi que la salinité de l'eau
  - Son entretien nécessite la vérification de ces 2 caractéristiques supplémentaires
*/

package models.enclosure;

import models.animal.Animal;
import models.animal.interfaces.Swim;
import models.helpers.RandomPicker;

public class Aquarium extends Enclosure {

    private final int deepness;
    private double salinity;

    /**
     * Constructeur d'aquarium
     * @param name
     * @param area
     * @param maxAnimals
     * @param deepness
     */
    public Aquarium(String name, double area, int maxAnimals, int deepness) {
        super(name, area, maxAnimals);
        if (deepness <= 0) {
            throw new IllegalArgumentException("La profondeur de l'enclos doit être supérieur à zéro.");
        }
        this.deepness = deepness;
        this.salinity = 1.0;
    }

    /**
     * Renvoie la salinité de l'eau de l'aquarium
     * @return double
     */
    public double getSalinity() {
        return this.salinity;
    }

    /**
     * Modifie la salinité de l'eau
     * @param salinity
     */
    public void setSalinity(double salinity) {
        if (salinity < 0f || salinity > 1f) {
            throw new IllegalArgumentException("La salinité de l'eau doit être comprise entre 0 et 1.");
        }
        this.salinity = salinity;
    }

    /**
     * Renvoie la profondeur de l'aquarium
     * @return int
     */
    public int getDeepness() {
        return deepness;
    }

    /**
     * Permet de maintenir l'aquarium
     * @return String
     */
    @Override
    public String maintain() {
        this.salinity = 1.0;
        return super.maintain();
    }

    /**
     * Permet de savoir si un animal est compatible avec l'enclos
     * @param animal
     * @return true s'il est compatible, false sinon
     */
    @Override
    public boolean isCompatible(Animal animal) {
        if(animal == null) {
            throw new IllegalArgumentException("L'animal ne peut pas être vide.");
        }
        return animal instanceof Swim;
    }

    /**
     * Permet de modifier aléatoire les valeurs de l'aquarium
     */
    @Override
    public void tick() {
        if (RandomPicker.randomInt() < 30) {
            setSalinity(RandomPicker.randomDouble());
        }
    }

}

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

Spécificités d'une volière :
  - Ne peut contenir que des animaux volants
  - Doit comprendre la hauteur
  - Son entretien nécessite la vérification du toit de la cage en plus de l'entretien classique
*/

package models.enclosure;

import models.animal.Animal;
import models.animal.interfaces.Fly;
import models.enclosure.enumerations.CleanlinessEnclosure;
import models.helpers.RandomPicker;

public class Aviarie extends Enclosure {

    private final int height;
    private CleanlinessEnclosure cleanlinessRoof;

    /**
     * Constructeur de volières
     * @param name
     * @param area
     * @param maxAnimals
     * @param height
     */
    public Aviarie(String name, double area, int maxAnimals, int height) {
        super(name, area, maxAnimals);
        if (height <= 0) {
            throw new IllegalArgumentException("La hauteur de l'enclos doit être supérieur à zéro.");
        }
        this.height = height;
        this.cleanlinessRoof = CleanlinessEnclosure.GOOD;
    }

    /**
     * Renvoie l'état de propreté du toit de la volière
     * @return propreté
     */
    public CleanlinessEnclosure getCleanlinessRoof() {
        return cleanlinessRoof;
    }

    /**
     * Change la propreté du toit de la volière
     * @param cleanlinessRoof
     */
    public void setCleanlinessRoof(CleanlinessEnclosure cleanlinessRoof) {
        this.cleanlinessRoof = cleanlinessRoof;
    }

    /**
     * Permet de savoir si un animal est compatible avec l'enclos
     * @param animal
     * @return
     */
    @Override
    public boolean isCompatible(Animal animal) {
        if(animal == null) {
            throw new IllegalArgumentException("L'animal ne peut pas être vide.");
        }
        return animal instanceof Fly;
    }

    /**
     * Permet de modifier aléatoire les valeurs de l'aquarium
     */
    @Override
    public void tick() {
        if (RandomPicker.randomInt() < 20) {
            setCleanlinessRoof(RandomPicker.randomEnum(CleanlinessEnclosure.class));
        }
    }

}

// Classe des Loups

package models.animal.species;

import models.animal.Animal;
import models.animal.interfaces.Mammal;
import models.animal.interfaces.Walk;

public class Wolf extends Animal implements Walk, Mammal {

    /**
     * Constructeur de loups
     * @param name
     */
    public Wolf(String name) {
        super(name);
    }

    /**
     * Espèce de l'animal
     * @return string
     */
    public String getSpecies() {
        return "Wolf";
    }
}

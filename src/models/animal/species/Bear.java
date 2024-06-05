// Classe des Ours

package models.animal.species;

import models.animal.Animal;
import models.animal.interfaces.Mammal;
import models.animal.interfaces.Walk;

public class Bear extends Animal implements Walk, Mammal {

    /**
     * Constructeur d'ours
     * @param name
     */
    public Bear(String name) {
        super(name);
    }

    /**
     * Espèce de l'animal
     * @return string
     */
    public String getSpecies() {
        return "Bear";
    }

}

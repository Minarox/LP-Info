// Classe des Aigles

package models.animal.species;

import models.animal.Animal;
import models.animal.interfaces.Fly;
import models.animal.interfaces.Other;

public class Eagle extends Animal implements Fly, Other {

    /**
     * Constructeur d'aigles
     * @param name
     */
    public Eagle(String name) {
        super(name);
    }

    /**
     * Espèce de l'animal
     * @return string
     */
    public String getSpecies() {
        return "Eagle";
    }
}

// Classe des Requins

package models.animal.species;

import models.animal.Animal;
import models.animal.interfaces.Other;
import models.animal.interfaces.Swim;

public class Shark extends Animal implements Swim, Other {

    /**
     * Constructeur de requins
     * @param name
     */
    public Shark(String name) {
        super(name);
    }

    /**
     * Espèce de l'animal
     * @return string
     */
    public String getSpecies() {
        return "Shark";
    }
}

// Classe des Baleines

package models.animal.species;

import models.animal.Animal;
import models.animal.interfaces.Other;
import models.animal.interfaces.Swim;

public class Whale extends Animal implements Swim, Other {

    /**
     * Constructeur de balaines
     * @param name
     */
    public Whale(String name) {
        super(name);
    }

    /**
     * Espèce de l'animal
     * @return string
     */
    public String getSpecies() {
        return "Whale";
    }
}

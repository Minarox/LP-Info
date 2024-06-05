// Classe des Poissons Rouges

package models.animal.species;

import models.animal.Animal;
import models.animal.interfaces.Other;
import models.animal.interfaces.Swim;

public class Goldfish extends Animal implements Swim, Other {

    /**
     * Constructeur de poissons rouges
     * @param name
     */
    public Goldfish(String name) {
        super(name);
    }

    /**
     * Espèce de l'animal
     * @return string
     */
    public String getSpecies() {
        return "Goldfish";
    }

}

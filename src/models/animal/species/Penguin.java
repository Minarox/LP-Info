// Classe des Pingouins

package models.animal.species;

import models.animal.Animal;
import models.animal.interfaces.Fly;
import models.animal.interfaces.Other;
import models.animal.interfaces.Swim;

public class Penguin extends Animal implements Swim, Fly, Other {

    /**
     * Constructeur de pingouins
     * @param name
     */
    public Penguin(String name) {
        super(name);
    }

    /**
     * Espèce de l'animal
     * @return string
     */
    public String getSpecies() {
        return "Penguin";
    }
}

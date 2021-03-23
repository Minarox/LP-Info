// Classe des Tigres

package models.animal.species;

import models.animal.Animal;
import models.animal.interfaces.Mammal;
import models.animal.interfaces.Walk;

public class Tiger extends Animal implements Walk, Mammal {

    /**
     * Constructeur de tigres
     * @param name
     */
    public Tiger(String name) {
        super(name);
    }

    /**
     * Espèce de l'animal
     * @return string
     */
    public String getSpecies() {
        return "Tiger";
    }
}

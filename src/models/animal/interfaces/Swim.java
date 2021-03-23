/*
Caractéristiques :
  - Les animaux marins doivent pouvoir nager
*/

package models.animal.interfaces;

public interface Swim {

    /**
     * Méthode de déplacement des animaux
     * @return string
     */
    default String toSwim() {
        return "L'animal nage";
    }

}
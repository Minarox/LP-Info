/*
Caractéristiques :
  - Les animaux terrestres doivent pouvoir marcher
*/

package models.animal.interfaces;

public interface Walk {

    /**
     * Méthode de déplacement des animaux
     * @return string
     */
    default String toWalk() {
        return "L'animal marche";
    }

}

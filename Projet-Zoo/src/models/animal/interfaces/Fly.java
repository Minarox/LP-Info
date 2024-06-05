/*
Caractéristiques :
  - Les animaux volants doivent pouvoir voler
*/

package models.animal.interfaces;

public interface Fly {

    /**
     * Méthode de déplacement des animaux
     * @return string
     */
    default String toFly() {
        return "L'animal vole";
    }

}

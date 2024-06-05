/*
Caractéristiques :
  - Doivent pouvoir mettre bas
*/

package models.animal.interfaces;

public interface Mammal {

    /**
     * Méthode d'accouchement des animaux
     * @return string
     */
    default String giveBirth() {
        return "L'animal accouche";
    }

}

/*
Caractéristiques :
  - Doivent pouvoir pondre des œufs
*/

package models.animal.interfaces;

public interface Other {

    /**
     * Méthode d'accouchement des animaux
     * @return string
     */
    default String layEgg() {
        return "L'animal pond";
    }

}

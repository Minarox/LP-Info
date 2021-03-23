/*
Consignes globales :
  - Un seul employé dans le zoo
  - L'utilisateur doit pouvoir diriger l'employé du zoo

Caractéristiques d'un employé :
  - Un nom
  - Un sexe
  - Un âge

Fonctions de l'employé :
  - Examiner un enclos (en affichant les caractéristiques de l'enclos ainsi que la liste des animaux)
  - Nettoyer un enclos
  - Nourrir les animaux d'un enclos
  - Transférer un animal d'un enclos à un autre
*/

package models.employee;

import models.animal.Animal;
import models.employee.enumerations.SexEmployee;
import models.enclosure.Enclosure;
import models.enclosure.enumerations.CleanlinessEnclosure;
import models.helpers.TemporalReactor;

public class Employee {

    private final String name;
    private final SexEmployee sex;
    private final int age;

    /**
     * Constructeur de l'employé(e)
     * @param name
     * @param sex
     * @param age
     */
    public Employee(String name, SexEmployee sex, int age) {
        if (name == null || name.isBlank()) {
            throw new IllegalArgumentException("Le nom de l'employé ne peut pas être vide.");
        }
        if (age <= 0) {
            throw new IllegalArgumentException("L'age de l'employé doit être supérieur à 0.");
        }
        this.name = name;
        this.sex = sex;
        this.age = age;
    }

    /**
     * Permet à l'employé(e) d'examiner un enclos
     * @param enclosure
     * @return String
     */
    public String examineEnclosure(Enclosure enclosure) {
        if (enclosure == null) {
            throw new IllegalArgumentException("L'enclos ne peut pas être null.");
        }
        if (enclosure.getCleanliness() == CleanlinessEnclosure.GOOD) {
            return "L'enclos est propre.";
        } else if (enclosure.getCleanliness() == CleanlinessEnclosure.CORRECT) {
            return "La propreté de l'enclos est correcte.";
        } else {
            return "L'enclos est sale et doit être lavé.";
        }
    }

    /**
     * Permet à l'employé(e) de nettoyer un enclos
     * @param enclosure
     * @return String
     */
    public String cleanEnclosure(Enclosure enclosure) {
        if (enclosure == null) {
            throw new IllegalArgumentException("L'enclos ne peut pas être null.");
        }
        return enclosure.maintain();
    }

    /**
     * Permet à l'employé(e) de nourrir les animaux d'un enclos
     * @param enclosure
     */
    public void feedAnimalsEnclosure(Enclosure enclosure) {
        if (enclosure == null) {
            throw new IllegalArgumentException("L'enclos ne peut pas être null.");
        }
        enclosure.feedAnimals();
    }

    /**
     * Permet de transférer un animal d'un enclos à un autre enclos
     * @param enclosure
     * @param targetEnclosure
     * @param animal
     * @return String
     */
    public String transferAnimals(Enclosure enclosure, Enclosure targetEnclosure, Animal animal) {
        if (enclosure == null) {
            throw new IllegalArgumentException("L'enclos ne peut pas être null.");
        }
        if (targetEnclosure == null) {
            throw new IllegalArgumentException("L'enclos ciblé ne peut pas être null.");
        }
        if(animal == null) {
            throw new IllegalArgumentException("L'animal ne peut pas être null.");
        }
        if (enclosure == targetEnclosure) {
            return "L'animal ne peut pas être transféré dans le même enclos.";
        }
        if (!targetEnclosure.isCompatible(animal)) {
            return "L'animal ne peut pas être transféré car l'enclos d'arrivée n'est pas adapté.";
        } else if(targetEnclosure.isFull()) {
            return "L'animal ne peut pas être transféré car les enclos d'arrivée est plein.";
        }
        enclosure.removeAnimal(animal);
        targetEnclosure.addAnimal(animal);
        return "L'animal à été transféré dans l'enclos " + targetEnclosure.getName() + ".";
    }

    /**
     * Lance la fonction permettant de modifier aléatoirement des valeurs dans le Zoo
     */
    public void action() {
        TemporalReactor.notifyTick();
    }

    /**
     * Changement de l'affichage de l'employé(e)
     * @return String
     */
    @Override
    public String toString() {
        return "Employee {" +
                "name = " + this.name +
                ", sex = " + this.sex +
                ", age = " + this.age +
                "}";
    }
}

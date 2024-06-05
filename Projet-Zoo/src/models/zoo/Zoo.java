/*
Caractéristiques du zoo :
  - Un nom
  - Un employé
  - Un nombre maximal d'enclos
  - Les enclos existants

Fonctions du zoo :
  - Afficher le nombre d'animaux présents dans le zoo
  - Afficher les animaux de tous les enclos
*/

package models.zoo;

import models.animal.Animal;
import models.employee.Employee;
import models.enclosure.Enclosure;
import java.util.ArrayList;
import java.util.List;

public class Zoo {

    private String name;
    private Employee employee;
    private int maxEnclosure;
    private List<Enclosure> enclosures;

    /**
     * Constructeur de Zoo
     * @param name
     * @param employee
     * @param maxEnclosure
     */
    public Zoo(String name, Employee employee, int maxEnclosure) {
        if (name == null || name.isBlank()) {
            throw new IllegalArgumentException("Le nom du Zoo ne peut pas être vide.");
        }
        if (employee == null) {
            throw new IllegalArgumentException("L'employé ne peut pas être null.");
        }
        if (maxEnclosure <= 0d) {
            throw new IllegalArgumentException("Le nombre maximal d'enclos doit être supérieur à zéro.");
        }
        this.name = name;
        this.employee = employee;
        this.maxEnclosure = maxEnclosure;
        this.enclosures = new ArrayList<>();
    }

    /**
     * Ajoute un enclos au Zoo
     * @param enclosure
     */
    public void addEnclosure(Enclosure enclosure) {
        if (enclosure == null) {
            throw new IllegalArgumentException("L'enclos ne peut pas être null.");
        }
        if (this.enclosures.contains(enclosure)) {
            throw new IllegalArgumentException("L'enclos existe déjà.");
        }
        this.enclosures.add(enclosure);
    }

    /**
     * Supprime un enclos du zoo
     * @param enclosure
     */
    public void removeEnclosure(Enclosure enclosure) {
        if (enclosure == null) {
            throw new IllegalArgumentException("L'enclos ne peut pas être null.");
        }
        if (!this.enclosures.contains(enclosure)) {
            throw new IllegalArgumentException("L'enclos n'existe pas.");
        }
        if (!enclosure.isEmpty()) {
            throw new IllegalArgumentException("L'enclos n'est pas vide.");
        }
        this.enclosures.remove(enclosure);
    }

    /**
     * Renvoie la liste de tous les enclos du Zoo
     * @return
     */
    public List<Enclosure> getAllEnclosures() {
        return enclosures;
    }

    /**
     * Renvoie la liste des enclos par type d'enclos
     * @param type
     * @param <T>
     * @return List
     */
    public <T extends Enclosure> List<T> getEnclosuresByType(Class<T> type) {
        List<T> tList = new ArrayList<>();
        for (Enclosure allEnclosure : getAllEnclosures()) {
            if(allEnclosure.getClass().equals(type)) {
                tList.add((T) allEnclosure);
            }
        }
        return tList;
    }

    /**
     * Renvoie le nombre d'animaux présents dans les enclos du Zoo
     * @return int
     */
    public int numberAnimalsZoo() {
        return enclosures.stream().mapToInt(Enclosure::getAnimalsPresent).sum();
    }

    /**
     * Change les paramètres d'affichages du Zoo
     * @return
     */
    @Override
    public String toString() {
        return "Zoo {" +
                    "name = " + this.name +
                    ", employee = " + this.employee +
                    ", maxEnclosure = " + this.maxEnclosure +
                    ", models.enclosure = " + this.enclosures +
                "}";
    }


    /**
     * Renvoie l'enclos ou se situe l'animal
     * @param targetAnimal
     * @return
     */
    public Enclosure getEnclosureOf(Animal targetAnimal) {
        for (Enclosure enclosure : enclosures) {
            if(enclosure.getAnimals().contains(targetAnimal)){
                return enclosure;
            }
        }
        return null;
    }
}

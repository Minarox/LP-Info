/*
Caractéristiques d'un animal :
  - Un nom (d'espèce)
  - Un sexe
  - Un poids
  - Un âge
  - Un indicateur de faim
  - Un indicateur de sommeil (permettant de savoir s'il dort ou non)
  - Un indicateur de santé

Fonctions de l'animal :
  - Manger (lorsqu'il ne dort pas)
  - Émettre un son
  - Être soigné
  - S'endormir ou se réveiller
*/

package models.animal;

import models.animal.enumerations.HealAnimal;
import models.animal.enumerations.SexAnimal;
import models.helpers.RandomPicker;
import models.helpers.TemporalReactor;

public abstract class Animal extends TemporalReactor implements Comparable<Animal> {

    private final String name;
    private final SexAnimal sex;
    private final double weight, size;
    private final int age;
    private boolean hunger, sleep;
    private HealAnimal heal;

    /**
     * Constructeur d'animaux
     * @param name
     */
    public Animal(String name) {
        if (name == null || name.isBlank()) {
            throw new IllegalArgumentException("Le nom de l'animal ne peut pas être vide.");
        }
        this.name = name;
        this.sex = RandomPicker.randomEnum(SexAnimal.class);
        this.weight = RandomPicker.randomDouble();
        this.size = RandomPicker.randomDouble();
        this.age = RandomPicker.randomInt();
        this.hunger = false;
        this.sleep = false;
        this.heal = HealAnimal.GOOD;

        AnimalRegistry.registerAnimal(this);
    }

    /**
     * Renvoie la faim de l'animal
     * @return true s'il a faim, false sinon
     */
    public boolean getHunger() {
        return hunger;
    }

    /**
     * Change la faim de l'animal
     * @param hunger
     */
    public void setHunger(boolean hunger) {
        this.hunger = hunger;
    }

    /**
     * Renvoie l'état de sommeil de l'animal
     * @return true s'il dors, false sinon
     */
    public boolean getSleep() {
        return sleep;
    }

    /**
     * Change l'état de sommeil de l'animal
     * @param sleep
     */
    public void setSleep(boolean sleep) {
        this.sleep = sleep;
    }

    /**
     * Renvoie la santé de l'animal
     * @return la santé de l'animal
     */
    public HealAnimal getHeal() {
        return heal;
    }

    /**
     * Modifie la santé de l'animal
     * @param heal
     */
    public void setHeal(HealAnimal heal) {
        this.heal = heal;
    }

    /**
     * Permet de nourrir l'animal s'il ne dors pas
     * @return true si l'animal est nourrit, false sinon
     */
    public boolean feed() {
        if (!this.sleep) {
            this.hunger = false;
            return true;
        }
        return false;
    }

    /**
     * Cri de l'animal
     * @return string
     */
    public String sound() {
        return this.name + " pousse un cri.";
    }

    /**
     * Permet de soigner l'animal
     */
    public void heal() {
        this.heal = HealAnimal.GOOD;
    }

    /**
     * Change l'état de sommeil de l'animal
     */
    public void toggleSleep() {
        this.sleep = !this.sleep;
    }

    /**
     * Renvoie l'espèce de l'animal
     * @return String
     */
    public abstract String getSpecies();

    /**
     * Change les paramètres d'affichages de la classe Animal
     * @return string
     */
    @Override
    public String toString() {
        return "Animal {" +
                    "species = " + this.getSpecies() +
                    ", name = "+ this.name +
                    ", sex = " + this.sex +
                    ", weight = " + this.weight +
                    ", size = " + this.size +
                    ", age = " + this.age +
                    ", heal = " + this.heal +
                    ", hunger = " + this.hunger +
                    ", sleep = " + this.sleep +
                "}";
    }

    /**
     * Modifie aléatoirement l'état de l'animal lorsque l'utilisateur à effectué 5 actions
     */
    @Override
    public void tick() {
        if (RandomPicker.randomInt() < 20) {
            setHeal(RandomPicker.randomEnum(HealAnimal.class));
        }
        if (RandomPicker.randomInt() < 25) {
            setHunger(true);
        }
        if (RandomPicker.randomInt() < 30) {
            toggleSleep();
        }
        if (RandomPicker.randomInt() < 40) {
            sound();
        }
    }

    /**
     * Renvoie le nom de l'animal
     * @return String
     */
    public String getName() {
        return this.name;
    }

    /**
     * Compare cet animal à un autre animal
     * La comparaison s'effectue sur un nom
     * @param o
     * @return int
     */
    @Override
    public int compareTo(Animal o) {
        return String.CASE_INSENSITIVE_ORDER.compare(name, o.getName());
    }


}

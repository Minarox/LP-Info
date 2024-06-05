package models.helpers;

import java.util.Random;

public class RandomPicker {

    private static final Random r = new Random();

    /**
     * Permet de sélectionner aléatoirement une constante d'une énumération
     * @param c
     * @param <T>
     * @return constante aléatoire de l'énumération
     */
    public static <T extends Enum<?>> T randomEnum(Class<T> c) {
        int x = r.nextInt(c.getEnumConstants().length);
        return c.getEnumConstants()[x];
    }

    /**
     * Renvoie un entier aléatoire entre 0 et 100
     * @return entier aléatoire
     */
    public static int randomInt() {
        int x = r.nextInt(100);
        return x;
    }

    /**
     * Renvoie un double aléatoire entre 0 et 100 arrondie au 10ème près
     * @return double aléatoire
     */
    public static double randomDouble() {
        double x = r.nextFloat() * 100;
        return x - (x % 0.1);
    }

}

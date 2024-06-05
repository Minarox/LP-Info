package models.helpers;

import java.util.ArrayList;
import java.util.List;

public abstract class TemporalReactor {

    private static final List<TemporalReactor> TEMPORAL_REACTORS = new ArrayList<>();

    /**
     * Constructeur
     */
    public TemporalReactor() {
        TEMPORAL_REACTORS.add(this);
    }

    /**
     * Permet de modifier des valeurs aléatoires dans les classes
     */
    public abstract void tick();

    /**
     * Méthode permettant de lancer la modification de valeurs aléatoires
     */
    public static void notifyTick() {
        TEMPORAL_REACTORS.forEach(TemporalReactor::tick);
    }

}

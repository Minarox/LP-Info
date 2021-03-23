/*
Consignes globales :
  - Modifier aléatoirement l'état de certains animaux (les rendre malades, les endormir, etc.)
  - Modifier aléatoirement l'état de certains enclos (leur propreté, leur salinité, etc.)
  - Passer la main à l'employé (et donc l'utilisateur) pour qu'il s'occupe du models.zoo (son nombre d'action par intervalle de temps devant être limité)
*/

import controllers.MasterController;

public class Main {

    private static final MasterController masterController = new MasterController();

    public static void main(String[] args) {
        masterController.start();
        while (masterController.isGame()) {
            masterController.menu();
        }
    }

}

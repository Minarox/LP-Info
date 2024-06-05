package views;

public class MenuView {

    public MenuView() {}

    public void mainMenu() {
        System.out.println("\nMenu principal :\n" +
                "1 - Gestion des animaux\n" +
                "2 - Gestion des enclos\n" +
                "3 - Informations du Zoo\n" +
                "4 - Règles du jeu\n" +
                "5 - Quitter la partie");
    }

    public void endGame() {
        System.out.println("Voulez-vous vraiment quitter la partie ? (Oui ou Non)");
    }

    public void end() {
        System.out.println("Fin de la partie ! Merci d'avoir joué.");
    }

    public void actions() {
        System.out.println("Vous avez fait 5 actions. Modifications aléatoires des valeurs en cours...");
    }

    public void actionsEnd() {
        System.out.println("Modifications terminées.");
    }
}

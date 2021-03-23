package views;

public class StartView {

    public StartView() {}

    public void welcome() {
        System.out.println("Bienvenue dans la simulation de Zoo !\n\n" +
                "Pour commencer, nous allons créer un employé qui sera chargé de gérer et de s'occuper du Zoo.");
    }

    public void getNameEmployee() {
        System.out.println("Quel est le nom de votre employé ?");
    }

    public void getSexEmployee() {
        System.out.println("Quel est le sexe de votre employé ? (Homme ou Femme)");
    }

    public void getAgeEmployee() {
        System.out.println("Quel est l'age de votre employé ?");
    }

    public void successEmployee() {
        System.out.println("L'employé à été créé !\n" +
                "Nous allons maintenant créer le Zoo.");
    }

    public void getNameZoo() {
        System.out.println("Quel est le nom de votre Zoo ?");
    }

    public void getMaxEnclosure() {
        System.out.println("Combien d'enclos au maximum autorisez vous dans votre Zoo ?");
    }

    public void successZoo() {
        System.out.println("Le Zoo à correctement été créé !\n");
    }

    public void rules() {
        System.out.println("Voici les règles du jeu :\n" +
                "- Vous êtes l'employé du Zoo et vous devez vous occuper des animaux et des enclos qui le constitue,\n" +
                "- Lorsque vous faite 5 actions, certains éléments du Zoo sont susceptible de changer (un animal devient malade, une cage devient sale, etc),\n" +
                "- C'est alors a vous d'analyser les animaux et les cages pour voir si tout vas bien.\n" +
                "Amusez vous bien !");
    }
}

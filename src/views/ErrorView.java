package views;

public class ErrorView {

    public static void error(Exception e) {
        System.out.println("Une erreur est survenue (" + e.getMessage() + " )");
    }

}

package controllers;

import models.employee.Employee;
import models.employee.enumerations.SexEmployee;
import models.zoo.Zoo;
import views.ErrorView;
import views.MenuView;
import views.StartView;

import java.util.Scanner;

public class MasterController {

    private static final Scanner scanner = new Scanner(System.in);
    private static final StartView startView = new StartView();
    private static final MenuView menuView = new MenuView();
    private static AnimalsController animalsController;
    private static EnclosuresController enclosuresController;
    private static InformationsController informationsController;
    private static Employee employee;
    private static Zoo zoo;
    private boolean game = true;
    private int actions = 0;

    public MasterController() {}

    public void start() {
        SexEmployee sexEmployee;
        startView.welcome();
        startView.getNameEmployee();
        String nameEmployee = scanner.next();
        startView.getSexEmployee();
        String sex = scanner.next();
        if (sex.equals("Homme")) {
            sexEmployee = SexEmployee.MAN;
        } else if (sex.equals("Femme")) {
            sexEmployee = SexEmployee.WOMEN;
        } else {
            throw new IllegalArgumentException("Le sexe de l'employé n'a pas été correctement renseigné.");
        }
        startView.getAgeEmployee();
        int ageEmployee = scanner.nextInt();
        employee = new Employee(nameEmployee, sexEmployee, ageEmployee);
        startView.successEmployee();
        startView.getNameZoo();
        String nameZoo = scanner.next();
        startView.getMaxEnclosure();
        int maxEnclosure = scanner.nextInt();
        zoo = new Zoo(nameZoo, employee, maxEnclosure);
        enclosuresController = new EnclosuresController(zoo);
        animalsController = new AnimalsController(zoo);
        informationsController = new InformationsController(zoo);
        startView.successZoo();
        startView.rules();
    }

    public void menu() {
        try {
            if (actions == 5) {
                menuView.actions();
                employee.action();
                menuView.actionsEnd();
                this.actions = 0;
            }
            menuView.mainMenu();
            int selected = scanner.nextInt();
            switch (selected) {
                case 1:
                    animalsController.menu();
                    break;
                case 2:
                    enclosuresController.menu();
                    break;
                case 3:
                    informationsController.menu();
                    break;
                case 4:
                    startView.rules();
                    actions--;
                    break;
                case 5:
                    endGame();
                    break;
                default:
                    throw new IllegalArgumentException("Sélection en dehors du menu.");
            }
            actions++;
        } catch (Exception e) {
            ErrorView.error(e);
        }
    }

    public void endGame() {
        menuView.endGame();
        String selected = scanner.next();
        if (selected.equals("Oui")) {
            this.game = false;
            menuView.end();
        }
    }

    public static Zoo getZoo() {
        return zoo;
    }

    public static Employee getEmployee() {
        return employee;
    }

    public boolean isGame() {
        return game;
    }
}

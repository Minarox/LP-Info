# Simulation de Zoo
Projet de fin de semestre 5 de la Licence Pro en Développement Web.  
Création d'une simulation de Zoo avec gestions des animaux, des enclos et de l'employé.

## Sommaire
* [Fonctionnalités](https://github.com/lp-dev-web/projet-zoo#fonctionnalités)
* [Dossiers](https://github.com/lp-dev-web/projet-zoo#dossiers)

## Fonctionnalités
**Les Animaux**  
Il est possible de gérer les animaux présents dans le [models/zoo](https://github.com/lp-dev-web/projet-zoo/tree/main/src/models/zoo).  
Vous pouvez en créer de nouveau, les nourrir, les soigner et les faire dormir.  
Chaque models.animal appartient à un sous-groupe (mammifères ou autres) et possède une fonction de déplacement spécifique à son espèce (marche, nage ou vol).

**Les Enclos**  
Il est aussi possible de gérer les enclos présents dans le [models/zoo](https://github.com/lp-dev-web/projet-zoo/tree/main/src/models/zoo).  
Comme pour les animaux, il est possible d'en créer de nouveau, d'ajouter ou enlever des animaux, de nourrir les animaux présents et d'entretenir l'enclos.  
Chaque enclos peut appartenir à une catégorie spécifique : une volière ou un aquarium.

**L'employé**  
L'utilisateur peut alors gérer le [models/zoo](https://github.com/lp-dev-web/projet-zoo/tree/main/src/models/zoo) avec l'employé.  
Il peut examiner un enclos, le nettoyer, nourrir les animaux d'un enclos et transférer un models.animal d'un enclos à un autre.

## Dossiers
* [Contrôleurs](https://github.com/lp-dev-web/projet-zoo/tree/main/src/controllers)
* [Modèles](https://github.com/lp-dev-web/projet-zoo/tree/main/src/models)
* [Vues](https://github.com/lp-dev-web/projet-zoo/tree/main/src/views)
* [Animaux](https://github.com/lp-dev-web/projet-zoo/tree/main/src/models/animal)
* [Enclos](https://github.com/lp-dev-web/projet-zoo/tree/main/src/models/enclosure)
* [Employé](https://github.com/lp-dev-web/projet-zoo/tree/main/src/models/employee)
* [Zoo](https://github.com/lp-dev-web/projet-zoo/tree/main/src/models/zoo)
* [Helpers](https://github.com/lp-dev-web/projet-zoo/tree/main/src/models/helpers)
* [Tests](https://github.com/lp-dev-web/projet-zoo/tree/main/src/models/tests)

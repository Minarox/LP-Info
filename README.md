# Sujet : Gestion de flotte CMA-CGM(PA)

Vous allez gérer l'approvisionnement des porte-conteneurs en conteneurs.

Pour cela, vous avez accès à une partie de la base de données.

L'exécutable `composer` est dans le dossier `bin/`

Pensez à faire un `./bin/composer install`
## Schema
![](https://github.com/hadeli/LP2021Project/blob/master/iut_lp_00.png)

La génération de la base se fait de la façon suivante :
`./bin/console   doctrine:migrations:migrate`

* Host : 51.159.25.174
* Port : 57002
* Login & Mdp : Les mêmes que pendant le cours

Vous allez devoir créer une application web en Symfony pour effectuer différentes actions sur cette base de donnée.
## Tronc commun
### Étape 1 : Mapper la base de donnée
* Créer les entités pour chacune des tables de la BD
    * Table ``CONTAINERSHIP``
    * Table ``CONTAINER_MODEL``
    * Table ``PRODUCT``
    * Table ``CONTAINER``
    * Table ``CONTAINER_PRODUCT``

Pensez aux normalizers

### Étape 2 : Créer des routes d'accès pour chacune des entités
* Créer les routes suivantes :
    * ``GET /container`` elle envoie la liste des conteneurs
    * ``GET/container/{id}`` elle renvoie le detail d'un conteneur
    * ``GET/containership`` elle renvoie la liste des bateaux
    * ``GET/containership/{id}`` elle renvoie le detail d'un bateau
    * ``GET/product`` elle renvoie la liste des produits
    * ``GET/product/{id}`` elle renvoie le detail d'un conteneur

## La suite
### Ajout dans la base
* Créer les routes suivantes pour permettre l'ajout en base
    * ``POST /containership/new`` crée un porte-conteneur
    * ``POST /product/new`` crée un produit
    * ``POST /product-container/new`` ajoute un produit dans un conteneur
    * ``POST /container/new`` crée un conteneur et l'ajoute à un porte conteneur

Quand la route est utilisée, un nouvel enregistrement doit être crée en BD
### Règles métier
Implementer les règles métiers suivants
#### Limite d'un porte conteneur
 Un porte conteneur peut transporter un nombre maximum de conteneur (valeur ``CONTAINER_LIMIT`` dans la table ``CONTAINERSHIP``)
 Il faut donc controller, à l'ajout d'un conteneur, si on ne dépasse pas la limite
 Conseil : Utiliser le porte conteneur qui a pour ``ID = 2``
#### Limite d'un conteneur 
Un conteneur a des dimensions qui limitent le nombre de produits transportés (défini par ``LENGTH``,``WIDTH``,``HEIGHT``).
Les produits ont également des dimensions (défini par ``LENGTH``,``WIDTH``,``HEIGHT``).
À l'ajout d'un produit dans un conteneur, il faut controller si le produit peut rentrer. (Indice pour les téléspectateurs : [Wikipedia](https://fr.wikipedia.org/wiki/Volume#Les_prismes_et_cylindres))

 Conseil : Utiliser le conteneur qui a pour ``ID = 151``

## Rendu
Par pull request depuis votre fork.

Échéance : 15/01/2021 23 h 59

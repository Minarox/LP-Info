// Variables globales
var descInterieur = ""
var descExterieur = ""
var titre = ""
var alerte = ""

// Appel au fichier JSON du capteur intérieur
function alertesInterieur() {
    // Appel AJAX du premier capteur
    $.ajax({
        // URL et format du fichier
        url: "assets/data/DonneesInterieur.json",
        dataType: "JSON",
        // Lorsque le fichier à bien été lu :
        success: function (capteur) {
            // Appel AJAX des alertes
            $.ajax({
                // URL et format du fichier
                url: "assets/data/Alertes.json",
                dataType: "JSON",
                // Lorsque le fichier à bien été lu :
                success: function (alertes) {
                    // Variables
                    var length = capteur.Donnees.length - 1
                    var temperature = capteur.Donnees[length].Temperatures[capteur.Donnees[length].Temperatures.length-1]
                    // Comparaison de la valeur actuelle avec les valeurs présentes dans le fichier d'alertes
                    if (temperature < alertes.Interieur[0].Valeur) {
                        // Appel à la fonction d'affichage de l'erreur s'il y a une correspondance
                        affichagePage("Interieur", alertes.Interieur[0].Titre, alertes.Interieur[0].Description)
                    } else if (temperature < alertes.Interieur[1].Valeur) {
                        // Appel à la fonction d'affichage de l'erreur s'il y a une correspondance
                        affichagePage("Interieur", alertes.Interieur[1].Titre, alertes.Interieur[1].Description)
                    } else if (temperature > alertes.Interieur[2].Valeur) {
                        // Appel à la fonction d'affichage de l'erreur s'il y a une correspondance
                        affichagePage("Interieur", alertes.Interieur[2].Titre, alertes.Interieur[2].Description)
                    } else if (temperature > alertes.Interieur[3].Valeur) {
                        // Appel à la fonction d'affichage de l'erreur s'il y a une correspondance
                        affichagePage("Interieur", alertes.Interieur[3].Titre, alertes.Interieur[3].Description)
                    }
                },
                // Lorsque le fichier est indisponible ou illisible :
                error: function (err) {
                    // Affichage d'une erreur dans la console
                    console.log("[Erreur] Impossible de lire les alertes.")
                }
            })
        },
        // Lorsque le fichier est indisponible ou illisible :
        error: function (err) {
            // Affichage d'une erreur dans la console
            console.log("[Erreur] Impossible de lire les données du capteur extérieur.")
        }
    })
}

// Appel au fichier JSON du capteur extérieur
function alertesExterieur() {
    // Appel AJAX du second capteur
    $.ajax({
        // URL et format du fichier
        url: "assets/data/DonneesExterieur.json",
        dataType: "JSON",
        // Lorsque le fichier à bien été lu :
        success: function (capteur) {
            // Appel AJAX des alertes
            $.ajax({
                // URL et format du fichier
                url: "assets/data/Alertes.json",
                dataType: "JSON",
                // Lorsque le fichier à bien été lu :
                success: function (alertes) {
                    // Variables
                    var length = capteur.Donnees.length - 1
                    var temperature = capteur.Donnees[length].Temperatures[capteur.Donnees[length].Temperatures.length-1]
                    // Comparaison de la valeur actuelle avec les valeurs présentes dans le fichier d'alertes
                    if (temperature < alertes.Exterieur[0].Valeur) {
                        // Appel à la fonction d'affichage de l'erreur s'il y a une correspondance
                        affichagePage("Exterieur",alertes.Exterieur[0].Titre, alertes.Exterieur[0].Description)
                    } else if (temperature > alertes.Exterieur[1].Valeur) {
                        // Appel à la fonction d'affichage de l'erreur s'il y a une correspondance
                        affichagePage("Exterieur",alertes.Exterieur[1].Titre, alertes.Exterieur[1].Description)
                    }
                },
                // Lorsque le fichier est indisponible ou illisible :
                error: function (err) {
                    // Affichage d'une erreur dans la console
                    console.log("[Erreur] Impossible de lire les alertes.")
                }
            })
        },
        // Lorsque le fichier est indisponible ou illisible :
        error: function (err) {
            // Affichage d'une erreur dans la console
            console.log("[Erreur] Impossible de lire les données du capteur extérieur.")
        }
    })
}

// Fonction d'affichage de l'alerte dans la page
function affichagePage(capteur, alerte, description) {
    // Sélection de la description en fonction du capteur
    if (capteur === "Interieur") {
        descInterieur = description
    } else {
        descExterieur = description
    }
    // Modification des éléments et affichage de l'alerte
    $("#alerte"+capteur+" p").text(alerte)
    $("#"+capteur+" section").css({"filter": "blur(8px)","pointer-events": "none", "user-select": "none"})
    $("#alerte"+capteur).css({"opacity": "1", "transition": "opacity 0.4s 0.2s", "filter": "blur(0px)", "pointer-events": "auto", "user-select": "auto"})
}

// Fonction permettant d'afficher les détails d'une erreur
function detailsAlerte(capteur, retour) {
    // Traitement différent en fonction de l'affichage en cours
    if (retour !== true) {
        // Affichage des détails de l'alerte du capteur
        titre = $("#alerte"+capteur+" h2").text()
        alerte = $("#alerte"+capteur+" p").text()
        $("#btnDetails"+capteur).css({"display": "none"})
        $("#btnRetour"+capteur).css({"display": "inline"})
        $("#alerte"+capteur+" h2").text("Détails de l'alerte :")
        // Sélection de la description en fonction du capteur
        if (capteur === "Interieur") {
            $("#alerte"+capteur+" p").text(descInterieur)
        } else {
            $("#alerte"+capteur+" p").text(descExterieur)
        }
    } else {
        // Affichage de l'erreur sans le détail
        $("#btnDetails"+capteur).css({"display": "inline"})
        $("#btnRetour"+capteur).css({"display": "none"})
        $("#alerte"+capteur+" h2").text(titre)
        $("#alerte"+capteur+" p").text(alerte)
    }
}

// Fonction de fermeture de l'alerte
function fermerAlerte(capteur) {
    // Modification du CSS permettant de retourner à l'affichage normal
    $("#"+capteur+" section").css({"filter": "blur(0px)","pointer-events": "auto", "user-select": "auto"})
    $("#alerte"+capteur).css({"opacity": "0", "transition": "opacity 0.2s", "filter": "blur(0px)", "pointer-events": "none", "user-select": "none"})
}

// Appels des fonctions pour potentiellement afficher les alertes
setTimeout(alertesInterieur, 1250);
setTimeout(alertesExterieur, 1250);

// Variables globales
var descInterieur = ""
var descExterieur = ""
var titre = ""
var alerte = ""

// Appel au fichier JSON du capteur intérieur
function indoorAlerts() {
    // Appel AJAX du premier capteur
    $.ajax({
        // URL et format du fichier
        url: "public/assets/data/DonneesInterieur.json",
        dataType: "JSON",
        // Lorsque le fichier à bien été lu :
        success: function (capteur) {
            // Appel AJAX des alertes
            $.ajax({
                // URL et format du fichier
                url: "public/assets/data/Alertes.json",
                dataType: "JSON",
                // Lorsque le fichier à bien été lu :
                success: function (alertes) {
                    // Variables
                    var length = capteur.Donnees.length - 1
                    var temperature = capteur.Donnees[length].Temperatures[capteur.Donnees[length].Temperatures.length-1]
                    // Comparaison de la valeur actuelle avec les valeurs présentes dans le fichier d'alertes
                    if (temperature < alertes.Interieur[0].Valeur) {
                        // Appel à la fonction d'affichage de l'erreur s'il y a une correspondance
                        pageDisplay("indoor", alertes.Interieur[0].Titre, alertes.Interieur[0].Description)
                    } else if (temperature < alertes.Interieur[1].Valeur) {
                        // Appel à la fonction d'affichage de l'erreur s'il y a une correspondance
                        pageDisplay("indoor", alertes.Interieur[1].Titre, alertes.Interieur[1].Description)
                    } else if (temperature > alertes.Interieur[2].Valeur) {
                        // Appel à la fonction d'affichage de l'erreur s'il y a une correspondance
                        pageDisplay("indoor", alertes.Interieur[2].Titre, alertes.Interieur[2].Description)
                    } else if (temperature > alertes.Interieur[3].Valeur) {
                        // Appel à la fonction d'affichage de l'erreur s'il y a une correspondance
                        pageDisplay("indoor", alertes.Interieur[3].Titre, alertes.Interieur[3].Description)
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
function outdoorAlerts() {
    // Appel AJAX du second capteur
    $.ajax({
        // URL et format du fichier
        url: "public/assets/data/DonneesExterieur.json",
        dataType: "JSON",
        // Lorsque le fichier à bien été lu :
        success: function (capteur) {
            // Appel AJAX des alertes
            $.ajax({
                // URL et format du fichier
                url: "public/assets/data/Alertes.json",
                dataType: "JSON",
                // Lorsque le fichier à bien été lu :
                success: function (alertes) {
                    // Variables
                    var length = capteur.Donnees.length - 1
                    var temperature = capteur.Donnees[length].Temperatures[capteur.Donnees[length].Temperatures.length-1]
                    // Comparaison de la valeur actuelle avec les valeurs présentes dans le fichier d'alertes
                    if (temperature < alertes.Exterieur[0].Valeur) {
                        // Appel à la fonction d'affichage de l'erreur s'il y a une correspondance
                        pageDisplay("outdoor",alertes.Exterieur[0].Titre, alertes.Exterieur[0].Description)
                    } else if (temperature > alertes.Exterieur[1].Valeur) {
                        // Appel à la fonction d'affichage de l'erreur s'il y a une correspondance
                        pageDisplay("outdoor",alertes.Exterieur[1].Titre, alertes.Exterieur[1].Description)
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
function pageDisplay(capteur, alerte, description) {
    // Sélection de la description en fonction du capteur
    if (capteur === "indoor") {
        descInterieur = description
    } else {
        descExterieur = description
    }
    // Modification des éléments et affichage de l'alerte
    $("#sensor"+capteur+"-alert p").text(alerte)
    $("#sensor"+capteur+" section").css({"filter": "blur(8px)","pointer-events": "none", "user-select": "none"})
    $("#sensor"+capteur+"-alert").css({"opacity": "1", "transition": "opacity 0.4s 0.2s", "filter": "blur(0px)", "pointer-events": "auto", "user-select": "auto"})
}

// Fonction permettant d'afficher les détails d'une erreur
function alertDetails(capteur, retour) {
    // Traitement différent en fonction de l'affichage en cours
    if (retour !== true) {
        // Affichage des détails de l'alerte du capteur
        titre = $("#sensor"+capteur+"-alert h2").text()
        alerte = $("#sensor"+capteur+"-alert p").text()
        $("#sensor"+capteur+"-details-btn").css({"display": "none"})
        $("#sensor"+capteur+"-back-btn").css({"display": "inline"})
        $("#sensor"+capteur+"-alert h2").text("Détails de l'alerte :")
        // Sélection de la description en fonction du capteur
        if (capteur === "indoor") {
            $("#sensor"+capteur+"-alert p").text(descInterieur)
        } else {
            $("#sensor"+capteur+"-alert p").text(descExterieur)
        }
    } else {
        // Affichage de l'erreur sans le détail
        $("#sensor"+capteur+"-details-btn").css({"display": "inline"})
        $("#sensor"+capteur+"-back-btn").css({"display": "none"})
        $("#sensor"+capteur+"-alert h2").text(titre)
        $("#sensor"+capteur+"-alert p").text(alerte)
    }
}

// Fonction de fermeture de l'alerte
function closeAlert(capteur) {
    // Modification du CSS permettant de retourner à l'affichage normal
    $("#sensor"+capteur+" section").css({"filter": "blur(0px)","pointer-events": "auto", "user-select": "auto"})
    $("#sensor"+capteur+"-alert").css({"opacity": "0", "transition": "opacity 0.2s", "filter": "blur(0px)", "pointer-events": "none", "user-select": "none"})
}

// Appels des fonctions pour potentiellement afficher les alertes
setTimeout(indoorAlerts, 1250);
setTimeout(outdoorAlerts, 1250);

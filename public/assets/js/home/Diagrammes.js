// Appel au fichier JSON du capteur intérieur
function indoor(result) {
    // Variables
    /*var length = result.Donnees.length - 1
    var data = []
    var labels = []
    var y = 24
    var date = result.Donnees[length].Date
    var dateAnt = result.Donnees[length-1].Date
    // Lecture de l'état du capteur et modification des éléments
    if (result.Etat === false) {
        $("#indoor-dot").css("background-color", "red")
        var text = $("#indoor-state").text()
        $("#indoor-state").text(text.replace("Actif", "Inactif"))
        $("#indoor-state").css({"--main-color": "red"})
    }
    // Récupération des données de températures avec heures associées
    for (let i = result.Donnees[length].Temperatures.length - 11; i < result.Donnees[length].Temperatures.length; i++) {
        if (i < 0) {
            z = y - Math.abs(i)
            data.push(result.Donnees[length-1].Temperatures[z])
            labels.push(result.Donnees[length-1].Heures[z])
        } else {
            data.push(result.Donnees[length].Temperatures[i])
            labels.push(result.Donnees[length].Heures[i])
        }
    }
    // Modification de l'affichage des textes d'informations de températures
    $("#indoor-now").text(result.Donnees[length].Temperatures[result.Donnees[length].Temperatures.length-1]+"°C")
    $("#indoor-max").text(Math.max(...data)+"°C")
    $("#indoor-min").text(Math.min(...data)+"°C")
    // Appel à la fonction permettant de générer le diagramme
    indoorChart(data, labels, date, dateAnt)*/
}

// Appel au fichier JSON du capteur extérieur
function outdoor() {
    // Appel AJAX
    $.ajax({
        // URL et format du fichier
        url: "public/assets/data/DonneesExterieur.json",
        dataType: 'JSON',
        // Lorsque le fichier à bien été lu :
        success: function (result) {
            // Variables
            var length = result.Donnees.length - 1
            var data = []
            var labels = []
            var y = 24
            var date = result.Donnees[length].Date
            var dateAnt = result.Donnees[length-1].Date
            // Lecture de l'état du capteur et modification des éléments
            if (result.Etat === false) {
                $("#outdoor-dot").css("background-color", "red")
                let text = $("#outdoor-state").text()
                $("#outdoor-state").text(text.replace("Actif", "Inactif"))
                $("#outdoor-state").css({"--main-color": "red"})
            }
            // Récupération des données de températures avec heures associées
            for (let i = result.Donnees[length].Temperatures.length - 11; i < result.Donnees[length].Temperatures.length; i++) {
                if (i < 0) {
                    z = y - Math.abs(i)
                    data.push(result.Donnees[length-1].Temperatures[z])
                    labels.push(result.Donnees[length-1].Heures[z])
                } else {
                    data.push(result.Donnees[length].Temperatures[i])
                    labels.push(result.Donnees[length].Heures[i])
                }
            }
            // Modification de l'affichage des textes d'informations de températures
            $("#outdoor-now").text(result.Donnees[length].Temperatures[result.Donnees[length].Temperatures.length-1]+"°C")
            $("#outdoor-max").text(Math.max(...data)+"°C")
            $("#outdoor-min").text(Math.min(...data)+"°C")
            // Appel à la fonction permettant de générer le diagramme
            outdoorChart(data, labels, date, dateAnt)
        },
        // Lorsque le fichier est indisponible ou illisible :
        error: function (err) {
            // Affichage d'une erreur dans la console
            console.log("[Erreur] Impossible de lire les données du capteur extérieur.")
            // Modification des éléments définissant l'état du capteur
            $("#outdoor-state").css("background-color", "red")
            var text = $("#outdoor-state").text()
            $("#outdoor-state").text(text.replace("Actif", "Données indisponibles"))
            $("#outdoor-state").css({"--main-color": "red", "width": "120px"})
        }
    })
}

// Appel aux fichiers JSON pour la comparaison des données
function comparison() {
    // Appel AJAX du premier capteur
    $.ajax({
        // URL et format du fichier
        url: "public/assets/data/DonneesInterieur.json",
        dataType: 'JSON',
        // Lorsque le fichier à bien été lu :
        success: function (result) {
            // Variables
            var dataInt = []
            var labels = []
            // Récupération des données de températures avec heures associées
            for (let i = 0; i < result.Donnees.length; i++) {
                for (let j = 0; j < result.Donnees[i].Temperatures.length; j++) {
                    dataInt.push(result.Donnees[i].Temperatures[j])
                    if (result.Donnees[i].Heures[j] === "00h") {
                        labels.push(result.Donnees[i].Date)
                    } else {
                        labels.push(result.Donnees[i].Heures[j])
                    }
                }
            }
            // Appel AJAX du second capteur
            $.ajax({
                // URL et format du fichier
                url: "public/assets/data/DonneesExterieur.json",
                dataType: 'JSON',
                // Lorsque le fichier à bien été lu :
                success: function (result) {
                    // Variable
                    var dataExt = []
                    // Récupération des données de températures
                    for (let i = 0; i < result.Donnees.length; i++) {
                        for (let j = 0; j < result.Donnees[i].Temperatures.length; j++) {
                            dataExt.push(result.Donnees[i].Temperatures[j])
                        }
                    }
                    // Appel à la fonction permettant de générer le diagramme
                    comparisonChart(dataInt, dataExt, labels)
                },
                // Lorsque le fichier est indisponible ou illisible :
                error: function (err) {
                    // Affichage d'une erreur dans la console
                    console.log("[Erreur] Données du capteur extérieur indisponible.")
                    // Appel à la fonction permettant de générer le diagramme
                    comparisonChart(dataInt, [], labels)
                }
            })
        },
        // Lorsque le fichier est indisponible ou illisible :
        error: function (err) {
            console.log("[Erreur] Données du capteur intérieur indisponible.")
            // Appel AJAX du second capteur
            $.ajax({
                // URL et format du fichier
                url: "public/assets/data/DonneesExterieur.json",
                dataType: 'JSON',
                // Lorsque le fichier à bien été lu :
                success: function (result) {
                    // Variables
                    var dataExt = []
                    var labelsExt = []
                    // Récupération des données de températures avec heures associées
                    for (let i = 0; i < result.Donnees.length; i++) {
                        for (let j = 0; j < result.Donnees[i].Temperatures.length; j++) {
                            dataExt.push(result.Donnees[i].Temperatures[j])
                            if (result.Donnees[i].Heures[j] === "00h") {
                                labelsExt.push(result.Donnees[i].Date)
                            } else {
                                labelsExt.push(result.Donnees[i].Heures[j])
                            }
                        }
                    }
                    // Appel à la fonction permettant de générer le diagramme
                    comparisonChart([], dataExt, labelsExt)
                },
                error: function (err) {
                    // Affichage d'une erreur dans la console
                    console.log("[Erreur] Aucune donnée disponible.")
                }
            })
        }
    })
}

// Couleur et police d'écriture par défaut des charts
Chart.defaults.global.defaultFontColor = 'white'
Chart.defaults.global.defaultFontFamily = '"Roboto", "Arial", "Helvetica", "sans-serif"'



// Diagramme du capteur extérieur
function outdoorChart(data, labels, date, dateAnt) {
    // Balise à cibler pour afficher le graphique
    var ctx = document.getElementById("outdoor-charts").getContext('2d')
    // Dégradé de couleur des barres du graphique
    var degradeCouleur = ctx.createLinearGradient(0, 230, 0, 50);
    degradeCouleur.addColorStop(1, 'rgba(72,72,176,0.3)');
    degradeCouleur.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    degradeCouleur.addColorStop(0, 'rgba(119,52,169,0)');
    // Génération du diagramme avec les données
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: "Température ",
                backgroundColor: degradeCouleur,
                borderColor: "#D048B6",
                borderWidth: 2,
                data: data
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: { display: false },
            scales: { yAxes: [{ ticks: { beginAtZero: true } }] },
            tooltips: { callbacks: {
                    title: function(TooltipItem, data) {
                        var dateFinale = date
                        for (let i = 0; i < data.labels.length; i++) {
                            if (data.labels[i] === "00h") {
                                if (TooltipItem[0].xLabel === "23h" ||
                                    TooltipItem[0].xLabel === "22h" ||
                                    TooltipItem[0].xLabel === "21h" ||
                                    TooltipItem[0].xLabel === "20h" ||
                                    TooltipItem[0].xLabel === "19h" ||
                                    TooltipItem[0].xLabel === "18h" ||
                                    TooltipItem[0].xLabel === "17h" ||
                                    TooltipItem[0].xLabel === "16h" ||
                                    TooltipItem[0].xLabel === "15h" ||
                                    TooltipItem[0].xLabel === "14h" ||
                                    TooltipItem[0].xLabel === "13h") {
                                    dateFinale = dateAnt
                                }
                            }
                        }
                        return dateFinale + " - " + TooltipItem[0].xLabel
                    }
                } }
        }
    })
}

// Diagramme de comparaison des capteurs
function comparisonChart(dataInt, dataExt, labels) {
    // Balise à cibler pour afficher le graphique
    var ctx = document.getElementById("comparison").getContext('2d')
    // Génération du diagramme avec les données
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: "Intérieur ",
                borderColor: "#1F8EF1",
                borderWidth: 2,
                pointBackgroundColor: '#1F8EF1',
                data: dataInt
            },
            {
                label: "Extérieur ",
                borderColor: "#D048B6",
                borderWidth: 2,
                pointBackgroundColor: '#D048B6',
                data: dataExt
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: { display: false },
            scales: { yAxes: [{ ticks: { beginAtZero: true } }] }
        }
    })
}





function parse_data_charts(raw_data) {
    let data = JSON.parse(raw_data)
    // for (let i = 0; i < data.length; i++) {
        let i = 0
        let name = data[i]['name']
        if (name) {
            name = "Capteur"
        }
        let type = data[i]['type']
        if (type) {
            type = "Inconnu"
        }
        let sensor_data = data[i]['data']
        let temperature = []
        let time = []
        if (sensor_data.length === 0) {
            $("#sensor-"+i+"-dot").css("background-color", "red")
            let text = $("#sensor-"+i+"-state").text()
            $("#sensor-"+i+"-state").text(text.replace("Actif", "Inactif"))
            $("#sensor-"+i+"-state").css({"--main-color": "red"})
            // TODO: "Inactif" si le temps entre maintenant et la dernière valeur est supérieur au temps de synchro de config.ini
        } else {
            for (let j = 116; j < 128; j++) {
                temperature.push(data[i]['data'][j]['temperature'])
                time.push(data[i]['data'][j]['time'])
            }
        }
        // $("#sensor-"+i+"-now").text(result.Donnees[length].Temperatures[result.Donnees[length].Temperatures.length-1]+"°C")
        // $("#sensor-"+i+"-max").text(Math.max(...data)+"°C")
        // $("#sensor-"+i+"-min").text(Math.min(...data)+"°C")
        chart(i, temperature, time)
    // }
    /*
    // Modification de l'affichage des textes d'informations de températures
    $("#indoor-now").text(result.Donnees[length].Temperatures[result.Donnees[length].Temperatures.length-1]+"°C")
    $("#indoor-max").text(Math.max(...data)+"°C")
    $("#indoor-min").text(Math.min(...data)+"°C")*/
}

// Diagramme du capteur intérieur
function chart(id, data, labels) {
    // Balise à cibler pour afficher le graphique
    let ctx = document.getElementById("sensor"+id+"-charts").getContext('2d')
    // Dégradé de couleur des barres du graphique
    let degradeCouleur = ctx.createLinearGradient(0, 230, 0, 50);
    degradeCouleur.addColorStop(1, 'rgba(29,140,248,0.3)');
    degradeCouleur.addColorStop(0.4, 'rgba(29,140,248,0.0)');
    degradeCouleur.addColorStop(0, 'rgba(29,140,248,0)');
    let date = []
    let time = []
    for (let i = 0; i < labels.length; i++) {
        let str = labels[i].split(" ")
        date.push(str[0])
        time.push(str[1].slice(0, -3))
    }
    // Génération du diagramme avec les données
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: time,
            datasets: [{
                label: "Température ",
                backgroundColor: degradeCouleur,
                borderColor: "#1F8EF1",
                borderWidth: 2,
                data: data
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: { display: false },
            scales: { yAxes: [{ ticks: { beginAtZero: true } }] },
            /*tooltips: { callbacks: {
                    title: function(TooltipItem) {
                        return date + " - " + TooltipItem[0].xLabel
                    }
                } }*/
        }
    })
}








// Appels des fonctions pour afficher les charts
parse_data_charts(data_sensors)

// indoor(data1)
outdoor()
comparison()

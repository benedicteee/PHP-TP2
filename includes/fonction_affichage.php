<?php

////////////////////////////////////////////////////////////

// 🌐 Affichage HTML du planning
function afficher_planning_html($planning)
{

    ////////////////////////////////////////////////////////////
    // Liste des jours

    $jours = [
        "Lundi",
        "Mardi",
        "Mercredi",
        "Jeudi",
        "Vendredi"
    ];

    ////////////////////////////////////////////////////////////
    // Liste des heures

    $heures = [
        "08h-12h",
        "13h-17h"
    ];

    ////////////////////////////////////////////////////////////
    // Début tableau HTML

    echo "
    <table border='1' cellpadding='10' cellspacing='0'>
    ";

    ////////////////////////////////////////////////////////////
    // En-tête

    echo "<tr>";
    echo "<th>Créneaux</th>";

    foreach ($jours as $jour) {

        echo "<th>$jour</th>";
    }

    echo "</tr>";

    ////////////////////////////////////////////////////////////
    // Corps du tableau

    foreach ($heures as $heure) {

        echo "<tr>";

        echo "<td><strong>$heure</strong></td>";

        foreach ($jours as $jour) {

            echo "<td>";

            ////////////////////////////////////////////////////////////
            // Chercher cours correspondant

            foreach ($planning as $ligne) {

                $creneau_complet =
                    $jour . "-" . $heure;

                if (
                    $ligne["creneau"] ==
                    $creneau_complet
                ) {

                    echo
                        "<strong>Salle :</strong> "
                        . $ligne["salle"]
                        . "<br>";

                    echo
                        "<strong>Cours :</strong> "
                        . $ligne["cours"]
                        . "<br>";

                    echo
                        "<strong>Groupe :</strong> "
                        . $ligne["groupe"];
                }
            }

            echo "</td>";
        }

        echo "</tr>";
    }

    ////////////////////////////////////////////////////////////
    // Fin tableau

    echo "</table>";
}

?>
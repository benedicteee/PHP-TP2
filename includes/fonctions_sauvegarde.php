<?php

////////////////////////////////////////////////////////////

// 💾 Sauvegarder le planning dans un fichier TXT
function sauvegarder_planning($planning, $chemin_fichier)
{

    // Ouvrir le fichier en mode écriture
    $fichier = fopen($chemin_fichier, "w");

    // Vérifier ouverture
    if (!$fichier) {

        die("❌ Impossible d'ouvrir le fichier.");
    }

    ////////////////////////////////////////////////////////////
    // Parcours du planning

    foreach ($planning as $ligne) {

        ////////////////////////////////////////////////////////////
        // Découper le créneau

        $parties = explode("-", $ligne["creneau"]);

        $jour = $parties[0];
        $heure_debut = $parties[1];
        $heure_fin = $parties[2];

        ////////////////////////////////////////////////////////////
        // Construire la ligne

        $texte =
            $jour . ";" .
            $heure_debut . ";" .
            $heure_fin . ";" .
            $ligne["salle"] . ";" .
            $ligne["cours"] . ";" .
            $ligne["groupe"] . "\n";

        ////////////////////////////////////////////////////////////
        // Écrire dans le fichier

        fwrite($fichier, $texte);
    }

    ////////////////////////////////////////////////////////////
    // Fermer le fichier

    fclose($fichier);

    return true;
}

////////////////////////////////////////////////////////////

// 🏫 Sauvegarder les salles dans un fichier TXT
function sauvegarder_salles($salles, $chemin_fichier)
{
    // Ouvrir le fichier en mode écriture
    $fichier = fopen($chemin_fichier, "w");

    // Vérifier ouverture
    if (!$fichier) {
        die("❌ Impossible d'ouvrir le fichier.");
    }

    ////////////////////////////////////////////////////////////
    // Parcours des salles

    foreach ($salles as $salle) {
        ////////////////////////////////////////////////////////////
        // Construire la ligne

        $texte =
            $salle["id"] . ";" .
            $salle["designation"] . ";" .
            $salle["capacite"] . "\n";

        ////////////////////////////////////////////////////////////
        // Écrire dans le fichier

        fwrite($fichier, $texte);
    }

    ////////////////////////////////////////////////////////////
    // Fermer le fichier

    fclose($fichier);

    return true;
}

////////////////////////////////////////////////////////////

// 👨‍🎓 Sauvegarder les promotions dans un fichier TXT
function sauvegarder_promotions($promotions, $chemin_fichier)
{
    // Ouvrir le fichier en mode écriture
    $fichier = fopen($chemin_fichier, "w");

    // Vérifier ouverture
    if (!$fichier) {
        die("❌ Impossible d'ouvrir le fichier.");
    }

    ////////////////////////////////////////////////////////////
    // Parcours des promotions

    foreach ($promotions as $promotion) {
        ////////////////////////////////////////////////////////////
        // Construire la ligne

        $texte =
            $promotion["id"] . ";" .
            $promotion["libelle"] . ";" .
            $promotion["effectif"] . "\n";

        ////////////////////////////////////////////////////////////
        // Écrire dans le fichier

        fwrite($fichier, $texte);
    }

    ////////////////////////////////////////////////////////////
    // Fermer le fichier

    fclose($fichier);

    return true;
}

////////////////////////////////////////////////////////////

// 📚 Sauvegarder les cours dans un fichier TXT
function sauvegarder_cours($cours, $chemin_fichier)
{
    // Ouvrir le fichier en mode écriture
    $fichier = fopen($chemin_fichier, "w");

    // Vérifier ouverture
    if (!$fichier) {
        die("❌ Impossible d'ouvrir le fichier.");
    }

    ////////////////////////////////////////////////////////////
    // Parcours des cours

    foreach ($cours as $cour) {
        ////////////////////////////////////////////////////////////
        // Construire la ligne

        $texte =
            $cour["id"] . ";" .
            $cour["intitule"] . ";" .
            $cour["volume"] . ";" .
            $cour["type"] . ";" .
            $cour["promotion"] . "\n";

        ////////////////////////////////////////////////////////////
        // Écrire dans le fichier

        fwrite($fichier, $texte);
    }

    ////////////////////////////////////////////////////////////
    // Fermer le fichier

    fclose($fichier);

    return true;
}

////////////////////////////////////////////////////////////

// 🧪 Sauvegarder les options dans un fichier TXT
function sauvegarder_options($options, $chemin_fichier)
{
    // Ouvrir le fichier en mode écriture
    $fichier = fopen($chemin_fichier, "w");

    // Vérifier ouverture
    if (!$fichier) {
        die("❌ Impossible d'ouvrir le fichier.");
    }

    ////////////////////////////////////////////////////////////
    // Parcours des options

    foreach ($options as $option) {
        ////////////////////////////////////////////////////////////
        // Construire la ligne

        $texte =
            $option["id"] . ";" .
            $option["libelle"] . ";" .
            $option["promotion"] . ";" .
            $option["effectif"] . "\n";

        ////////////////////////////////////////////////////////////
        // Écrire dans le fichier

        fwrite($fichier, $texte);
    }

    ////////////////////////////////////////////////////////////
    // Fermer le fichier

    fclose($fichier);

    return true;
}

?>
<?php

// 🔹 Fonction générique pour lire un fichier texte
function lire_fichier($chemin) {
    if (!file_exists($chemin)) {
        die("❌ Fichier introuvable : " . $chemin);
    }

    $lignes = file($chemin, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if ($lignes === false) {
        die("❌ Erreur lors de la lecture du fichier : " . $chemin);
    }

    return $lignes;
}

////////////////////////////////////////////////////////////

// 🏫 Charger les salles
function charger_salles($chemin) {
    $lignes = lire_fichier($chemin);
    $salles = [];

    foreach ($lignes as $ligne) {
        $data = explode(';', $ligne);

        if (count($data) != 3) continue;

        $salles[] = [
            "id" => $data[0],
            "designation" => $data[1],
            "capacite" => (int)$data[2]
        ];
    }

    return $salles;
}

////////////////////////////////////////////////////////////

// 👨‍🎓 Charger les promotions
function charger_promotions($chemin) {
    $lignes = lire_fichier($chemin);
    $promotions = [];

    foreach ($lignes as $ligne) {
        $data = explode(';', $ligne);

        if (count($data) != 3) continue;

        $promotions[] = [
            "id" => $data[0],
            "libelle" => $data[1],
            "effectif" => (int)$data[2]
        ];
    }

    return $promotions;
}

////////////////////////////////////////////////////////////

// 📚 Charger les cours
function charger_cours($chemin) {
    $lignes = lire_fichier($chemin);
    $cours = [];

    foreach ($lignes as $ligne) {
        $data = explode(';', $ligne);

        if (count($data) != 5) continue;

        $cours[] = [
            "id" => $data[0],
            "intitule" => $data[1],
            "volume" => (int)$data[2],
            "type" => $data[3], // tronc ou option
            "promotion" => $data[4]
        ];
    }

    return $cours;
}

////////////////////////////////////////////////////////////

// 🧪 Charger les options
function charger_options($chemin) {
    $lignes = lire_fichier($chemin);
    $options = [];

    foreach ($lignes as $ligne) {
        $data = explode(';', $ligne);

        if (count($data) != 4) continue;

        $options[] = [
            "id" => $data[0],
            "libelle" => $data[1],
            "promotion" => $data[2],
            "effectif" => (int)$data[3]
        ];
    }

    return $options;
}

////////////////////////////////////////////////////////////

// 📅 Charger le planning
function charger_planning($chemin) {
    $lignes = lire_fichier($chemin);
    $planning = [];

    foreach ($lignes as $ligne) {
        $data = explode(';', $ligne);

        if (count($data) != 6) continue;

        $planning[] = [
            "creneau" => $data[0] . "-" . $data[1] . "-" . $data[2],
            "salle" => $data[3],
            "cours" => $data[4],
            "groupe" => $data[5]
        ];
    }

    return $planning;
}

?>
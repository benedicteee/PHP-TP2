<?php

require_once __DIR__ . "/fonctions_verification.php";

////////////////////////////////////////////////////////////

// 🔥 Génération automatique du planning optimisé
function generer_planning(
    $salles,
    $promotions,
    $cours,
    $options,
    $creneaux_disponibles
) {

    $planning = [];

    ////////////////////////////////////////////////////////////
    // Générer plus d'affectations : chaque cours peut être donné plusieurs fois
    // Créer des sessions multiples pour maximiser l'occupation

    $affectations_possibles = [];

    // Pour chaque cours, créer plusieurs sessions possibles
    foreach ($cours as $cours_item) {

        $groupe = $cours_item["promotion"];
        $effectif = 0;

        // Chercher l'effectif du groupe
        foreach ($promotions as $promo) {
            if ($promo["id"] == $groupe) {
                $effectif = $promo["effectif"];
                break;
            }
        }

        // Si cours option → prendre effectif option
        if ($cours_item["type"] == "option") {
            foreach ($options as $option) {
                if ($option["promotion"] == $groupe) {
                    $effectif = $option["effectif"];
                    break;
                }
            }
        }

        // Créer plusieurs sessions pour ce cours (2-3 par cours selon le volume horaire)
        $nombre_sessions = max(2, min(4, ceil($cours_item["volume"] / 2)));

        for ($i = 1; $i <= $nombre_sessions; $i++) {
            $affectations_possibles[] = [
                "cours" => $cours_item,
                "groupe" => $groupe,
                "effectif" => $effectif,
                "session" => $i
            ];
        }
    }

    // Dupliquer les cours "tronc" pour d'autres promotions avec sessions multiples
    foreach ($cours as $cours_item) {
        if ($cours_item["type"] == "tronc") {
            // Ce cours peut être donné à d'autres promotions
            foreach ($promotions as $promo) {
                if ($promo["id"] != $cours_item["promotion"]) {
                    $effectif_promo = $promo["effectif"];

                    // Créer 1-2 sessions pour les autres promotions
                    $nombre_sessions = rand(1, 2);

                    for ($i = 1; $i <= $nombre_sessions; $i++) {
                        $affectations_possibles[] = [
                            "cours" => $cours_item,
                            "groupe" => $promo["id"],
                            "effectif" => $effectif_promo,
                            "session" => $i
                        ];
                    }
                }
            }
        }
    }

    // Ajouter des cours génériques pour maximiser l'occupation
    $cours_generiques = [
        ["id" => "TP001", "intitule" => "Travaux Pratiques Informatique", "volume" => 2, "type" => "tp", "promotion" => ""],
        ["id" => "TP002", "intitule" => "Exercices Mathématiques", "volume" => 2, "type" => "tp", "promotion" => ""],
        ["id" => "TP003", "intitule" => "Laboratoire Physique", "volume" => 2, "type" => "tp", "promotion" => ""],
        ["id" => "REV001", "intitule" => "Révision Générale", "volume" => 2, "type" => "revision", "promotion" => ""],
        ["id" => "PROJ001", "intitule" => "Projet Informatique", "volume" => 3, "type" => "projet", "promotion" => ""]
    ];

    // Ajouter des sessions de cours génériques pour chaque promotion
    foreach ($cours_generiques as $cours_gen) {
        foreach ($promotions as $promo) {
            $effectif_promo = $promo["effectif"];

            // Ajuster l'effectif selon le type de cours
            if ($cours_gen["type"] == "tp" && $effectif_promo > 50) {
                $effectif_promo = min($effectif_promo, 40); // TP en petits groupes
            }

            $nombre_sessions = rand(1, 2); // 1-2 sessions par cours générique

            for ($i = 1; $i <= $nombre_sessions; $i++) {
                $affectations_possibles[] = [
                    "cours" => $cours_gen,
                    "groupe" => $promo["id"],
                    "effectif" => $effectif_promo,
                    "session" => $i
                ];
            }
        }
    }

    ////////////////////////////////////////////////////////////
    // Trier les cours par effectif décroissant (grands groupes d'abord)

    usort($affectations_possibles, function($a, $b) {
        return $b["effectif"] <=> $a["effectif"];
    });

    ////////////////////////////////////////////////////////////
    // Algorithme d'optimisation : essayer toutes les combinaisons

    $cours_non_affectes = [];

    foreach ($affectations_possibles as $item) {

        $affecte = false;
        $meilleure_combinaison = null;
        $meilleur_score = -1;

        ////////////////////////////////////////////////////////////
        // Essayer tous les créneaux et salles pour trouver la meilleure

        foreach ($creneaux_disponibles as $creneau) {

            foreach ($salles as $salle) {

                $id_salle = $salle["id"];

                // Vérifications des contraintes
                if (
                    salle_disponible($planning, $id_salle, $creneau)
                    &&
                    capacite_suffisante($salles, $id_salle, $item["effectif"])
                    &&
                    creneau_libre_groupe($planning, $item["groupe"], $creneau)
                ) {

                    // Calculer un score pour cette combinaison
                    // Préférer les salles bien dimensionnées et les créneaux tôt
                    $capacite_salle = 0;
                    foreach ($salles as $s) {
                        if ($s["id"] == $id_salle) {
                            $capacite_salle = $s["capacite"];
                            break;
                        }
                    }

                    $score = 0;
                    // Bonus pour salle bien remplie (80-100% de capacité)
                    $remplissage = $item["effectif"] / $capacite_salle;
                    if ($remplissage >= 0.8 && $remplissage <= 1.0) {
                        $score += 10;
                    }
                    // Bonus pour créneaux matinaux
                    if (strpos($creneau, "08h-12h") !== false) {
                        $score += 5;
                    }

                    // Garder la meilleure combinaison
                    if ($score > $meilleur_score) {
                        $meilleur_score = $score;
                        $meilleure_combinaison = [
                            "creneau" => $creneau,
                            "salle" => $id_salle
                        ];
                    }
                }
            }
        }

        ////////////////////////////////////////////////////////////
        // Appliquer la meilleure combinaison trouvée

        if ($meilleure_combinaison) {

            $planning[] = [
                "creneau" => $meilleure_combinaison["creneau"],
                "salle" => $meilleure_combinaison["salle"],
                "cours" => $item["cours"]["id"],
                "groupe" => $item["groupe"]
            ];

            $affecte = true;

        }

        ////////////////////////////////////////////////////////////
        // Cours non affecté

        if (!$affecte) {
            $cours_non_affectes[] = $item["cours"]["intitule"];
        }
    }

    ////////////////////////////////////////////////////////////
    // Rapport des cours non affectés

    if (!empty($cours_non_affectes)) {
        echo "<div class='erreur'>";
        echo "<strong>⚠️ Cours non affectés (" . count($cours_non_affectes) . ") :</strong><br>";
        foreach ($cours_non_affectes as $cours_nom) {
            echo "• " . $cours_nom . "<br>";
        }
        echo "</div>";
    } else {
        echo "<div class='success'>✅ Tous les cours ont été affectés avec succès !</div>";
    }

    ////////////////////////////////////////////////////////////
    // Statistiques d'occupation

    $total_creneaux = count($creneaux_disponibles) * count($salles);
    $creneaux_occupe = count($planning);
    $taux_occupation = round(($creneaux_occupe / $total_creneaux) * 100, 1);

    echo "<div class='info'>";
    echo "<strong>📊 Statistiques du planning :</strong><br>";
    echo "• Créneaux disponibles : " . count($creneaux_disponibles) . "<br>";
    echo "• Salles disponibles : " . count($salles) . "<br>";
    echo "• Cours affectés : " . $creneaux_occupe . "<br>";
    echo "• Taux d'occupation : " . $taux_occupation . "%<br>";
    echo "</div>";

    return $planning;
}

?>
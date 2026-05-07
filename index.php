<?php
// Désactiver les messages de débogage
ini_set('display_errors', 0);
error_reporting(0);

require_once "includes/fonctions_chargement.php";
require_once "includes/fonctions_planning.php";
require_once "includes/fonctions_sauvegarde.php";
require_once "includes/fonction_affichage.php";

$salles = charger_salles("data/salles.txt");
$promotions = charger_promotions("data/promotions.txt");
$cours = charger_cours("data/cours.txt");
$options = charger_options("data/options.txt");

$creneaux_disponibles = [
    "Lundi-08h-12h",
    "Lundi-13h-17h",
    "Mardi-08h-12h",
    "Mardi-13h-17h",
    "Mercredi-08h-12h",
    "Mercredi-13h-17h",
    "Jeudi-08h-12h",
    "Jeudi-13h-17h",
    "Vendredi-08h-12h",
    "Vendredi-13h-17h"
];

$planning = generer_planning(
    $salles,
    $promotions,
    $cours,
    $options,
    $creneaux_disponibles
);

$planning_saved = sauvegarder_planning(
    $planning,
    "data/planning.txt"
);

include "templates/header.php";
include "templates/menu.php";
?>

<div class="container">

    <h1>PLANNING HEBDOMADAIRE</h1>

    <?php if ($planning_saved) : ?>
        <div class="erreur" style="background:#d1fae5;color:#065f46;">
            ✅ Planning sauvegardé avec succès.
        </div>
    <?php endif; ?>

    <?php if (empty($planning)) : ?>
        <div class="erreur">
            Aucun planning généré.
        </div>
    <?php else : ?>
        <?php afficher_planning_html($planning); ?>
    <?php endif; ?>

    <div class="card-container">

        <a href="pages/salles.php" class="card">
            Gestion des salles
        </a>

        <a href="pages/promotions.php" class="card">
            Gestion des promotions
        </a>

        <a href="pages/cours.php" class="card">
            Gestion des cours
        </a>

        <a href="pages/options.php" class="card">
            Gestion des options
        </a>

        <a href="pages/planning.php" class="card">
            Voir le planning
        </a>

    </div>

</div>

<?php include "templates/footer.php"; ?>
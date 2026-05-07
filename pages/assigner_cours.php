<?php
require_once "../includes/fonctions_chargement.php";
require_once "../includes/fonctions_planning.php";
require_once "../includes/fonction_affichage.php";

include "../templates/header.php";
include "../templates/menu.php";

$salles = charger_salles("../data/salles.txt");
$promotions = charger_promotions("../data/promotions.txt");
$cours = charger_cours("../data/cours.txt");
$options = charger_options("../data/options.txt");
$creneaux = [
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
    $creneaux
);
?>

<div class="content">

    <h1>Assigner un cours</h1>

    <p>Cette page montre actuellement le planning généré automatiquement. La fonction d'assignation manuelle peut être ajoutée ensuite.</p>

    <?php if (empty($planning)) : ?>
        <div class="erreur">
            Aucun planning généré.
        </div>
    <?php else : ?>
        <?php afficher_planning_html($planning); ?>
    <?php endif; ?>

</div>

<?php include "../templates/footer.php"; ?>
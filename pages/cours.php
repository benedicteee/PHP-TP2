<?php
require_once "../includes/fonctions_chargement.php";

include "../templates/header.php";
include "../templates/menu.php";
?>

<div class="content">

    <h1>Gestion des cours</h1>

    <div class="card-container">

        <a href="../formulaires/ajouter_cours.php" class="card">
            ➕ Ajouter un cours
        </a>

        <a href="liste_cours.php" class="card">
            📚 Liste des cours
        </a>

        <a href="assigner_cours.php" class="card">
            🎓 Assigner un cours
        </a>

    </div>

</div>

<?php include "../templates/footer.php"; ?>
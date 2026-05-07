<?php

require_once "../includes/fonctions_chargement.php";

include "../templates/header.php";
include "../templates/menu.php";

$salles = charger_salles("../data/salles.txt");

?>

<div class="content">

<h1>Liste des salles</h1>

<div class="card-container">
    <a href="../formulaires/ajouter_salle.php" class="card">
        ➕ Ajouter une salle
    </a>
</div>

<?php

if (empty($salles)) {

    echo "<div class='erreur'>
            Aucune salle trouvée.
          </div>";
}
else {

?>

<table>

<tr>
    <th>ID</th>
    <th>Désignation</th>
    <th>Capacité</th>
</tr>

<?php foreach ($salles as $salle) { ?>

<tr>

    <td><?= $salle["id"] ?></td>

    <td><?= $salle["designation"] ?></td>

    <td><?= $salle["capacite"] ?></td>

</tr>

<?php } ?>

</table>

<?php } ?>

</div>

<?php include "../templates/footer.php"; ?>
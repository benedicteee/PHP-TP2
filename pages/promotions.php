<?php

require_once "../includes/fonctions_chargement.php";

include "../templates/header.php";
include "../templates/menu.php";

$promotions =
charger_promotions("../data/promotions.txt");

?>

<div class="content">

<h1>Liste des promotions</h1>

<div class="card-container">
    <a href="../formulaires/ajouter_promotion.php" class="card">
        ➕ Ajouter une promotion
    </a>
</div>

<?php

if (empty($promotions)) {

    echo "<div class='erreur'>
            Aucune promotion trouvée.
          </div>";
}
else {

?>

<table>

<tr>
    <th>ID</th>
    <th>Libellé</th>
    <th>Effectif</th>
</tr>

<?php foreach ($promotions as $promo) { ?>

<tr>

<td><?= $promo["id"] ?></td>

<td><?= $promo["libelle"] ?></td>

<td><?= $promo["effectif"] ?></td>

</tr>

<?php } ?>

</table>

<?php } ?>

</div>

<?php include "../templates/footer.php"; ?>
<?php
require_once "../includes/fonctions_chargement.php";

include "../templates/header.php";
include "../templates/menu.php";

$cours = charger_cours("../data/cours.txt");
?>

<div class="content">

    <h1>Liste des cours</h1>

    <?php if (empty($cours)) : ?>
        <div class="erreur">
            Aucun cours trouvé.
        </div>
    <?php else : ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Intitulé</th>
                <th>Volume</th>
                <th>Type</th>
                <th>Promotion</th>
            </tr>
            <?php foreach ($cours as $item) : ?>
                <tr>
                    <td><?= htmlspecialchars($item["id"]) ?></td>
                    <td><?= htmlspecialchars($item["intitule"]) ?></td>
                    <td><?= htmlspecialchars($item["volume"]) ?></td>
                    <td><?= htmlspecialchars($item["type"]) ?></td>
                    <td><?= htmlspecialchars($item["promotion"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

</div>

<?php include "../templates/footer.php"; ?>
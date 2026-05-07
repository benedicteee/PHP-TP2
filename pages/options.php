<?php
require_once "../includes/fonctions_chargement.php";
$options = charger_options("../data/options.txt");
?>

<?php include "../templates/header.php"; ?>
<?php include "../templates/menu.php"; ?>

<div class="content">

    <h1>Gestion des options</h1>

    <div class="card-container">

        <a href="../formulaires/ajouter_option.php" class="card">
            ➕ Ajouter une option
        </a>

    </div>

    <?php if (empty($options)) : ?>
        <div class="erreur">
            Aucune option trouvée.
        </div>
    <?php else : ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Libellé</th>
                <th>Promotion</th>
                <th>Effectif</th>
            </tr>
            <?php foreach ($options as $option) : ?>
                <tr>
                    <td><?= htmlspecialchars($option["id"]) ?></td>
                    <td><?= htmlspecialchars($option["libelle"]) ?></td>
                    <td><?= htmlspecialchars($option["promotion"]) ?></td>
                    <td><?= htmlspecialchars($option["effectif"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

</div>

<?php include "../templates/footer.php"; ?>
<?php include "../templates/header.php"; ?>
<?php include "../templates/menu.php"; ?>

<div class="content">

    <h1>Ajouter une promotion</h1>

    <form action="ajouter_promotion.php" method="POST" class="form">

        <div>
            <label for="nom_promotion">Nom de la promotion</label>
            <input type="text" id="nom_promotion" name="nom_promotion" required>
        </div>

        <div>
            <label for="annee">Année académique</label>
            <input type="text" id="annee" name="annee" placeholder="2025-2026" required>
        </div>

        <button type="submit">Enregistrer</button>

    </form>

</div>

<?php include "../templates/footer.php"; ?>
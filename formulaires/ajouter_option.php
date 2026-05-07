<?php include "../templates/header.php"; ?>
<?php include "../templates/menu.php"; ?>

<div class="content">

    <h1>Ajouter une option</h1>

    <form method="POST" class="form">

        <div>
            <label for="nom_option">Nom de l'option</label>
            <input type="text" id="nom_option" name="nom_option" required>
        </div>

        <div>
            <label for="description">Description</label>
            <input type="text" id="description" name="description">
        </div>

        <button type="submit">Enregistrer</button>

    </form>

</div>

<?php include "../templates/footer.php"; ?>
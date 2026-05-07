<?php include "../templates/header.php"; ?>
<?php include "../templates/menu.php"; ?>

<div class="content">

    <h1>Ajouter une salle</h1>

    <form action="ajouter_salle.php" method="POST" class="form">

        <div>
            <label for="nom_salle">Nom de la salle</label>
            <input type="text" id="nom_salle" name="nom_salle" required>
        </div>

        <div>
            <label for="capacite">Capacité</label>
            <input type="number" id="capacite" name="capacite" required>
        </div>

        <div>
            <label for="localisation">Localisation</label>
            <input type="text" id="localisation" name="localisation" required>
        </div>

        <button type="submit">Enregistrer</button>

    </form>

</div>

<?php include "../templates/footer.php"; ?>
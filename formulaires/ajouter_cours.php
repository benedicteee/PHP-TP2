<?php include "../templates/header.php"; ?>
<?php include "../templates/menu.php"; ?>

<div class="content">

    <h1>Ajouter un cours</h1>

    <form action="ajouter_cours.php" method="POST" class="form">

        <div>
            <label for="nom_cours">Nom du cours</label>
            <input type="text" id="nom_cours" name="nom_cours" required>
        </div>

        <div>
            <label for="code_cours">Code du cours</label>
            <input type="text" id="code_cours" name="code_cours" required>
        </div>

        <div>
            <label for="heures">Nombre d'heures</label>
            <input type="number" id="heures" name="heures" required>
        </div>

        <button type="submit">Enregistrer</button>

    </form>

</div>

<?php include "../templates/footer.php"; ?>
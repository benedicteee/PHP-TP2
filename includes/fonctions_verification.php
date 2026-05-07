<?php

////////////////////////////////////////////////////////////

// ✅ Vérifie si une salle est libre à un créneau donné
function salle_disponible($planning, $id_salle, $creneau) {

    foreach ($planning as $affectation) {

        if (
            $affectation["salle"] == $id_salle &&
            $affectation["creneau"] == $creneau
        ) {
            return false;
        }
    }

    return true;
}

////////////////////////////////////////////////////////////

// ✅ Vérifie si la capacité de la salle est suffisante
function capacite_suffisante($salles, $id_salle, $effectif) {

    foreach ($salles as $salle) {

        if ($salle["id"] == $id_salle) {

            if ($effectif <= $salle["capacite"]) {
                return true;
            } else {
                return false;
            }
        }
    }

    return false;
}

////////////////////////////////////////////////////////////

// ✅ Vérifie si le groupe est libre au créneau
function creneau_libre_groupe($planning, $id_groupe, $creneau) {

    foreach ($planning as $affectation) {

        if (
            $affectation["groupe"] == $id_groupe &&
            $affectation["creneau"] == $creneau
        ) {
            return false;
        }
    }

    return true;
}

?>
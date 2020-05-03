<?php
/**
 * Vue qui permet d'afficher la liste déroulantes des utilisateur ainsi que la liste déroulante des mois
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Théo Gaillard
 */

?>
<div class="row">
    <div class="col-md-4">
        <form action="index.php?uc=validerUnFrais&action=afficherFicheFrais" id="formVisiteur" method="post" role="form">
            <div class="form-group">
                <label for="lstVisiteurs" accesskey="n">Visiteur : </label>
                <select id="lstVisiteurs" name="lstVisiteurs" class="form-control">
                    <?php
                    foreach ($lesVisiteurs as $unVisiteur) {
                        if ($unVisiteur == $visiteurASelectionner) {
                    ?>
                            <option selected value="<?php echo $unVisiteur['id'] ?>">
                                <?php echo $unVisiteur['nom'] . ' ' . $unVisiteur['prenom'] ?> </option>
                        <?php
                        } else {
                        ?>
                            <option value="<?php echo $unVisiteur['id'] ?>">
                                <?php echo $unVisiteur['nom'] . ' ' . $unVisiteur['prenom'] ?> </option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="lstMois" accesskey="n">Mois : </label>
                <select id="lstMois" name="lstMois" class="form-control">
                    <?php
                    foreach ($lesMois as $unMois) {
                        if ($unMois['mois'] == $moisASelectionner) {
                    ?>
                            <option selected value="<?php echo $unMois['mois'] ?>">
                                <?php echo $unMois['numMois'] . '/' . $unMois['numAnnee'] ?> </option>
                        <?php
                        } else {
                        ?>
                            <option value="<?php echo $unMois['mois'] ?>">
                                <?php echo $unMois['numMois'] . '/' . $unMois['numAnnee'] ?> </option>
                    <?php
                        }
                    }
                    ?>

                </select>
            </div>

            <input id="ok" type="submit" value="Valider" class="btn btn-success" role="button">
        </form>
    </div>
</div>
<?php
/**
 * Vue Liste des frais au forfait
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @author    Th�o Gaillard
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
?>
<?php if (!empty($lesFraisHorsForfait) && $lesFraisForfait != null) { ?>
<div class="row">
	<h2>
	<?php if ($comptableConnecter) {?>
		<?php echo $numMois . '-' . $numAnnee . "- (" . $libEtat . ")" ?>
	<?php } elseif($viisiteurConnecter) {?>
		Renseigner ma fiche de frais du mois <?php echo $numMois . '-' . $numAnnee ?> 
	<?php } ?>
    </h2>
    <h3>Eléments forfaitisés</h3>
    <div class="col-md-4">
    <?php if ($comptableConnecter) {?>
    	 <form method="post" action="index.php?uc=validerUnFrais&action=corrigerUnFrais" role="form" onchange="document.getElementById('btnModifierFraisForfaitaire').disabled = false;">
    <?php } elseif($viisiteurConnecter) {?>
    	 <form method="post" action="index.php?uc=gererFrais&action=validerMajFraisForfait" role="form">
    <?php } ?>
            <fieldset>       
                <?php
                foreach ($lesFraisForfait as $unFrais) {
                    $idFrais = $unFrais['idfrais'];
                    $libelle = htmlspecialchars($unFrais['libelle']);
                    $quantite = $unFrais['quantite']; ?>
                    <div class="form-group">
                        <label for="idFrais"><?php echo $libelle ?></label>
                        <input type="text" id="idFrais" 
                               name="lesFrais[<?php echo $idFrais ?>]"
                               size="10" maxlength="5" 
                               value="<?php echo $quantite ?>" 
                               class="form-control">
                    </div>
                    <?php } ?>
                 <?php if ($comptableConnecter) {?>
                 	<input type="hidden" id="mois" name="mois" value="<?php echo $moisASelectionner ?>">
                 	<input type="hidden" id="leVisiteur" name="visiteur" value="<?php echo $idVisiteur ?>">
                 	<button class="btn btn-success" type="submit" id="btnModifierFraisForfaitaire" disabled onclick="if(confirm('/!\\ Attention cette action est irr�versible !\nVoulez-vous appliquer les modifications ?')){}else{return false;};">Modifier Frais</button>
                 	<button class="btn btn-danger" type="reset" onclick="alert('Remise a zero du formulaire, les changements sont perdus !');">Effacer Frais</button>
                 <?php } elseif($viisiteurConnecter) {?>
                 	<button class="btn btn-success" type="submit">Ajouter</button>
                	<button class="btn btn-danger" type="reset">Effacer</button>
                 <?php } ?>
                
            </fieldset>
        </form>
    </div>
</div>
<?php } else { ?><h2>Aucun frais forfaitaire pour ce visiteur !</h2><?php } ?>

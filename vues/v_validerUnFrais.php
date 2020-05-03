<?php
/**
 * Vue qui permet de valider une Fiche de Frais
 * @author   Théo Gaillard
 */
?>
<div class="row margin-bottom-50">
<?php if (isset($nbJustificatifs)) {?>
<div class="col-md-4">
	<span>Nombre de Justificatifs :</span>
	<form method="post" action="index.php?uc=validerUnFrais&action=ajouterJustificatif" role="form">
		<fieldset>
			<input type="hidden" id="visiteur" name="visiteur" value="<?php echo $idVisiteur ?>">
			<input type="hidden" id="mois" name="mois" value="<?php echo $leMois ?>">
			<div class="form-group">
				<input type="text" id="idJustificatif" name="justificatifNb" size="1" maxlength="3"  value="<?php echo $nbJustificatif ?>" class="form-control" onchange="document.getElementById('btnModifierJustificatif').disabled = false;">
			</div>
			<button class="btn btn-success" type="submit" id="btnModifierJustificatif" disabled onclick="if(confirm('/!\\ Attention cette action est irréversible !\nVoulez-vous appliquer les modifications ?')){}else{return false;};">Modifier Nombre de justificatif</button>
            <button class="btn btn-danger" type="reset" onclick="alert('Remise a zero du formulaire, les changements sont perdus !');">Reset</button>
		</fieldset>
	</form>
</div>
<?php }?>
</div>
<div class="row margin-bottom-50">
	<?php
	if (isset($lesInfosFicheFrais['idEtat'])) {
		if ($lesInfosFicheFrais['idEtat'] != 'VA') { ?>
			<h3 class="text-center">Vérifier que toutes les corrections ont bien été réaliser avant de valider</h3>
			<form method="post" action="index.php?uc=validerUnFrais&action=validerUnFrais" role="form">
				<fieldset>
					<input type="hidden" id="visiteur" name="visiteur" value="<?php echo $idVisiteur ?>">
					<input type="hidden" id="mois" name="mois" value="<?php echo $leMois ?>">
					<div class="col-md-12 text-center"> 
					<button id="validerUneFicheDeFrais" class="btn btn-success btn-lg btn-block" type="submit" onclick="if(confirm('/!\\ Attention cette action est irréversible !\nVoulez-vous valider cette fiche de frais ?')){return true;}else{return false;};">
						Valider les fiches de frais Hors Forfait(s)
					</button>
					</div>
				</fieldset>
			</form>
		<?php } else { ?>
			<h3 class="text-center">Fiche de frais déja validée</h3>
	<?php }
	} ?>
</div>
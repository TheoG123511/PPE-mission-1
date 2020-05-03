<?php

/**
 * Vue permettant de suivre les payement des fiches de frais, cela permet d'avoir une liste contenant la liste des fiches de frais qui sont validé
 * @author  Théo Gaillard
 */
?>
<div class="row">
	<?php foreach ($infoFicheDeFrais as $infoFiche) { ?>
		<div class="col-md-12">
			<div class="panel panel-primary-orange">
				<div class="panel-heading">
					<h3 class="panel-title">
						<?php echo $infoFiche['visiteur']['nom'] ." ". $infoFiche['visiteur']['prenom'] ." - ".$infoFiche['mois']['numMois'].$infoFiche['mois']['numAnnee']?>
						(<?php echo $infoFiche['infoFiche']['libEtat'] ?>)
					</h3>
				</div>
				<div class="panel-body">
					<div class="row">
					<form method="post" action="index.php?uc=suivreUnPaiement&action=payerFrais" role="form">
						<table class="table table-bordered-orange table-responsive">
							<thead>
								<tr>
									<th class="date">Forfaits</th>
									<th class="libelle">Hors forfait</th>
									<th class="montant">Total</th>
									<th class="action">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
									<input type="hidden" id="visiteur" name="visiteur" value="<?php echo $infoFiche['visiteur']['id'] ?>">
									<input type="hidden" id="mois" name="mois" value="<?php echo $infoFiche['mois']['mois'] ?>">
									<tr>
										<td><?php echo $infoFiche['totalForfait'] ?> &euro;</td>
										<td><?php echo $infoFiche['totalHorsForfait'] ?> &euro;</td>
										<td><?php echo ($infoFiche['totalForfait'] + $infoFiche['totalHorsForfait']) ?> &euro;</td>
										<?php if ($infoFiche['infoFiche']['idEtat'] == "VA") { ?>
											<td>
												<button class="btn btn-success" type="submit" onclick="if(confirm('Voulez-vous mettre en paiement cette fiche de frais ?')){return true;}else{return false;};">
													Mettre en paiement la fiche de frais</button>
											</td>
										<?php } else if ($infoFiche['infoFiche']['idEtat'] == "MP") { ?>
											<td>
												<button class="btn btn-success" type="submit" onclick="if(confirm('La fiche de frais est-elle rembourser ?')){return true;}else{return false;};">
													Fiche Remboursée</button>
											</td>
										<?php } ?>
									</tr>
							</tbody>
						</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
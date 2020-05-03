<?php
/**
 * Vue Liste des frais hors forfait
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
<?php if (!empty($lesFraisHorsForfait) && $lesFraisHorsForfait != null) {?>
<hr>
<div class="row">
	<?php if ($comptableConnecter) { ?>
		<div class="panel panel-info-orange">
	<?php } else {?>
		<div class="panel panel-info">
	<?php }?>
    
        <div class="panel-heading">Descriptif des éléments hors forfait</div>
        <?php if ($comptableConnecter) { ?>
			<table class="table table-bordered-orange table-responsive">
    	<?php } else {?>
    		<table class="table table-bordered table-responsive">
    	<?php }?>
        
            <thead>
                <tr>
            
                    <th class="date">Date</th>
                    <th class="libelle">Libellé</th>  
                    <th class="montant">Montant</th>  
                    <th class="action">&nbsp;</th>
                 <?php if ($comptableConnecter) {?>
                 	 <th class="action">&nbsp;</th>
                <?php } ?>
                </tr>
            </thead>  
            <tbody>
            <?php
            foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                $date = $unFraisHorsForfait['date'];
                $montant = $unFraisHorsForfait['montant'];
                $id = $unFraisHorsForfait['id']; ?>           
                <tr>
                <?php if ($comptableConnecter) {?>
                          <form id="formCorrFraisHF[<?php echo $id ?>]" method="post" action="index.php?uc=validerUnFrais&action=corrigerUnFraisHF" role="form">
                                    <input type="hidden" id="idFraisHF" name="idFraisHF" value="<?php echo $id ?>">
                                    <input type="hidden" id="visiteur" name="visiteur" value="<?php echo $idVisiteur ?>">
                                    <input type="hidden" id="mois" name="mois" value="<?php echo $moisASelectionner ?>">
                                    <td>
                                    <input type="text" id="dateHF[<?php echo $id ?>]" name="dateHF" value="<?php echo $date ?>" 
                                    onchange="document.getElementById('corrFraisHF[<?php echo $id ?>]').disabled = false;document.getElementById('validerUneFicheDeFrais').disabled = 'true';">
                                    </td>
                                    <td>
                                    <input type="text" id="libHF[<?php echo $id ?>]" name="libHF" value="<?php echo $libelle ?>" 
                                    onchange="document.getElementById('corrFraisHF[<?php echo $id ?>]').disabled = false;document.getElementById('validerUneFicheDeFrais').disabled = 'true';">
                                    </td>
                                    <td>
                                    <input type="text" id="montantHF[<?php echo $id ?>]" name="montantHF" value="<?php echo $montant ?>" 
                                    onchange="document.getElementById('corrFraisHF[<?php echo $id ?>]').disabled = false;document.getElementById('validerUneFicheDeFrais').disabled = 'true';">
                                    </td>
                                    <td>
                                    <button id="corrFraisHF[<?php echo $id ?>]" class="btn btn-success" type="submit" disabled>Corriger</button>
                                    </td>
                                    <td>
                                    <button class="btn btn-danger" type="reset" onclick="">Reinitialiser</button>
                                    </td>
                                </form>      
                 <?php } elseif($viisiteurConnecter) {?>
                 	<td> <?php echo $date ?></td>
                    <td> <?php echo $libelle ?></td>
                    <td><?php echo $montant ?></td>
                    <td><a href="index.php?uc=gererFrais&action=supprimerFrais&idFrais=<?php echo $id ?>" 
                           onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Supprimer ce frais</a></td>
                 <?php }?>
                </tr>
                <?php
                 }
            ?>
            </tbody>  
        </table>
    </div>
</div>
<?php } else { ?><h2>Aucun frais Hors forfait pour ce visiteur !</h2><?php } ?>
<?php if($viisiteurConnecter) { ?>
<div class="row">
    <h3>Nouvel élément hors forfait</h3>
    <div class="col-md-4">
        <form action="index.php?uc=gererFrais&action=validerCreationFrais" 
              method="post" role="form">
            <div class="form-group">
                <label for="txtDateHF">Date (jj/mm/aaaa): </label>
                <input type="text" id="txtDateHF" name="dateFrais" 
                       class="form-control" id="text">
            </div>
            <div class="form-group">
                <label for="txtLibelleHF">Libellé</label>             
                <input type="text" id="txtLibelleHF" name="libelle" 
                       class="form-control" id="text">
            </div> 
            <div class="form-group">
                <label for="txtMontantHF">Montant : </label>
                <div class="input-group">
                    <span class="input-group-addon">€</span>
                    <input type="text" id="txtMontantHF" name="montant" 
                           class="form-control" value="">
                </div>
            </div>
            <button class="btn btn-success" type="submit">Ajouter</button>
            <button class="btn btn-danger" type="reset">Effacer</button>
        </form>
    </div>
</div>
<?php } ?>
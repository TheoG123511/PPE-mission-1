<?php

/**
 * Controleur pour gérer la Validation des Frais
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Théo Gaillard
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

switch ($action) {
           
    case 'afficheTousLesFrais':
        
        $infoFicheDeFrais = array();
        // On récupère la liste de tout les visiteurs
        $allVisiteurs = $pdo->getAllVisiteurs();
        // récupération du montant de tout les Frais existant
        $allMontantFrais = $pdo->getAllMontantFrais();
        
        foreach ($allVisiteurs as $unVisiteur) {
            
            $lesMois = $pdo->getLesMoisDisponibles($unVisiteur['id']);
            
            foreach ($lesMois as $unMois) {
                
                $allInfosAboutFicheFrais = $pdo->getLesInfosFicheFrais($unVisiteur['id'], $unMois['mois']);
                
                if ($allInfosAboutFicheFrais['idEtat'] == "VA" || $allInfosAboutFicheFrais['idEtat'] == "MP") {
                    // on remet a zero c'est deux variable
                    $totalForfait = 0;
                    $totalFraisHorsForfait = 0;
                    // on récupere les frais (frais hors forfait ou forfaitaire) concernant un visiteur
                    $infoHorsForfait = $pdo->getLesFraisHorsForfait($unVisiteur['id'], $unMois['mois']);
                    $infoForfait = $pdo->getLesFraisForfait($unVisiteur['id'], $unMois['mois']);
                    
                    // On additionne tous les frais hors forfait
                    foreach ($infoHorsForfait as $fraisHorsForfait) { 
                        $totalFraisHorsForfait += $fraisHorsForfait['montant'];
                    }
                    
                    foreach ($infoForfait as $fraisForfait) { 
                        foreach ($allMontantFrais as $unMontantFrais) {
                            if ($fraisForfait['idfrais'] == $unMontantFrais['idfrais']) {
                                $totalForfait += ($fraisForfait['quantite'] * $unMontantFrais['montantfrais']);
                            }
                        }
                    }
                    
                    array_push($infoFicheDeFrais,
                               array('mois' => $unMois,
                                     'visiteur' => $unVisiteur,
                                     'infoFiche' => $allInfosAboutFicheFrais,
                                     'totalHorsForfait' => $totalFraisHorsForfait,
                                     'totalForfait' => $totalForfait));
                }
                
            }
        }
        
        include 'vues/v_suivreLesFrais.php';
        break;
        
    case 'payerFrais':
        
        $idVisiteurChoisi = filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_STRING);
        $unMois = filter_input(INPUT_POST, 'mois', FILTER_SANITIZE_STRING);

        $etatActuel = $pdo->getLesInfosFicheFrais($idVisiteurChoisi, $unMois)['idEtat'];
        
        if ($etatActuel == 'MP') {
            $pdo->majEtatFicheFrais($idVisiteurChoisi, $unMois, 'RB');
        } else if ($etatActuel == 'VA') {
            $pdo->majEtatFicheFrais($idVisiteurChoisi, $unMois, 'MP');
        }
        
        $infoFicheDeFrais = array();
        // On récupère la liste de tout les visiteurs
        $allVisiteurs = $pdo->getAllVisiteurs();
        // récupération du montant de tout les Frais existant
        $allMontantFrais = $pdo->getAllMontantFrais();
        
        foreach ($allVisiteurs as $unVisiteur) {
            
            $lesMois = $pdo->getLesMoisDisponibles($unVisiteur['id']);
            
            foreach ($lesMois as $unMois) {
                
                $allInfosAboutFicheFrais = $pdo->getLesInfosFicheFrais($unVisiteur['id'], $unMois['mois']);
                
                if ($allInfosAboutFicheFrais['idEtat'] == "VA" || $allInfosAboutFicheFrais['idEtat'] == "MP") {
                    // on remet a zero c'est deux variable
                    $totalForfait = 0;
                    $totalFraisHorsForfait = 0;
                    // on récupere les frais (frais hors forfait ou forfaitaire) concernant un visiteur
                    $infoHorsForfait = $pdo->getLesFraisHorsForfait($unVisiteur['id'], $unMois['mois']);
                    $infoForfait = $pdo->getLesFraisForfait($unVisiteur['id'], $unMois['mois']);
                    
                    // On additionne tous les frais hors forfait
                    foreach ($infoHorsForfait as $fraisHorsForfait) {
                        $totalFraisHorsForfait += $fraisHorsForfait['montant'];
                    }
                    
                    foreach ($infoForfait as $fraisForfait) {
                        foreach ($allMontantFrais as $unMontantFrais) {
                            if ($fraisForfait['idfrais'] == $unMontantFrais['idfrais']) {
                                $totalForfait += ($fraisForfait['quantite'] * $unMontantFrais['montantfrais']);
                            }
                        }
                    }
                    
                    array_push($infoFicheDeFrais,
                        array('mois' => $unMois,
                            'visiteur' => $unVisiteur,
                            'infoFiche' => $allInfosAboutFicheFrais,
                            'totalHorsForfait' => $totalFraisHorsForfait,
                            'totalForfait' => $totalForfait));
                }
                
            }
        }
        
        include 'vues/v_suivreLesFrais.php';
        break;
}



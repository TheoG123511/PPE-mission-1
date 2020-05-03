<?php
/**
 * Controleur qui permet de Valider un Frais
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Théo Gaillard
 * @version   GIT: <0>
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

switch ($action) {
    
    case 'selectionnerVetM':
        
        $lesVisiteurs = $pdo->getAllVisiteurs();
        $visiteurASelectionner = array_keys($lesVisiteurs)[0];
        $lesMois = getAllMois(getMois(date('d/m/Y')));
        $moisASelectionner = array_keys($lesMois)[0];
        include  'vues/v_listeAllUtilisateur.php';
        break;
        
    case 'afficherFicheFrais':
        
        // recuperation des valeurs du formulaire
        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        // recuperation des donnees correspondant a l'utilisateur choisi
        $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
        // recuperation de la liste de tous les visiteurs
        $lesVisiteurs = $pdo->getAllVisiteurs(); 
        // recuperation des info concernant l'utilisateur selectionner
        $leVisiteur = $pdo->getInfoVisiteur($idVisiteur);
        //Verification si il y a bien un retour sur la fonction getLesMoisDisponibles($idVisiteurChoisi)
        $listeMoisString = array();
        if(count($lesMois) > 0){
            foreach ($lesMois as $unMois){
                array_push($listeMoisString,
                           $unMois['mois']);
            }
           
        } else{
            $leMois = null;
        }
        if(($leMois == null || !in_array($leMois, $listeMoisString)) && count($lesMois) > 0){ 
            $leMois = $lesMois[array_keys($lesMois)[0]]['mois'];
        }
        
        $moisASelectionner = $leMois;
        $visiteurASelectionner = $leVisiteur;

        // initialisation des variable a null
        $lesFraisHorsForfait = null;
        $lesFraisForfait = null;
        $lesInfosFicheFrais = null;
        
        //Si il y a bien un mois selectionné, on récupere les valeurs pour les afficher ensuite dans la vue
        if($moisASelectionner != null){
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $moisASelectionner);
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $moisASelectionner);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $moisASelectionner);
            $numAnnee = substr($moisASelectionner, 0, 4);
            $numMois = substr($moisASelectionner, 4, 2);
            $nbJustificatif = $lesInfosFicheFrais["nbJustificatifs"];
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
        }
        // envoie des donnes aux vues
        include 'vues/v_listeAllUtilisateur.php';
        include 'vues/v_listeFraisForfait.php';
        include 'vues/v_listeFraisHorsForfait.php';
        include 'vues/v_validerUnFrais.php'; 
        break;
    
    case 'corrigerUnFrais':
        // verification si la requete est de type post (comme sa si on recharge l'url en get aucune erreur)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // recuperation des valeurs du formulaire
        $idVisiteur = filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_STRING);
        $leMois = filter_input(INPUT_POST, 'mois', FILTER_SANITIZE_STRING);
        $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        
        
        if (lesQteFraisValides($lesFrais)) {
            $pdo->majFraisForfait($idVisiteur, $leMois, $lesFrais);
                           
            // recuperation des donnees correspondant a l'utilisateur choisi
            $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
            // recuperation de la liste de tous les visiteurs
            $lesVisiteurs = $pdo->getAllVisiteurs();
            // recuperation des info concernant l'utilisateur selectionner
            $leVisiteur = $pdo->getInfoVisiteur($idVisiteur);
            //Verification si il y a bien un retour sur la fonction getLesMoisDisponibles($idVisiteurChoisi)
            $listeMoisString = array();
            if(count($lesMois) > 0){
                foreach ($lesMois as $unMois){
                    array_push($listeMoisString,
                        $unMois['mois']);
                }
                
            } else{
                $leMois = null;
            }
            if(($leMois == null || !in_array($leMois, $listeMoisString)) && count($lesMois) > 0){
                $leMois = $lesMois[array_keys($lesMois)[0]]['mois'];
            }
            
            $moisASelectionner = $leMois;
            $visiteurASelectionner = $leVisiteur;
            include 'vues/v_listeAllUtilisateur.php';
            
            // initialisation des variable a null
            $lesFraisHorsForfait = null;
            $lesFraisForfait = null;
            $lesInfosFicheFrais = null;
            
            //Si il y a bien un mois selectionné, on récupere les valeurs pour les afficher ensuite dans la vue
            if($moisASelectionner != null){
                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $moisASelectionner);
                $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $moisASelectionner);
                $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $moisASelectionner);
                $numAnnee = substr($moisASelectionner, 0, 4);
                $numMois = substr($moisASelectionner, 4, 2);
                $nbJustificatif = $lesInfosFicheFrais["nbJustificatifs"];
                $libEtat = $lesInfosFicheFrais['libEtat'];
                $montantValide = $lesInfosFicheFrais['montantValide'];
                $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
                $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
                // envoie des donnes aux vues
                include 'vues/v_listeFraisForfait.php';
                include 'vues/v_listeFraisHorsForfait.php';
                include 'vues/v_validerUnFrais.php'; 
            }
            
        } else {
            ajouterErreur('Les valeurs des frais ne sont pas de type numériques');
            include 'vues/v_erreurs.php';
        }
        } else {
            $lesVisiteurs = $pdo->getAllVisiteurs();
            $visiteurASelectionner = array_keys($lesVisiteurs)[0];
            $lesMois = getAllMois(getMois(date('d/m/Y')));
            $moisASelectionner = array_keys($lesMois)[0];
            include  'vues/v_listeAllUtilisateur.php';
        }
        break;
        
        
    case 'corrigerUnFraisHF':
        
        // recuperation des valeurs du formulaire
        $idFraisHorsForfait = filter_input(INPUT_POST, 'idFraisHF', FILTER_SANITIZE_STRING);
        $dateFraisHorsForfait = filter_input(INPUT_POST, 'dateHF', FILTER_SANITIZE_STRING);
        $libFraisHorsForfait = filter_input(INPUT_POST, 'libHF', FILTER_SANITIZE_STRING);
        $montantFraisHorsForfait = filter_input(INPUT_POST, 'montantHF', FILTER_SANITIZE_STRING);
        $idVisiteur = filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_STRING);
        $leMois = filter_input(INPUT_POST, 'mois', FILTER_SANITIZE_STRING);
        $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        
        // on limite la chaine a max 100 caractère
        $libFraisHorsForfait = substr($libFraisHorsForfait,0,99); 
       
       // on verifie que toutes les donnees sont au bon format avant de modifier dans la base de données
        valideInfosFrais($dateFraisHorsForfait, $libFraisHorsForfait, $montantFraisHorsForfait);
        
        // si il y a des erreur on les affiche sinon on mes a jours
        if (nbErreurs() != 0) { 
            include 'vues/v_erreurs.php';
        } else {
            $pdo->majFraisHf($idFraisHorsForfait, $libFraisHorsForfait, $dateFraisHorsForfait, $montantFraisHorsForfait);
        }
        
        
        $lesVisiteurs = $pdo->getAllVisiteurs();
        $leVisiteur = $pdo->getInfoVisiteur($idVisiteur);
        $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
        
        $visiteurASelectionner = $leVisiteur;
        $moisASelectionner = $leMois;
        
        
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
        
        $numAnnee = substr($leMois, 0, 4);
        $numMois = substr($leMois, 4, 2);
        $libEtat = $lesInfosFicheFrais['libEtat'];
        $montantValide = $lesInfosFicheFrais['montantValide'];
        $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
        $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
        
        include 'vues/v_listeAllUtilisateur.php';
        include 'vues/v_listeFraisForfait.php';
        include 'vues/v_listeFraisHorsForfait.php';
        include 'vues/v_validerUnFrais.php'; 
        break;
        
    case 'validerUnFrais':
        
        // recuperation des valeurs du formulaire
        $idVisiteur = filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_STRING);
        $leMois = filter_input(INPUT_POST, 'mois', FILTER_SANITIZE_STRING);
        // mis a jour de l'etat de la fiche de frais
        $pdo->majEtatFicheFrais($idVisiteur, $leMois, 'VA');
        // recuperation de la liste de tous les visiteurs
        $lesVisiteurs = $pdo->getAllVisiteurs(); 
        $visiteurASelectionner = $lesVisiteurs[0]; 
        $moisASelectionner = array_keys($pdo->getLesMoisDisponibles($visiteurASelectionner['id']))[0];
        
        include 'vues/v_listeAllUtilisateur.php';
        break;
        
    case 'ajouterJustificatif':
        // recuperation des valeurs du formulaire
        $idVisiteur = filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_STRING);
        $leMois = filter_input(INPUT_POST, 'mois', FILTER_SANITIZE_STRING);
        $nbJustif = filter_input(INPUT_POST, 'justificatifNb', FILTER_SANITIZE_STRING);
        // on modifie le nombre de justificatif
        $pdo->majNbJustificatifs($idVisiteur, $leMois, $nbJustif);
        // recuperation des donnees correspondant a l'utilisateur choisi
        $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
        // recuperation de la liste de tous les visiteurs
        $lesVisiteurs = $pdo->getAllVisiteurs();
        // recuperation des info concernant l'utilisateur selectionner
        $leVisiteur = $pdo->getInfoVisiteur($idVisiteur);
        //Verification si il y a bien un retour sur la fonction getLesMoisDisponibles($idVisiteurChoisi)
        $listeMoisString = array();
        if(count($lesMois) > 0){
            foreach ($lesMois as $unMois){
                array_push($listeMoisString,
                    $unMois['mois']);
            }
            
        } else{
            $leMois = null;
        }
        if(($leMois == null || !in_array($leMois, $listeMoisString)) && count($lesMois) > 0){
            $leMois = $lesMois[array_keys($lesMois)[0]]['mois'];
        }
        
        $moisASelectionner = $leMois;
        $visiteurASelectionner = $leVisiteur;
        
        // initialisation des variable a null
        $lesFraisHorsForfait = null;
        $lesFraisForfait = null;
        $lesInfosFicheFrais = null;
        
        //Si il y a bien un mois selectionné, on récupere les valeurs pour les afficher ensuite dans la vue
        if($moisASelectionner != null){
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $moisASelectionner);
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $moisASelectionner);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $moisASelectionner);
            $numAnnee = substr($moisASelectionner, 0, 4);
            $numMois = substr($moisASelectionner, 4, 2);
            $nbJustificatif = $lesInfosFicheFrais["nbJustificatifs"];
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
        }
        // envoie des donnes aux vues
        include 'vues/v_listeAllUtilisateur.php';
        include 'vues/v_listeFraisForfait.php';
        include 'vues/v_listeFraisHorsForfait.php';
        include 'vues/v_validerUnFrais.php';
        break;
                
}
<?php
/**
 * Gestion de la connexion
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    R�seau CERTA <contact@reseaucerta.org>
 * @author    Jos� GIL <jgil@ac-nice.fr>
 * @author    Th�o Gaillard
 * @copyright 2017 R�seau CERTA
 * @license   R�seau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte � Laboratoire GSB �
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if (!$uc) {
    $uc = 'demandeconnexion';
}

switch ($action) {
    
    case 'demandeConnexion':
        
        include 'vues/v_connexion.php';
        break;
        
    case 'valideConnexion':
        
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
        $visiteur = $pdo->getInfosVisiteur($login, $mdp);
        $comptable = $pdo->getInfosComptable($login, $mdp);
        // on verifie que la variable comptable ou utilisisateur n'est pas vide si c'est le cas il y a une erreur
        if (!is_array($visiteur) && !is_array($comptable)) {
            ajouterErreur('Identifiant ou mot de passe incorrect');
            include 'vues/v_erreurs.php';
            include 'vues/v_connexion.php';
        } else {   
            if (is_array($visiteur)){
                $id = $visiteur['id'];
                $nom = $visiteur['nom'];
                $prenom = $visiteur['prenom'];
                $statut ='visiteur';
                
            }  elseif (is_array($comptable)){
                $id = $comptable['id'];
                $nom = $comptable['nom'];
                $prenom = $comptable['prenom'];
                $statut ='comptable';
            }
            
            connecter($id, $nom, $prenom, $statut);
            header('Location: index.php');
        }
        break;
    default:
        include 'vues/v_connexion.php';
        break;
}

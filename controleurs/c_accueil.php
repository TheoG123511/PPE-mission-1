<?php
/**
 * Gestion de l'accueil
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
 * @version   GIT: 1
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */

$viisiteurConnecter = estVisiteurConnecter();
$comptableConnecter = estComptableConnecter();

if ($viisiteurConnecter) {
    include 'vues/v_accueil.php';
} elseif ($comptableConnecter){
    include 'vues/v_accueilComptable.php';
} else{
    include 'vues/v_connexion.php';
}

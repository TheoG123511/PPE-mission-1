<?php
/**
 * Vue qui permet de g�rer les Entête de l'application
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Th�o Gaillard
 */
?>
<!DOCTYPE html>
<html>
  <head>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta charset="UTF-8">
      <title>Intranet du Laboratoire Galaxy-Swiss Bourdin</title>
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="./styles/bootstrap/bootstrap.css" rel="stylesheet">
      <link href="./styles/style.css" rel="stylesheet">
  </head>
  <body>
      <div class="container">
          <?php
          $uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING);//Verifie le contenu de uc
          if ($viisiteurConnecter) {
              ?>
          <div class="header">
              <div class="row vertical-align">
                  <div class="col-md-4">
                      <h1>
                          <img src="./images/logo.jpg" class="img-responsive"
                               alt="Laboratoire Galaxy-Swiss Bourdin"
                               title="Laboratoire Galaxy-Swiss Bourdin">
                      </h1>
                  </div>
                  <div class="col-md-8">
                      <ul class="nav nav-pills pull-right" role="tablist" style="display: inline-flex;">
                          <li <?php if (!$uc || $uc == 'accueil') { ?>class="active" <?php } ?>>
                              <a href="index.php">
                                  <span class="glyphicon glyphicon-home"></span>
                                  Accueil
                              </a>
                          </li>
                          <li <?php if ($uc == 'gererFrais') { ?>class="active"<?php } ?>>
                              <a href="index.php?uc=gererFrais&action=saisirFrais">
                                  <span class="glyphicon glyphicon-pencil"></span>
                                  Renseigner la fiche de frais
                              </a>
                          </li>
                          <li <?php if ($uc == 'etatFrais') { ?>class="active"<?php } ?>>
                              <a href="index.php?uc=etatFrais&action=selectionnerMois">
                                  <span class="glyphicon glyphicon-list-alt"></span>
                                  Afficher mes fiches de frais
                              </a>
                          </li>
                          <li
                          <?php if ($uc == 'deconnexion') { ?>class="active"<?php } ?>>
                              <a href="index.php?uc=deconnexion&action=demandeDeconnexion">
                                  <span class="glyphicon glyphicon-log-out"></span>
                                  Déconnexion
                              </a>
                          </li>
                      </ul>
                  </div>
                    </div>
          </div>
                  <?php
          }else if($comptableConnecter){
                  ?>
           <div class="header">
              <div class="row vertical-align">
                  <div class="col-md-4">
                      <h1>
                          <img src="./images/logo.jpg" class="img-responsive"
                               alt="Laboratoire Galaxy-Swiss Bourdin"
                               title="Laboratoire Galaxy-Swiss Bourdin">
                      </h1>
                  </div>
                  <div class="col-md-8">
                      <ul class="nav nav-pills2 pull-right" role="tablist" style="display: inline-flex;">
                          <li <?php if (!$uc || $uc == 'accueil') { ?>class="active" <?php } ?>>
                              <a href="index.php">
                                  <span class="glyphicon glyphicon-home"></span>
                                  Accueil
                              </a>
                          </li>
                          <li <?php if ($uc == 'validerUnFrais') { ?>class="active"<?php } ?>>
                              <a href="index.php?uc=validerUnFrais&action=selectionnerVetM">
                                  <span class="glyphicon glyphicon-pencil"></span>
                                  Valider les fiches de frais
                              </a>
                          </li>
                          <li <?php if ($uc == 'suivreUnPaiement') { ?>class="active"<?php } ?>>
                              <a href="index.php?uc=suivreUnPaiement&action=afficheTousLesFrais">
                                  <span class="glyphicon glyphicon-list-alt"></span>
                                  Suivre le paiement des fiches de frais
                              </a>
                          </li>
                          <li
                          <?php if ($uc == 'deconnexion') { ?>class="active"<?php } ?>>
                              <a href="index.php?uc=deconnexion&action=demandeDeconnexion">
                                  <span class="glyphicon glyphicon-log-out"></span>
                                  Déconnexion
                              </a>
                          </li>
                      </ul>
                  </div>
                    </div>
          </div>            
          <?php
          } else {
              ?>  
              <h1>
                  <img src="./images/logo.jpg"
                       class="img-responsive center-block"
                       alt="Laboratoire Galaxy-Swiss Bourdin"
                       title="Laboratoire Galaxy-Swiss Bourdin">
              </h1>
              <?php
          }
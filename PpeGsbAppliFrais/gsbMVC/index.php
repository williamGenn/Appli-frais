<?php
session_start();
require_once ("include/class.pdogsb.inc.php");

$pdo = PdoGsb::getPdoGsb();
$estConnecte = isset($_SESSION['idVisiteur']);
if(!isset($_REQUEST['uc']) || !$estConnecte){
     $_REQUEST['uc'] = 'connexion';
}
$uc = $_REQUEST['uc'];
switch($uc){
case 'connexion':{
include("controleurs/class.c_connexion.php");
        $controlleur = new ControlleurConnexion($_REQUEST);
        $controlleur->Affichage();
        break;
}
case 'gererFrais' :{
        include("controleurs/class.c_gererFrais.php");
        $controlleur = new ControlleurValidationFrais($_REQUEST);
        $controlleur->Affichage();
        break;
}
case 'etatFrais' :{
        include("controleurs/class.c_etatFrais.php");
        $controlleur = new ControlleurEtatFrais($_REQUEST);
        $controlleur->Affichage();
        break;
}
    case 'validFrais' : {
        include("controleurs/class.c_validFrais.php");
        $controlleur = new ControlleurValidationFrais($_REQUEST);
        $controlleur->Affichage();
        break;
    }
}

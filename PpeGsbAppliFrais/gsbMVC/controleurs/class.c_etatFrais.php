<?php
include_once("include/class.controlleur.inc.php");


class ControlleurEtatFrais extends Controlleur
{
    public function __construct($request)
    {
        $titre = "Suivi du remboursement des frais";
        $listeMenu = array("Saisie fiche de frais" => "index.php?uc=gererFrais&action=saisirFrais",
        "Consultation de mes fiches de frais" => "index.php?uc=etatFrais&action=selectionnerMois",
        "Se déconnecter" => "index.php?uc=connexion&action=deconnexion"
        );
        parent::__construct($titre, $listeMenu, $request);
    }
    public function _destruct()
    {
    }

    public function Inititialiser()
    {
    }
    public function AffichageCorp()
    {
        $pdo = PdoGsb::getPdoGsb();
        $uc = "etatFrais";
        if (isset($this->request['action'])) {
            $action = $this->request['action'];
        } else {
            $action = 'selectionnerMois';
        }
        switch ($action) {
            case 'selectionnerMois':
                $lesMois=$pdo->getLesMoisDisponibles($_SESSION['idVisiteur']);
                $lesCles = array_keys($lesMois);
                $moisASelectionner = $lesCles[0];
                include("vues/v_listeMois.php");
                break;

            case 'voirEtatFrais':
                $idVisiteur = $_SESSION['idVisiteur'];
                $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
                $leMois = $this->request['lstMois'];
                $_SESSION['leMois'] = $leMois;
                $uc = 'etatFrais';
                include("vues/v_listeMois.php");

                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
                $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur, $leMois);
                $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
                $numAnnee =substr($leMois, 0, 4);
                $numMois =substr($leMois, 4, 2);
                $libEtat = $lesInfosFicheFrais['libEtat'];
                $montantValide = $lesInfosFicheFrais['montantValide'];
                $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
                $dateModif =  $lesInfosFicheFrais['dateModif'];
                $dateModif =  $this->dateAnglaisVersFrancais($dateModif);
                include("vues/v_etatFrais.php");
                break;

        }
        include("vues/v_fin_section.php");
    }
}

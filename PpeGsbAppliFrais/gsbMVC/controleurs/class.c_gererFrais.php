<?php
include_once("include/class.controlleur.inc.php");

class ControlleurValidationFrais extends Controlleur
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
        $idVisiteur = $_SESSION['idVisiteur'];
        $mois = $this->getMois(date("d/m/Y"));
        $numAnnee =substr($mois, 0, 4);
        $numMois =substr($mois, 4, 2);
        $pdo = PdoGsb::getPdoGsb();
        $action = $_REQUEST['action'];
        switch ($action) {
            case 'saisirFrais':{
                if ($pdo->estPremierFraisMois($idVisiteur, $mois)) {
                    $pdo->creeNouvellesLignesFrais($idVisiteur, $mois);
                }
                break;
            }
            case 'validerMajFraisForfait':{
                $lesFrais = $_REQUEST['lesFrais'];
                if ($this->lesQteFraisValides($lesFrais)) {
                    $pdo->majFraisForfait($idVisiteur, $mois, $lesFrais);
                } else {
                    $this->ajouterErreur("Les valeurs des frais doivent être numériques");
                    include("vues/v_erreurs.php");
                }
              break;
            }
            case 'validerCreationFrais':{
                $dateFrais = $_REQUEST['dateFrais'];
                $libelle = $_REQUEST['libelle'];
                $montant = $_REQUEST['montant'];
                $this->valideInfosFrais($dateFrais, $libelle, $montant);
                if ($this->nbErreurs() != 0) {
                    include("vues/v_erreurs.php");
                } else {
                    $pdo->creeNouveauFraisHorsForfait($idVisiteur, $mois, $libelle, $this->dateFrancaisVersAnglais($dateFrais), $montant);
                }
                break;
            }
            case 'supprimerFrais':{
                $idFrais = $_REQUEST['idFrais'];
                $pdo->supprimerFraisHorsForfait($idFrais);
                break;
            }
        }
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
        $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur, $mois);
        include("vues/v_listeFraisForfait.php");
        include("vues/v_listeFraisHorsForfait.php");
    }
}

<?php
include_once("include/class.controlleur.inc.php");

class ControlleurValidationFrais extends Controlleur
{
    public function __construct($request)
    {
        $titre = "Suivi du remboursement des frais";
        $listeMenu = array('Valider' => 'index.php?uc=validFrais&action=selectionnerVisiteur',
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
        if (isset($this->request['action'])) {
            $action = $this->request['action'];
        } else {
            $action = 'selectionnerVisiteur';
        }
        switch ($action) {
            case 'selectionnerVisiteur':
                $lesVisiteur = PdoGsb::getPdoGsb()->getVisiteurs();
                $lesCles = array_keys($lesVisiteur);
                $visiteurSelectionne = $lesCles[0];
                include("vues/v_listeVisiteur.php");
                break;

            case 'voirListMois':
                $lesVisiteur = PdoGsb::getPdoGsb()->getVisiteurs();
                $visiteurSelectionne = $this->request['lstVisiteur'];
                $_SESSION['visiteurSelectionne'] = $visiteurSelectionne;
                include("vues/v_listeVisiteur.php");

                $lesMois= PdoGsb::getPdoGsb()->getLesMoisDisponibles($visiteurSelectionne);
                if (!empty($lesMois)) {
                    $lesCles = array_keys($lesMois);
                    $moisSelectionne = $lesCles[0];
                    $uc = 'validFrais';
                    include("vues/v_listeMois.php");
                } else {
                    include("vues/v_pasdemois.php");
                }
                break;

            case 'envoiFormulaire'://PAS DE BREAK A LA FIN
                $pdo = PdoGsb::getPdoGsb();
                $formulaire = 1;
                $visiteurSelectionne = $_SESSION['visiteurSelectionne'];
                $moisSelectionne = $_SESSION['moisSelectionne'];
                $quantites = $this->request['FraisForfait'];
                $pdo->majFraisForfait($visiteurSelectionne,$moisSelectionne,$quantites);
                $etatFicheFrais = $this->request['EtatFraisForfait'];
                $pdo->majEtatFicheFrais($visiteurSelectionne,$moisSelectionne,$etatFicheFrais);
                $lesFraisHorsForfait = $this->request['EtatFraisHorsForfait'];
                foreach ($lesFraisHorsForfait as $id => $Etat) {
                    $pdo->majEtatHorsForfait($visiteurSelectionne,$moisSelectionne,$id,$Etat);
                }



            case 'voirEtatFrais':
                $pdo = PdoGsb::getPdoGsb();
                $lesVisiteur = $pdo->getVisiteurs();
                $visiteurSelectionne = $_SESSION['visiteurSelectionne'];
                include_once("vues/v_listeVisiteur.php");

                $lesMois = $pdo->getLesMoisDisponibles($visiteurSelectionne);
                if (!isset($formulaire)) {
                    $moisSelectionne = $this->request['lstMois'];
                    $_SESSION['moisSelectionne'] = $moisSelectionne;
                }
                $uc = 'validFrais';
                include("vues/v_listeMois.php");

                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($visiteurSelectionne, $moisSelectionne);
                $lesFraisForfait= $pdo->getLesFraisForfait($visiteurSelectionne, $moisSelectionne);
                $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($visiteurSelectionne, $moisSelectionne);
                $lesEtats = $pdo->getEtats();
                $etatSelectionne = $pdo->getEtatsFicheFrais($visiteurSelectionne, $moisSelectionne);
                $numAnnee =substr($moisSelectionne, 0, 4);
                $numMois =substr($moisSelectionne, 4, 2);
                $libEtat = $lesInfosFicheFrais['libEtat'];
                $montantValide = $lesInfosFicheFrais['montantValide'];
                $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
                $dateModif =  $lesInfosFicheFrais['dateModif'];
                $dateModif =  $this->dateAnglaisVersFrancais($dateModif);
                include("vues/v_validFrais.php");

                break;

            default:
                // code...
                break;
        }
    }
    /*
    public function selectMois() {

    }
    public function selectVisiteur() {

    }
    public function getMois() {

    }
    public function setMois() {}
    */
}

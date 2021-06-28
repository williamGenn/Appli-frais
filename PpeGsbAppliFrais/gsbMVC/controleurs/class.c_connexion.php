<?php
include_once("include/class.controlleur.inc.php");

class ControlleurConnexion extends Controlleur
{
    public function __construct($request)
    {
        $titre = "Suivi du remboursement des frais";
        parent::__construct($titre, null, $request);
    }
    public function _destruct()
    {
    }

    private $visiteur;

    public function Inititialiser()
    {
        if (!isset($this->request['action'])) {
            $this->request['action'] = 'demandeConnexion';
        }
        if (!strcmp($this->request['action'], 'valideConnexion')) {
            $pdo = PdoGsb::getPdoGsb();
            $login = $this->request['login'];
            $mdp = $this->request['mdp'];
            $this->visiteur = $pdo->getInfosVisiteur($login, $mdp);
            if (is_array($this->visiteur)) {
                $id = $this->visiteur['id'];
                $nom =  $this->visiteur['nom'];
                $prenom = $this->visiteur['prenom'];
                $role = $this->visiteur['role'];
                $this->connecter($id, $nom, $prenom, $role);
            }
        }
        if (!strcmp($this->request['action'], 'deconnexion')) {
            $this->deconnecter();
        }

        if ($this->estConnecte()) {
            $listeMenu = array("Saisie fiche de frais" => "index.php?uc=gererFrais&action=saisirFrais",
            "Consultation de mes fiches de frais" => "index.php?uc=etatFrais&action=selectionnerMois",
            "Se déconnecter" => "index.php?uc=connexion&action=deconnexion"
        );
        } else {
            $listeMenu = null;
        }
        $this->listeMenu = $listeMenu;
    }

    public function AffichageCorp()
    {
        $action = $this->request['action'];
        switch ($action) {
            case 'demandeConnexion':{
                include("vues/v_connexion.php");
                break;
            }
            case 'valideConnexion':{
                if (!is_array($this->visiteur)) {
                    $this->ajouterErreur("Login ou mot de passe incorrect");
                    include("vues/v_erreurs.php");
                }
                break;
            }
            default:{
                include("vues/v_connexion.php");
                break;
            }
        }
    }
}

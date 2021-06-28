<?php
/**
 * Controlleur parent pour l'application GSB
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 */
abstract class Controlleur
{
    protected $nomEntete;
    /*
     *liste vide = affichage role + nom
     *liste nulle= pas d'affichage de menu
     * format : "NOM" => "ACTION"
     */
    protected $listeMenu;
    protected $request;

    protected function __construct($nomEntete, $listeMenu, $request)
    {
        $this->nomEntete = $nomEntete;
        $this->listeMenu = $listeMenu;
        $this->request   = $request;
    }

    public function _destruct()
    {
    }
    /**
     * La méthode d'affichage de la page
     */
    public function Affichage()
    {
        $this->Inititialiser();
        if ($this->listeMenu == null) {
            $liste = false;
        } else {
            $liste = true;
        }
        $listeMenu = $this->listeMenu;
        $nomEntete   = $this->nomEntete;
        $titreEntete = $this->nomEntete;
        include("vues/v_entete.php");
        include("vues/v_sommaire.php");
        $this->AffichageCorp();
        include("vues/v_pied.php");
    }
    /**
     * La méthode d'affichage du corps
     *
     */
    abstract public function AffichageCorp();
    /**
    * Teste si un quelconque visiteur est connecté
    * @return vrai ou faux
    */
    abstract public function Inititialiser();
    public function estConnecte()
    {
        return isset($_SESSION['idVisiteur']);
    }
    /**
     * Enregistre dans une variable session les infos d'un visiteur
     * @param $id
     * @param $nom
     * @param $prenom
     */
    public function connecter($id, $nom, $prenom, $role)
    {
        $_SESSION['idVisiteur']= $id;
        $_SESSION['nom']= $nom;
        $_SESSION['prenom']= $prenom;
        $_SESSION['role']= $role;
    }
    /**
     * Détruit la session active
     */
    public function deconnecter()
    {
        $_SESSION = array();
        session_destroy();
    }
    /**
     * Transforme une date au format français jj/mm/aaaa vers le format anglais aaaa-mm-jj
     * @param $madate au format  jj/mm/aaaa
     * @return la date au format anglais aaaa-mm-jj
    */
    public function dateFrancaisVersAnglais($maDate)
    {
        @list($jour, $mois, $annee) = explode('/', $maDate);
        return date('Y-m-d', mktime(0, 0, 0, $mois, $jour, $annee));
    }
    /**
     * Transforme une date au format format anglais aaaa-mm-jj vers le format français jj/mm/aaaa
     * @param $madate au format  aaaa-mm-jj
     * @return la date au format format français jj/mm/aaaa
    */
    public function dateAnglaisVersFrancais($maDate)
    {
        @list($annee, $mois, $jour)=explode('-', $maDate);
        $date="$jour"."/".$mois."/".$annee;
        return $date;
    }
    /**
     * retourne le mois au format aaaamm selon le jour dans le mois
     * @param $date au format  jj/mm/aaaa
     * @return le mois au format aaaamm
    */
    public function getMois($date)
    {
        @list($jour, $mois, $annee) = explode('/', $date);
        if (strlen($mois) == 1) {
            $mois = "0".$mois;
        }
        return $annee.$mois;
    }

    /* gestion des erreurs*/
    /**
     * Indique si une valeur est un entier positif ou nul
     * @param $valeur
     * @return vrai ou faux
    */
    public function estEntierPositif($valeur)
    {
        return preg_match("/[^0-9]/", $valeur) == 0;
    }

    /**
     * Indique si un tableau de valeurs est constitué d'entiers positifs ou nuls
     * @param $tabEntiers : le tableau
     * @return vrai ou faux
    */
    public function estTableauEntiers($tabEntiers)
    {
        $ok = true;
        foreach ($tabEntiers as $unEntier) {
            if (!$this->estEntierPositif($unEntier)) {
                $ok=false;
            }
        }
        return $ok;
    }
    /**
     * Vérifie si une date est inférieure d'un an à la date actuelle
     * @param $dateTestee
     * @return vrai ou faux
    */
    public function estDateDepassee($dateTestee)
    {
        $dateActuelle=date("d/m/Y");
        @list($jour, $mois, $annee) = explode('/', $dateActuelle);
        $annee--;
        $AnPasse = $annee.$mois.$jour;
        @list($jourTeste, $moisTeste, $anneeTeste) = explode('/', $dateTestee);
        return ($anneeTeste.$moisTeste.$jourTeste < $AnPasse);
    }
    /**
     * Vérifie la validité du format d'une date française jj/mm/aaaa
     * @param $date
     * @return vrai ou faux
    */
    public function estDateValide($date)
    {
        $tabDate = explode('/', $date);
        $dateOK = true;
        if (count($tabDate) != 3) {
            $dateOK = false;
        } else {
            if (!$this->estTableauEntiers($tabDate)) {
                $dateOK = false;
            } else {
                if (!checkdate($tabDate[1], $tabDate[0], $tabDate[2])) {
                    $dateOK = false;
                }
            }
        }
        return $dateOK;
    }

    /**
     * Vérifie que le tableau de frais ne contient que des valeurs numériques
     * @param $lesFrais
     * @return vrai ou faux
    */
    public function lesQteFraisValides($lesFrais)
    {
        return $this->estTableauEntiers($lesFrais);
    }
    /**
     * Vérifie la validité des trois arguments : la date, le libellé du frais et le montant
     * des message d'erreurs sont ajoutés au tableau des erreurs
     * @param $dateFrais
     * @param $libelle
     * @param $montant
     */
    public function valideInfosFrais($dateFrais, $libelle, $montant)
    {
        if ($dateFrais=="") {
            $this->ajouterErreur("Le champ date ne doit pas être vide");
        } else {
            if (!$this->estDatevalide($dateFrais)) {
                $this->ajouterErreur("Date invalide");
            } else {
                if ($this->estDateDepassee($dateFrais)) {
                    $this->ajouterErreur("date d'enregistrement du frais dépassé, plus de 1 an");
                }
            }
        }
        if ($libelle == "") {
            $this->ajouterErreur("Le champ description ne peut pas être vide");
        }
        if ($montant == "") {
            $this->ajouterErreur("Le champ montant ne peut pas être vide");
        } elseif (!is_numeric($montant)) {
            $this->ajouterErreur("Le champ montant doit être numérique");
        }
    }
    /**
     * Ajoute le libellé d'une erreur au tableau des erreurs
     * @param $msg : le libellé de l'erreur
     */
    public function ajouterErreur($msg)
    {
        if (! isset($_REQUEST['erreurs'])) {
            $_REQUEST['erreurs']=array();
        }
        $_REQUEST['erreurs'][]=$msg;
    }
    /**
     * Retoune le nombre de lignes du tableau des erreurs
     * @return le nombre d'erreurs
     */
    public function nbErreurs()
    {
        if (!isset($_REQUEST['erreurs'])) {
            return 0;
        } else {
            return count($_REQUEST['erreurs']);
        }
    }
}

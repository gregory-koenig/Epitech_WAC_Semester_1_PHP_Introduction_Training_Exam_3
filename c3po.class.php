<?php
require_once("robot.class.php");
require_once("ic3po.class.php");

class C3PO extends Robot implements iC3PO {
    protected $numeroDeSerie;
    private $nom;
    private $type;

    public function __construct($nom, $type = "droide de protocole") {
        static $i = 1;
        $this->numeroDeSerie = $i;
        $i++;
        $this->nom = $nom;
        $this->type = $type;
        echo "Je suis le droide de protocole numéro $this->numeroDeSerie" .
            ", enchanté de vous rencontrer !\n";
    }

    public function __toString() {
        return "Je suis bien le droide de protocole numéro $this->numeroDeSerie" .
            ", je me suis déjà présenté lorsque vous m'avez créé !\n";
    }

    public function getNom() {
        return $this->nom;
    }

    public function getType() {
        return $this->type;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setType($type) {
        $this->type = $type;
    }

    // Ordre "dire"
    public function dire($str) {
        echo "C3PO no $this->numeroDeSerie : $str\n";
    }

    // Ordre "marcher"
    public function marcher() {
        parent::marcher();
        echo "Je me mets en route, inutile d’insister.\n";
    }

    /* - Fonction qui permet une interaction avec l'utilisateur à travers l'entrée
    ** standard afin d'exécuter une série d'ordres.
    ** - La présence ou non des guillemets de l'ordre "dire" est gérée à travers
    ** le second "if" imbriqué dans le premier "if" */
    public function initierProtocole() {
        echo "En attente d’interaction utilisateur : \n";
        $stdin = fopen("php://stdin", "r");
        while (true) {
            $ordre = fgets($stdin);
            $dire = substr("$ordre", 0, 4);
            if ($dire == "dire") {
                $text = substr("$ordre", 5, -1);
                $first_quote = substr("$text", 0, 1);
                $last_quote = substr("$text", -1);
                if ($first_quote == '"' && $last_quote == '"') {
                    $text = substr("$text", 1, -1);
                    $this->dire("$text");
                } else {
                    $this->dire("$text");
                }
            } elseif ($ordre == "marcher\n") {
                $this->marcher();
            } elseif ($ordre == "repos\n") {
                echo "Fin du protocole\n";
                break;
            } else {
                echo "Ordre invalide : veuillez saisir un ordre valide s'il "
                . "vous plait (\"dire\", \"marcher\" ou \"repos\"). Merci.\n";
            }
        }
    }
}

$perso = new C3PO("Greg");
echo $perso;
$perso->initierProtocole();
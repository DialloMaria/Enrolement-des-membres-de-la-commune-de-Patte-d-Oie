

<?php
require_once "Habitant.php";
require_once "Statut.php";
require_once "Age.php";
require_once "Situation_matrimoniale.php";

// Définition des constantes pour les informations de la base de données
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'recensement_commune');

try {
    // Connexion à la base de données en utilisant PDO
    $connexion = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    
    // Instanciation de l'objet Habitant
    $habitant = new Habitant($connexion, "Diallo", "Dora", 14, "Feminin", "Celibat", "civile");
    
    // Appel de la méthode pour récupérer les habitants
    $resultats = $habitant->readHabitant();

    // Instanciation de  statut
    $indiqueStatut = new Statut($connexion, "Civile");
    $status = $indiqueStatut ->RecupStatut();

    // Instanciation tranche age
    $indiqueAge= new Age($connexion, "1");
    $Ages = $indiqueAge ->RecupTranche_age();

        // Instanciation situation matrimoniale
        $indiqueSituation= new Situation_matrimoniale($connexion, "Divorce",);
        $SM = $indiqueSituation ->RecupSituation_matrimoniale();

} catch (PDOException $e) {
    // Gestion des erreurs de connexion à la base de données
    die("Erreur : Impossible de se connecter à la base de données " . $e->getMessage());
}
 


 
?>

<?php
//AFFICHAGE DES ERREURS
error_reporting(E_ALL);
ini_set('display_errors', 1);
    require_once "Agent.php";
    //création de la class Habitant et ses attibuts
    class Habitant implements Agent
    {
        //Proprietés.
       private $connexion;
       private $matricule;
       private $nom ;
       private $prenom ;
       private $tranche_age ;
       private $sexe ;
       private $situation_matrimoniale ;
       private $statut ;
        
        //Creation des fonctions
        function __construct($connexion,$nom,$prenom,$tranche_age,$sexe,$situation_matrimoniale,$statut){
            $this->connexion=$connexion;
            $this->nom=$nom;
            $this->prenom=$prenom;
            $this->tranche_age=$tranche_age;
            $this->sexe=$sexe;
            $this->situation_matrimoniale=$situation_matrimoniale;
            $this->statut=$statut;

        }
        public function getMatricule(){
            return $this->matricule;
        }
        public function getNom(){
            return $this->nom;
        }
        public function getPrenom(){
            return $this->prenom;
        }
        public function getTranche_tranche_age(){
            return $this->tranche_age;
        }
        public function getSexe(){
            return $this->sexe;
        }
        public function getSituation_matrimoniale(){
            return $this->situation_matrimoniale;
        }
        public function getStatut(){
            return $this->statut;
        }
        

        public function addHabitant($nom, $prenom, $tranche_age, $sexe, $situation_matrimoniale, $statut){
    try {
        // Requête pour insérer un habitant
        $sql = "INSERT INTO habitants (nom,prenom,id_age,sexe,id_situation,id_statut) VALUES (:nom,:prenom,:tranche_age,:sexe,:situation_matrimoniale,:statut)";

        // Préparation de la requête
        $stmt = $this->connexion->prepare($sql);

        // Faire la liaison des valeurs aux paramètres
        $stmt->bindParam(':nom',$nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom',$prenom, PDO::PARAM_STR);
        $stmt->bindParam(':tranche_age',$tranche_age, PDO::PARAM_INT); // Utilisation de PARAM_INT pour un champ d'âge
        $stmt->bindParam(':sexe',$sexe, PDO::PARAM_STR);
        $stmt->bindParam(':situation_matrimoniale',$situation_matrimoniale, PDO::PARAM_INT);
        $stmt->bindParam(':statut',$statut, PDO::PARAM_INT);

        // Exécuter la requête
        $stmt->execute();

        // Rediriger la page
        header("location: recensement.php");
        exit();

    } catch (PDOException $e) {
      
        die("Erreur : Impossible d'insérer un habitant. " . $e->getMessage());
    }
}

        //Methode pour afficher les élèves
         public function readHabitant(){

            try {
                //requete sql pour selectionner tout les habitants
                $sql="SELECT matricule,nom, prenom, a.libelle AS age, si.libelle AS situation, sexe, s.libelle statut
                FROM habitants h
                INNER JOIN tranches_age a ON h.id_age = a.id
                INNER JOIN statut s ON h.id_statut = s.id
                INNER JOIN situation_matrimoniale si ON h.id_situation = si.id";
    
                //preparation de la requete
                $stmt=$this->connexion->prepare($sql);
    
                //exécution de la requete
                $stmt->execute();
    
                //recuperation des resultats
                $resultats=$stmt->fetchAll(PDO::FETCH_ASSOC);
                return $resultats;
            } 
            catch (PDOException $e) {
                die("erreur:Impossible d'afficher les habitants" .$e->getMessage());
            }

         }
         
        //Methode pour afficher les habitants
            public function updateHabitant(){

         }


         //Methode pour supprimer les habitants
         public function deleteHabitant($matricule){

            try {
                // Requête SQL de suppression avec des paramètres
                $sql = "DELETE FROM habitants WHERE matricule = :matricule";
                
                // Préparation de la requête
                $stmt = $this->connexion->prepare($sql);
                
                // Liaison de la valeur de l'matricule au paramètre
                $stmt->bindParam(':matricule', $matricule, PDO::PARAM_INT);
                
                // Exécution de la requête
                $stmt->execute();
                
                // Retourne true si la suppression a réussi
               
                header("location: recensement.php");
            } catch(PDOException $e) {
                // Gestion de l'erreur en la lançant à l'extérieur de la méthode
                throw new Exception("ERREUR: Impossible de supprimer l'habitant. " . $e->getMessage());
            }
        }
    }


?> 
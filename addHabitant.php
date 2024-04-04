<?php
//AFFICHAGE DES ERREURS
error_reporting(E_ALL);
ini_set('display_errors', 1);
 require_once "config.php";
 if(isset($_POST['submit'])){
    //recuperartion des données
     $nom= $_POST['nom'];
     $prenom= $_POST['prenom'];
     $age= $_POST['tranche_age'];
     $sexe= $_POST['sexe'];
     $situation_matrimoniale =$_POST['situation_matrimoniale'];
     $statut= $_POST['statut'];

     //verification des champs s'il ne sont pas vide
     if($nom!="" && $prenom!="" && $age!="" && $sexe!=" " && $situation_matrimoniale !="" && $statut!=""){
        //appel de la methode 
        $habitant->addHabitant($nom,$prenom,$age,$sexe,$situation_matrimoniale,$statut);
    }
}


?>
<?php
//AFFICHAGE DES ERREURS
error_reporting(E_ALL);
ini_set('display_errors', 1);
interface agent{
    public function addHabitant($nom,$prenom,$tranche_age,$sexe,$situation_matrimoniale,$statut);
    public function readHabitant();
    public function updateHabitant();
    public function deleteHabitant($matricule);
}
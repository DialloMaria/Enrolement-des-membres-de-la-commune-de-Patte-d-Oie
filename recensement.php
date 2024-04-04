<?php
//AFFICHtranche_age DES ERREURS
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Inclure le fichier contenant la classe Student
require_once "config.php";
require_once "Habitant.php";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Formulaire</title>
   <style>
       body {
           font-family: Arial, sans-serif;
           background-color: #f4f4f4;
           margin: 0;
           padding: 0;
       }


       form {
           max-width: 400px;
           margin: 20px auto;
           padding: 20px;
           background-color: #fff;
           border-radius: 5px;
           box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
       }


       label {
           display: block;
           margin-bottom: 5px;
       }


       input[type="text"],
       input[type="number"],
       select {
           width: 100%;
           padding: 10px;
           margin-bottom: 10px;
           border: 1px solid #ccc;
           border-radius: 5px;
           box-sizing: border-box;
       }


       button[type="submit"] {
           background-color: #007bff;
           color: #fff;
           border: none;
           padding: 10px 20px;
           border-radius: 5px;
           cursor: pointer;
       }


       button[type="submit"]:hover {
           background-color: #0056b3;
       }
   </style>
</head>
<body>
   <form action="addHabitant.php " method="post">
       <label for="nom">Nom :</label>
       <input type="text" id="nom" name="nom" required>


       <label for="prenom">Prénom :</label>
       <input type="text" id="prenom" name="prenom" required>


       <label for="tranche_age">Tranche_age :</label>
       <select  type="number" id="tranche_age" name="tranche_age"  required>
            <option value="">selectionne un tranche_age</option>
            <?php  foreach ($Ages as $age) : ?>
            <option value="<?php  echo $age ['id']; ?>"><?php  echo $age ['libelle']; ?></option>
            <?php endforeach; ?>
       </select>
       
       <label for="sexe">Sexe :</label>
       <select id="sexe" name="sexe" required>
           <option value="feminin">Féminin</option>
           <option value="masculin">Masculin</option>
       </select>


       <label for="situation_matrimoniale">Situation matrimoniale :</label>
       <select  type="text" id="situation_matrimoniale" name="situation_matrimoniale" required>
           <option value="">selectionne</option>
           <?php foreach ($SM as $Sm) : ?>
            <option value="<?php echo $Sm ['id']; ?>"><?php echo $Sm ['libelle'] ;?></option>
            <?php  endforeach;?>
       </select>

       <label for="statut">Statut</label>
            <select name="statut" id="statut" required>
                <option value="">Choisis un statut</option>
                <?php foreach ($status as $statu) : ?>
                    <option value="<?php echo $statu ['id']; ?>"><?php echo $statu ['libelle']; ?></option>
                <?php endforeach; ?>
            </select><br><br>

        <button type="submit" name="submit">Soumettre</button>
   </form>




   <style>
       body {
           font-family: Arial, sans-serif;
           background-color: #f4f4f4;
           margin: 0;
           padding: 0;
       }


       .container {
           max-width: 800px;
           margin: 20px auto;
           padding: 20px;
           background-color: #fff;
           border-radius: 5px;
           box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
       }


       table {
           width: 100%;
           border-collapse: collapse;
       }


       th, td {
           padding: 10px;
           text-align: left;
           border-bottom: 1px solid #ccc;
       }


       th {
           background-color: #f4f4f4;
           font-weight: bold;
       }


       .btn {
           padding: 5px 10px;
           margin-right: 10px;
           border: none;
           border-radius: 3px;
           cursor: pointer;
       }


       .btn-edit {
           background-color: #007bff;
           color: #fff;
       }


       .btn-delete {
           background-color: #dc3545;
           color: #fff;
       }
   </style>

<?php
    // Requête SQL pour récupérer les données des habitants avec les données des tables liées (âge, statut, situation_matrimoniale)
    $sql = "SELECT nom, prenom, a.libelle, si.libelle, sexe, s.libelle
    FROM habitants h
    INNER JOIN tranches_age a ON h.id_age = a.id
    INNER JOIN statut s ON h.id_statut = s.id
    INNER JOIN situation_matrimoniale si ON h.id_situation = si.id";

?>
   <div class="container">
       <table>
           <thead>
               <tr>
                   <th>Matricule</th>
                   <th>Nom</th>
                   <th>Prénom</th>
                   <th>Tranche_age</th>
                   <th>Sexe</th>
                   <th>Situation matrimoniale</th>
                   <th>Statut</th>
               </tr>
           </thead>
           <tbody>
   <?php if ($resultats !== null) { ?>
       <?php foreach ($resultats as $habitant) { ?>
           <tr>
               <td><?php echo $habitant['matricule']; ?></td>
               <td><?php echo $habitant['nom']; ?></td>
               <td><?php echo $habitant['prenom']; ?></td>
               <td><?php echo $habitant['age']; ?></td>
               <td><?php echo $habitant['sexe']; ?></td>
               <td><?php echo $habitant['situation']; ?></td>
               <td><?php echo $habitant['statut']; ?></td>
               
               <td><button class="btn btn-delete"><a href="updateHabitant.php?matricule=<?php echo $habitant['matricule']; ?>">Modifier</a></button></td>
               <td><button class="btn btn-delete"><a href="deleteHabitant.php?matricule=<?php echo $habitant['matricule']; ?>">Supprimer</a></button></td>
           </tr>
       <?php } ?>

   <?php } else { ?>
       <tr>
           <td colspan="8">Aucun résultat trouvé</td>
       </tr>
   <?php } ?>
</tbody>


       </table>
   </div>


</body>
</html>



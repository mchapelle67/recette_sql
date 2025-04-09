<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <title>Recettes</title>
</head>
<body>

<?php

// connexion à SQL
$mySqlClient = new PDO(
    'mysql:host=localhost;dbname=recettes;charset=utf8',
    'root',
    '',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION], // GESTION DES ERREURS
);

// on recupère le contenu des tables
$sqlQuery = 
'SELECT nom_recette, temps_prep, nom_categorie, id_recette
FROM recette
INNER JOIN categorie ON recette.id_categorie = categorie.id_categorie';
$recettesStatement = $mySqlClient->prepare($sqlQuery);
$recettesStatement->execute();
$recettes = $recettesStatement->fetchAll();

// on affiche chaque recette une à une dans un tableau 
echo 
"<div class='tableau'>",
"<table>",
"<h1>Recettes de cuisine</h1>",
    "<thead>",
        "<tr>",
            "<th>Nom de la recette</th>",
            "<th>Temps</th>",
            "<th>Catégorie</th>",
        "</tr>",
    "</thead>",
    "<tbody>";
foreach ($recettes as $recette) { 
    echo 
    "<tr>",
        "<td><a href='detailRecette.php?id=".$recette['id_recette']."'>".$recette['nom_recette']."</a></td>",
        "<td>".$recette['temps_prep']."</td>",
        "<td>".$recette['nom_categorie']."</td>",
    "</tr>";
};
echo "</tbody>",
"</table>",
"</div>";

?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <title>Detail recettes</title>
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
'SELECT nom_recette, temps_prep, nom_categorie, instructions
FROM recette
INNER JOIN categorie ON recette.id_categorie = categorie.id_categorie
WHERE id_recette = :id'
;
$recettesStatement = $mySqlClient->prepare($sqlQuery);
$recettesStatement->execute([
    'id' => $_GET['id']
]);
$recettes = $recettesStatement->fetch();

$sqlQuery = 
'SELECT nom_ingredient, qtt, unite
FROM ingredient
INNER JOIN recette_ingredient ON ingredient.id_ingredient = recette_ingredient.id_ingredient
INNER JOIN recette ON recette_ingredient.id_recette = recette.id_recette
WHERE recette.id_recette = :id'
;
$ingredientsStatement = $mySqlClient->prepare($sqlQuery);
$ingredientsStatement->execute([
    'id' => $_GET['id']
]);
$ingredients = $ingredientsStatement->fetchAll();


echo "<div class='recette'>",
        "<h1>".$recettes['nom_recette']."</h1>",
            "<h2>".$recettes['nom_categorie'].", ".$recettes['temps_prep']." minutes de préparation</h2>",
                "<h3>Ingredients:</h3>";
    foreach ($ingredients as $ingredient){
    echo "<p>",
            "<ul>",
                "<li>".$ingredient['qtt']." ".$ingredient['unite']." ".$ingredient['nom_ingredient']."</li>",
            "</ul>",
        "</p>";
    };

echo "<div class='instructions'><p>".$recettes['instructions']."</div></div>";



?>
</body>
</html>
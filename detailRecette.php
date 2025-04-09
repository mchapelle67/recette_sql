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
'SELECT nom_recette, temps_prep, nom_categorie, instructions, nom_ingredient, qtt, unite
FROM recette
INNER JOIN categorie ON recette.id_categorie = categorie.id_categorie
INNER JOIN recette_ingredient ON recette.id_recette= recette_ingredient.id_recette
INNER JOIN ingredient ON recette_ingredient.id_ingredient = ingredient.id_ingredient
WHERE recette.id_recette = :id'
;
$recettesStatement = $mySqlClient->prepare($sqlQuery);
$recettesStatement->execute([
    'id' => $_GET['id']
]);
$recettes = $recettesStatement->fetchAll();

foreach ($recettes as $recette) {
    echo "<div class='recette'>",
            "<h1>".$recette['nom_recette']."</h1>",
                "<h2>".$recette['nom_categorie'].", ".$recette['temps_prep']." minutes de préparation</h2>",
                "<h3>Ingredients:</h3>";
    foreach ($recettes as $recette){
    echo "<p>",
            "<ul>",
                "<li>".$recette['qtt']." ".$recette['unite']." ".$recette['nom_ingredient']."</li>",
            "</ul>",
        "</p>";
    };
    echo "<div class='instructions'><p>".$recette['instructions']."</div></div>";
};


?>
</body>
</html>
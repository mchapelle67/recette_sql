🍽️ Projet Recettes – PHP & MySQL

Une application simple en PHP qui permet d'afficher des recettes à partir d'une base de données relationnelle.

🔧 Fonctionnalités

Liste toutes les recettes disponibles.

Affiche les détails d’une recette (ingrédients, quantités, instructions).

Mise en page avec style.css et image de fond (back.avif).

Connexion sécurisée à la base avec PDO.

📁 Structure du projet

recettes.php : liste des recettes avec lien vers les détails.

detailRecette.php : détail complet d’une recette sélectionnée.

style.css : style global du site.

🗃️ Base de données utilisée

4 tables principales :

recette (id, nom, temps, recette, catégorie)

ingredient (id, nom, prix)

recette_ingredient (liaison avec quantité et unité)

categorie (id, nom)

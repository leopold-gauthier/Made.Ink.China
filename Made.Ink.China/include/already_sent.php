<?php
// Chemin vers le fichier du compteur
$compteurFile = './include/compteur.txt';

// Vérifie si un cookie "visiteur" existe
if (!isset($_COOKIE['visiteur'])) {
    // Si le cookie n'existe pas, nous lisons la valeur actuelle du compteur depuis le fichier
    $visiteurCount = (int)file_get_contents($compteurFile);

    // Incrémenter le compteur
    $visiteurCount++;

    // Écrire la nouvelle valeur dans le fichier
    file_put_contents($compteurFile, $visiteurCount);

    // Crée un cookie "visiteur" avec la valeur 1 et expire dans 24 heures
    setcookie('visiteur', $visiteurCount, time() + 3600);
} else {
    // Si le cookie existe, utilisez sa valeur actuelle
    $visiteurCount = $_COOKIE['visiteur'];
}

<?php
session_start(); // s'applique dans toutes les pages
define('URL','http://localhost/PHP/11_BD'); // constante pour notre URL
define('RACINE_SITE', $_SERVER['DOCUMENT_ROOT'] . '/PHP/11_BD');
require_once 'connexion_bdd.inc.php'; // j'appelle la bdd
require_once 'fonctions.inc.php'; // j'appele les fonctions

// debug($ecommerce); // check de la BDD

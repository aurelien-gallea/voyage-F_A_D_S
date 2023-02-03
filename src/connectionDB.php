<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=blog_voyage;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' .$e->getMessage());
}
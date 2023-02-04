<?php
    session_start(); // initialiser
    session_unset(); // desactiver
    session_destroy(); //detruire
    setcookie('auth', '', time() - 1, '/');
    header('location: articles.php');
    exit();
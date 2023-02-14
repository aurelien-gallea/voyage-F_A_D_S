<?php

require_once('connectionDB.php');
$req = $bdd->prepare('SELECT login, email FROM utilisateurs');
$req->execute();

$response = $req->fetchAll(PDO::FETCH_ASSOC); 
    
echo json_encode($response);


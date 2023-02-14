<?php

    class Verify {

        public static function verifySyntax($email) {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return false;
            } else {
                return true;
            }
        }
        public static function loginAlreadyExist($login) {
            require('src/connectionDB.php');
            $req = $bdd->prepare('SELECT COUNT(*) AS nbLogin FROM utilisateurs WHERE login=?');
            $req->execute([$login]);
            while ($row = $req->fetch()) {
                if($row['nbLogin'] != 0 ) {
                    return true;
                }
            }
        }
        public static function emailAlreadyExist($email) {
            require('src/connectionDB.php');
            $req = $bdd->prepare('SELECT COUNT(*) AS nbEmail FROM utilisateurs WHERE email=?');
            $req->execute([$email]);
            while ($row = $req->fetch()) {
                if($row['nbEmail'] != 0 ) {
                    return true;
                }
            }
        }
    }
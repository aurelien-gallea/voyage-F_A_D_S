<?php

    class Verifycom {

      
        public static function IdAlreadyExist($id) {
            require('src/connectionDB.php');
            $req = $bdd->prepare('SELECT COUNT(*) AS nbLogin FROM commentaires WHERE id=?');
            $req->execute([$nb]);
            while ($row = $req->fetch()) {
                if($row['nbLogin'] != 0 ) {
                    return true;
                }
            }
        }
        
    }
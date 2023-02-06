<?php

class Update {

    public static function deleteArticle($id_article, $id_utilisateur) {
        require('src/connectionDB.php');
        $delete = $bdd->prepare('DELETE FROM articles WHERE id=? AND id_utilisateur=?');
        $delete->execute([$id_article, $id_utilisateur]);
        return true;
    }

    public static function updateArticle($titre, $article, $id_article, $id_utilisateur) {
        require('src/connectionDB.php');
        $update = $bdd->prepare('UPDATE `articles` SET `titre`=?,`article`=? WHERE id=? AND id_utilisateur=?');
        $update->execute([$titre, $article, $id_article, $id_utilisateur]);
        return true;
    }
}
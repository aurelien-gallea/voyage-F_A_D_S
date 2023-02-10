<?php

class Update
{

    public static function deleteArticle($id_article, $id_utilisateur)
    {
        require('src/connectionDB.php');
        $delete = $bdd->prepare('DELETE FROM articles WHERE id=? AND id_utilisateur=?');
        $delete->execute([$id_article, $id_utilisateur]);
        return true;
    }
    public static function deleteArticleModeration($id_article)
    {
        require('src/connectionDB.php');
        $delete = $bdd->prepare('DELETE FROM articles WHERE id=?');
        $delete->execute([$id_article]);
        return true;
    }
    public static function updateArticle($titre, $article, $id_article, $id_utilisateur)
    {
        require('src/connectionDB.php');
        $update = $bdd->prepare('UPDATE `articles` SET `titre`=?,`article`=? WHERE id=? AND id_utilisateur=?');
        $update->execute([$titre, $article, $id_article, $id_utilisateur]);
        return true;
    }
    public static function updateArticleModeration($titre, $article, $id_article) {
        require('src/connectionDB.php');
        $update = $bdd->prepare('UPDATE `articles` SET `titre`=?,`article`=? WHERE id=?');
        $update->execute([$titre, $article, $id_article]);
        return true;
    }
    public static function deleteCatArt($id_article)
    {
        require('src/connectionDB.php');
        $deleteCatArt = $bdd->prepare('DELETE FROM cat_art WHERE id_art =?');
        $deleteCatArt->execute([$id_article]);
    }

    public static function insertIntoCatArt($id_article, $id_categorie)
    {
        require('src/connectionDB.php');
        $insertIntoCatArt = $bdd->prepare('INSERT INTO cat_art (id_art, id_cat) VALUES (?,?)');
        $insertIntoCatArt->execute([$id_article, $id_categorie]);
    }
    public static function allCategories($array) {
        require('src/connectionDB.php');
        $catList = $bdd->prepare('SELECT * FROM categories');
        $catList->execute();
        while ($ligne = $catList->fetch(PDO::FETCH_ASSOC)) {
            array_push($array, $ligne);
        }
        return $array;
    }
    public static function listOfCategories()
    {
        require('src/connectionDB.php');
        $catList = $bdd->prepare('SELECT * FROM categories');
        $catList->execute();
        // $compteur = $catList->rowCount();
        $arrayCatList = [];
        while ($ligne = $catList->fetch(PDO::FETCH_ASSOC)) {
            array_push($arrayCatList, $ligne);
        } ?>
        <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSearchButton">
    <?php  for ($i = 0; $i < count($arrayCatList); $i++) { ?>
            <li>
            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
            <input id="checkbox-item-<?=$i?>" type="checkbox" name="categorie[]" value="<?= $arrayCatList[$i]['id'] ?>" class='w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500'>
            <label for="checkbox-item-<?=$i?>" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"><?= $arrayCatList[$i]['nom'] ?></label>
    <?php } ?>
            </div>
            </li>
        </ul>
   <?php }

    public static function associateCatName($id_article, $arrayCat)
    {

        require('src/connectionDB.php');
        // SELECT cat_art.id_cat, categories.nom FROM `cat_art` INNER JOIN categories ON categories.id = cat_art.id_cat;
        $catName = $bdd->prepare('SELECT cat_art.id_cat, categories.nom FROM `cat_art` INNER JOIN categories ON categories.id = cat_art.id_cat WHERE cat_art.id_art = ?');
        $catName->execute([$id_article]);
        while ($categories = $catName->fetch(PDO::FETCH_ASSOC)) {
            array_push($arrayCat, $categories['nom']);
        }
        return $arrayCat;
    }

    public static function selectCommentsByUser($id_user, $arrayComs) {

        require('src/connectionDB.php');
        $coms = $bdd->prepare('SELECT * FROM commentaires WHERE id_utilisateur = ?');
        $coms->execute([$id_user]);
        
        while ($comsResponse = $coms->fetch(PDO::FETCH_ASSOC)) {
            array_push($arrayComs, $comsResponse);
        }
        return $arrayComs;
    }
    public static function selectAllComments($arrayComs) {

        require('src/connectionDB.php');
        $coms = $bdd->prepare('SELECT * FROM commentaires');
        $coms->execute();
        
        while ($comsResponse = $coms->fetch(PDO::FETCH_ASSOC)) {
            array_push($arrayComs, $comsResponse);
        }
        return $arrayComs;
    }
    public static function selectAllUsers($array) {

        require('src/connectionDB.php');
        $coms = $bdd->prepare('SELECT id, login, email FROM utilisateurs');
        $coms->execute();
        
        while ($allUsersResponse = $coms->fetch(PDO::FETCH_ASSOC)) {
            array_push($array, $allUsersResponse);
        }
        return $array;
    }
    public static function selectAllStatusByUser($array) {
        require('src/connectionDB.php');
        $status = $bdd->prepare('SELECT utilisateurs.login,  droits.nom AS droits, droits.id_utilisateur FROM utilisateurs INNER JOIN droits ON droits.id_utilisateur = utilisateurs.id');
        $status->execute();
        
        while ($allUsersStatus = $status->fetch(PDO::FETCH_ASSOC)) {
            array_push($array, $allUsersStatus);
        }
        return $array;
    }
    public static function selectStatusByUser($id_user) {
        require('src/connectionDB.php');
        $status = $bdd->prepare('SELECT droits.nom AS droits FROM utilisateurs INNER JOIN droits ON droits.id_utilisateur = utilisateurs.id WHERE utilisateurs.id=?');
        $status->execute([$id_user]);
        $response = $status->fetch();
    
        return $response;
    }

    public static function updateStatus($newStatus, $id_user) {
        require('src/connectionDB.php');
        $status = $bdd->prepare('UPDATE `droits` SET `nom`=? WHERE `id_utilisateur`=?  ');
        $status->execute($newStatus, $id_user);

        
    }
}

<?php
namespace savers;
require_once '../vendor/autoload.php';
use db\db_news;
use Exception;

try {

$mainObject = new db_news();

//Here I'm not use validation because I'm an admin and no risk to get wrong data
$connection = $mainObject->getConnection();
    $connection->beginTransaction();

    //Here we set title and text, date setting automatically inside this method
    $mainObject->setValues($_POST['title'], $_POST['text']);

    //Now we are getting id of just saved article to bind tags, images and categories
    $articleIdQuery = $connection->query("SELECT id FROM news WHERE title = '$_POST[title]'");
    $articleIdArray = $articleIdQuery->fetch();
    $articleId = $articleIdArray['id'];

    //Here we bing categories
    $mainObject->addNewsCategory($_POST['categories'], $articleId);

    //Here we check for images and if it exists we save it
    if(is_uploaded_file($_FILES['file']['tmp_name'][0])){
        $mainObject->addNewsImage($_FILES, $articleId);
    }

    //Here we add tags
    if($_POST['tags'] !== ""){
        $mainObject->saveTags($_POST['tags'], $articleId);
    }

    $connection->commit();

} catch (Exception $e){
    $connection->rollBack();
    echo 'Boss, we have some problem: ',  $e->getMessage(), "\n";
}

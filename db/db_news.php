<?php
namespace db;
require_once "db.php";
use PDO;
class db_news extends db
{
/**
    * @param $title string title of news
    * @param $text string text of news
    * @param $date timestamp
*/
    public function setValues($title,$text)
    {
        $date = date("Y-m-d H:i:s");
        $db = $this->getConnection();
        $stmt = $db->prepare("INSERT INTO news (title,text,`date`) VALUES (?,?,?)");
        $stmt->bindParam(1,$title);
        $stmt->bindParam(2,$text);
        $stmt->bindParam(3,$date);
        $stmt->execute();
    }

/**
    * @param $statement string SQL-adapted SELECT query
    * @return array of all returned values
*/
    public function getValues ($statement)
    {
        $db = $this->getConnection();
        $stmt = $db->query($statement);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

            return $stmt->fetchAll();
    }

    /**
     * @param $tags string with tags separedt with #sign
     * @param $articleId int id of new the tags should be bind with
     */
   public function saveTags ($tags, $articleId)
    {
        $tags = trim($tags);
        $tagsArray = explode("#",$tags);

        //$dbObject = new db();
        $connection = $this->getConnection();

        foreach ($tagsArray as $tag){
            $tag = trim($tag);
            if ($tag !== "") {
                $result = $connection->query("SELECT id FROM tags WHERE tag_name = '$tag'");
                $tagId = $result->fetch();
                if($tagId){
                    $connection->query("INSERT INTO news_tags (news_id, tag_id) VALUES ('$articleId','$tagId[id]')");
                } else{
                    $connection->query("INSERT INTO tags (tag_name) VALUES ('$tag')");
                    $resultNext = $connection->query("SELECT id FROM tags WHERE tag_name = '$tag'");
                    $tagIdNext = $resultNext->fetch();
                    if($tagIdNext){
                        $connection->query("INSERT INTO news_tags (news_id, tag_id) VALUES ('$articleId','$tagIdNext[id]')");
                    }
                }
            }
        }
    }

    /**
     * @param array $categories
     * @param $articleId int id of new the categories should be bind with
     */
    public function addNewsCategory (array $categories, $articleId)
    {

        //$dbObject = new db();
        $connection = $this->getConnection();

        foreach ($categories as $category){
            //here we get id of needed category and put it on $caegoryId variable
            $categoryIdQuery = $connection->query("SELECT id FROM categories WHERE category = '$category'");
            $categoryIdArray = $categoryIdQuery->fetch();
            $categoryId = $categoryIdArray['id'];
            if($categoryId){
                $connection->query("INSERT INTO news_categories (news_id, category_id) VALUES ('$articleId','$categoryId')");
            }
        }

    }

    //before to give argument check if file was uploaded with is_uploaded_file function!!!
    /**
     * @param $files array $_FILE
     * @param $articleId int id of new the image should be bind with
     */
   public function addNewsImage ($files, $articleId)
    {
        //$dbObject = new db();
        $connection = $this->getConnection();

        $count = count($files['file']['name']);

        for($i=0; $i<$count; $i++) {
            $dirname = "../img/";
            $fileName = md5(time()) . basename($files['file']['name'][$i]);
            $uploadFile = $dirname . $fileName;
            if (move_uploaded_file($files['file']['tmp_name'][$i], $uploadFile)) {
                if($connection->query("INSERT INTO images (way) VALUES ('$uploadFile')")) {
                    $imageIdQuery = $connection->query("SELECT id FROM images WHERE way = '$uploadFile'");
                    $imageId = $imageIdQuery->fetch();
                    if($imageId){
                        $connection->query("INSERT INTO news_images (news_id, img_id) VALUES ('$articleId','$imageId[id]')");
                    }
                }
            }
        }
    }

    /**
     * @param $newId int id of new
     * @return mixed array of new
     */
    public function getNewInfo ($newId)
    {
        $connection = $this->getConnection();

        $newQuery = $connection->query("SELECT * FROM news WHERE id = {$newId}");
        $newQuery->setFetchMode(2);
        $result = $newQuery->fetch();
        return $result;
    }

    /**
     * @param $newId int if of new
     * @return array ways of images for current new
     */
    public function getImages ($newId)
    {
        $connection = $this->getConnection();

        $queryImgId = $connection->query("SELECT img_id FROM news_images WHERE news_id = {$newId}");
        $queryImgId->setFetchMode(2);
        $result = $queryImgId->fetchAll();
        $waysArray = array();
        foreach ($result as $item){
            $waysQuery = $connection->query("SELECT way FROM images WHERE id = $item[img_id]");
            $waysQuery->setFetchMode(2);
            $way = $waysQuery->fetch();
            array_push($waysArray, $way['way']);
        }
        return $waysArray;
    }

    /**
     * @param $newId int of new
     * @return array of tags for new
     */
    public function getTags ($newId)
    {
        $connection = $this->getConnection();

        $queryTagId = $connection->query("SELECT tag_id FROM news_tags WHERE news_id = {$newId}");
        $queryTagId->setFetchMode(2);
        $result = $queryTagId->fetchAll();
        $waysArray = array();
        foreach ($result as $item){
            $waysQuery = $connection->query("SELECT tag_name FROM tags WHERE id = $item[tag_id]");
            $waysQuery->setFetchMode(2);
            $way = $waysQuery->fetch();
            array_push($waysArray, $way['tag_name']);
        }
        return $waysArray;
    }

    /**
     * @param $tagName string
     * @return array of all news id
     */
    public function getNewsIdByTagName ($tagName)
    {
        $connection = $this->getConnection();

        $queryTagId = $connection->query("SELECT id FROM tags WHERE tag_name = '$tagName'");
        $queryTagId->setFetchMode(2);
        $tag = $queryTagId->fetch();
        $tag = $tag['id'];

        $newsIdQuery = $connection->query("SELECT news_id FROM news_tags WHERE tag_id = '$tag'");
        $newsIdQuery->setFetchMode(2);
        $newsId = $newsIdQuery->fetchAll();
        $result = array();
        foreach ($newsId as $item){
            array_push($result,$item['news_id']);
        }
        return $result;
    }

    /**
     * @param $category string name of Category (first letter Big)
     * @param $articleId int new id
     * @return bool return TRUE if article belong to given category
     */
    public function checkCategory ($category, $articleId)
    {
        $connection = $this->getConnection();
        $idOfCategoryQuery = $connection->query("SELECT id FROM categories WHERE category = '$category'");
        $idOfCategoryQuery->setFetchMode(2);
        $categoryId = $idOfCategoryQuery->fetch();
        $categoryId = $categoryId['id'];

        $query = $connection->query("SELECT news_id FROM news_categories WHERE category_id = '$categoryId'");
        $query->setFetchMode(2);
        $result = $query->fetchAll();
        foreach ($result as $item){
            if ($item['news_id'] == $articleId) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return array|bool Array of 3 last news with images way (miss all news without img), FALSE if not exist 3 news
     */
    public function getNewsForMainSlider ()
    {
        $connection = $this->getConnection();
        $finishArray = array();

        $query = $connection->query("SELECT * FROM news ORDER BY `date` DESC");
        $query->setFetchMode(2);
        $result = $query->fetchAll();
        foreach ($result as $item) {
            $img = $this->getImages($item['id']);
            if (count($img) == 0) {continue;}
                if (count($img) > 1) {
                    $imgway = $img[0];
                    array_push($item,$imgway);
                    array_push($finishArray,$item);
                }
                if(count($img) == 1){
                array_push($item,$img[0]);
                array_push($finishArray,$item);
                }

                if(count($finishArray) == 3){
                    return $finishArray;
                }
        }
        return false;
    }

    public function searchingInTags($val)
    {
        $connection = $this->getConnection();

        $query = $connection->query("SELECT tag_name FROM tags WHERE tag_name LIKE '%$val%'");
        $query->setFetchMode(2);
        $result = $query->fetchAll();
        $final = array();
        foreach ($result as $item){
            array_push($final, $item['tag_name']);
        }
        return $final;
    }

    /**
     * @return array of 3 top commented new during last day
     */
    public function topNews()
    {
        $connection = $this->getConnection();
        $query = $connection->query("SELECT new_id, COUNT(*) AS NEWCOUNT FROM comments WHERE `date` >= (NOW()-(60*60*60*24)) GROUP BY new_id ORDER BY NEWCOUNT DESC LIMIT 3");
        $query->setFetchMode(2);
        $result = $query->fetchAll();
        $topNewsId = array();
        foreach ($result as $item){
            array_push($topNewsId,$item['new_id']);
        }
        return $topNewsId;
    }

    public function timeTester()
    {
        $connection = $this->getConnection();
        $query = $connection->query("SELECT new_id, COUNT(*) AS NEWCOUNT FROM comments WHERE `date` >= (NOW()-1) GROUP BY new_id ORDER BY NEWCOUNT DESC LIMIT 3");
        $query->setFetchMode(2);
        $result = $query->fetchAll();
        return $result;

    }


}



?>
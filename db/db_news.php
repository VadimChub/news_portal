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

}


?>
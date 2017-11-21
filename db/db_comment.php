<?php

namespace db;


class db_comment extends db
{
    /**
     * @param $text string text of comment
     * @param $userId int
     * @param $articleId int
     * @return bool TRUE if data was inserted successful
     */
    public function saveComment ($text, $userId, $articleId)
    {
        $connection = $this->getConnection();
        $newsObject = new db_news();

        $text = htmlentities(trim($text));

        if($text == ""){ return false;}

        if($newsObject->checkCategory("Politic", $articleId)){
            $status = 1;
        } else {
            $status = 0;
        }

         $res = $connection->query("INSERT INTO comments (text, user_id, status, new_id) VALUES ('$text', '$userId', '$status', '$articleId')");

        if($res){
            return true;
        }
        return false;
    }

    /**
     * @param $commentId int
     * @return string html text of comment
     */
    public function makeComment ($commentId)
    {
        $conneection = $this->getConnection();

        $query = $conneection->query("SELECT * FROM comments WHERE id = '$commentId'");
        $query->setFetchMode(2);
        $array = $query->fetch();
        $nameOfCommentator = $this->getCommentatorName($array['user_id']);

        return <<<HERE
<span class="comment-p"><li class="list-group-item d-flex justify-content-between align-items-center">
                    <small id="commentator-info" comid="$commentId" class="form-text text-muted">$array[date]| $nameOfCommentator</small>
                    <p class="commented-text">$array[text]</p>
                    <span class="badge badge-primary badge-pill">$array[points]</span>
                </li>
                    <p class="test1"><span class="badge badge-pill badge-secondary additional-comment">comment</span>
                     <span class="badge badge-pill badge-danger comment-minus">-</span>
                     <span class="badge badge-pill badge-success comment-plus">+</span></p>
</span>
HERE;
    }

    /**
     * @param $articleId int
     * @return array of all comment for new
     */
    public function getAllComments ($articleId)
    {
        $connection = $this->getConnection();

        $query = $connection->query("SELECT * FROM comments WHERE new_id = '$articleId' ORDER BY points DESC, `date` DESC");
        $query->setFetchMode(2);
        $result = $query->fetchAll();

        return $result;
    }

    /**
     * @param $articleId int
     * @return array of all comment for new
     */
    public function getAllCommentsByUserId ($userId)
    {
        $connection = $this->getConnection();

        $query = $connection->query("SELECT * FROM comments WHERE user_id = '$userId' ORDER BY points DESC, `date` DESC");
        $query->setFetchMode(2);
        $result = $query->fetchAll();

        return $result;
    }

    /**
     * @param $id int
     * @return mixed string name of commentator
     */
    public function getCommentatorName($id)
    {
     $connection = $this->getConnection();

     $query = $connection->query("SELECT `name` FROM users WHERE id = '$id'");
     $query->setFetchMode(2);
     $result = $query->fetch();
     return $result['name'];
    }

    /**
     * @param $text string text of comment
     * @param $userId int
     * @param $articleId int
     * @return mixed int id of comment
     */
    public function getCommentId ($text, $userId, $articleId)
    {
        $connection = $this->getConnection();
        $text = htmlentities(trim($text));

        $query = $connection->query("SELECT id FROM comments WHERE text = '$text' AND user_id = '$userId' AND new_id = '$articleId'");
        $query->setFetchMode(2);
        $result = $query->fetch();
        return $result['id'];
    }

    public function plusPoints($commentId, $commentatorId)
    {
        $connection = $this->getConnection();

        $query = $connection->query("SELECT * FROM comment_points WHERE comment_id = '$commentId' AND user_id = '$commentatorId'");
        $query->setFetchMode(2);
        $res = $query->fetch();
        //if already exist plus from this user return FALSE
        if ($res){
            return false;
        }
        $query2 = $connection->query("INSERT INTO comment_points (comment_id, user_id) VALUES ('$commentId', '$commentatorId')");
        if ($query2){
           return true;
       }
       return false;
    }

    public function minusPoints($commentId, $commentatorId)
    {
        $connection = $this->getConnection();

        $query = $connection->query("SELECT * FROM comment_points WHERE comment_id = '$commentId' AND user_id = '$commentatorId'");
        $query->setFetchMode(2);
        $res = $query->fetch();
        //if already exist plus from this user DELETE IT
        if ($res){
            $query2 = $connection->query("DELETE FROM comment_points WHERE comment_id = '$commentId' AND user_id = '$commentatorId'");
            if ($query2){
                return true;
            }
        }
        return false;
    }

    public function countPoints ($commentId)
    {
        $connection = $this->getConnection();

        $query = $connection->query("SELECT COUNT(*) FROM comment_points WHERE comment_id = '$commentId'");
        $query->setFetchMode(2);
        $res = $query->fetch();
        $result = intval($res['COUNT(*)']);
        $connection->query("UPDATE comments SET points = '$result' WHERE id = '$commentId'");
        return $result;

    }


    public function getAllSubComments ($commentId)
    {
        $connection = $this->getConnection();

        $query = $connection->query("SELECT * FROM subcomment WHERE comment_id = '$commentId' ORDER BY `date` DESC");
        $query->setFetchMode(2);
        $result = $query->fetchAll();

        return $result;
    }

    public function saveSubComment ($text, $userId, $commentId)
    {
        $connection = $this->getConnection();

        $text = htmlentities(trim($text));

        if($text == ""){ return false;}


        $res = $connection->query("INSERT INTO subcomment (text, user_id, comment_id) VALUES ('$text', '$userId', '$commentId')");

        if($res){
            return true;
        }
        return false;
    }


    public function makeSubComment ($commentId)
    {
        $conneection = $this->getConnection();

        $query = $conneection->query("SELECT * FROM subcomment WHERE id = '$commentId'");
        $query->setFetchMode(2);
        $array = $query->fetch();
        $nameOfCommentator = $this->getCommentatorName($array['user_id']);

        return <<<HERE
 <li class="list-group-item list-group-item-secondary sub-comment">
                        <small id="comment-info" subcomid="$array[id]" class="form-text text-muted">$array[date] | $nameOfCommentator</small>
                        $array[text]
                    </li>
HERE;
    }

    public function getSubCommentId ($text, $userId, $commentId)
    {
        $connection = $this->getConnection();
        $text = htmlentities(trim($text));

        $query = $connection->query("SELECT id FROM subcomment WHERE text = '$text' AND user_id = '$userId' AND comment_id = '$commentId'");
        $query->setFetchMode(2);
        $result = $query->fetch();
        return $result['id'];
    }










}
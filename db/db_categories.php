<?php
namespace db;
require_once "db.php";
use PDO;
class db_categories extends db
{
    /**
     * @param $category_name string
     */
    public function addCategory ($category_name)
    {
        $db = $this->getConnection();
        $stmt = $db->prepare("INSERT INTO categories (category) VALUES (?)");
        $stmt->bindParam(1,$category_name);
        $stmt->execute();
    }

    /**
     * @param $statement string SQL-adapted SELECT query
     * @return array
     */
    public function getValues ($statement)
    {
        $db = $this->getConnection();
        $result = $db->query($statement);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        return $result->fetchAll();
    }
}
<?php
namespace helpers;
use db\db;
use db\db_categories;

class category_builder
{
    private $arrayOfCategories;

    /**
     * @return array
     */
    public function getArrayOfCategories()
    {
        return $this->arrayOfCategories;
    }

    /**
     * @param $arr array from DB given by array fetchAll()
     * @return array of Categories
     */
    private function categoriesIterator ($arr)
    {
        $arrayOfCategories = array();
        foreach ($arr as $values){
            foreach ($values as $key=>$value){
                array_push($arrayOfCategories,$value);
            }
        }
        return $arrayOfCategories;
    }

    public function categoriesSelector ()
    {
        $obj = new db_categories("mysql:host=localhost;dbname=news","root");
        $array = $obj->getValues("SELECT category FROM categories");
        $res = $this->categoriesIterator($array);
        $this->arrayOfCategories = $res;
    }

    /**
     * @param $nameOfCategory string
     * @return array of news (id,title,views,text,date) fields
     */
    public function getArrayOfNewsByCategoryName ($nameOfCategory, $start=0)
    {
        $object = new db();
        $dbObject = $object->getConnection();

        //here we get id of needed category and put it on $caegoryId variable
        $categoryIdQuery = $dbObject->query("SELECT id FROM categories WHERE category = '$nameOfCategory'");
        $categoryIdArray = $categoryIdQuery->fetch();
        $categoryId = $categoryIdArray['id'];

        $newsArrayQuery = $dbObject->query("SELECT 
                                                      news.id,
                                                      news.title,
                                                      news.views,
                                                      news.text,
                                                      news.date
                                                      FROM news_categories 
                                                      JOIN news ON news.id = news_categories.news_id
                                                      WHERE news_categories.category_id = '$categoryId' ORDER BY news.date DESC LIMIT {$start},5");
        $newsArrayQuery->setFetchMode(\PDO::FETCH_ASSOC);
        $arrayOfNews = $newsArrayQuery->fetchAll();

        return $arrayOfNews;
    }


}
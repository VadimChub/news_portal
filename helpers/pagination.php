<?php

namespace helpers;
use db\db;

class pagination extends db
{
    /**
     * @param $categoryId int
     * @return int quantity of news in the category
     */
    public function paginationCount ($categoryId)
    {
        $connection = $this->getConnection();
        $query = $connection->query("SELECT COUNT(*) FROM news_categories WHERE category_id = '$categoryId'");
        $queryArray = $query->fetch();
        return intval($queryArray[0]);
    }

    //передаем в строке запроса параметр с какой записи мы выводим статью
    //на следующей странице просто плюсуем 5 значений
    //в зависимости от нажатой кнопки формируем ссылку в параметре передаем высчитаное значение переменной


}
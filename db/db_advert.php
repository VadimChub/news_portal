<?php

namespace db;


class db_advert extends db
{

    public function getAdverts()
    {
        $connection = $this->getConnection();
        $query = $connection->query("SELECT * FROM advert");
        $query->setFetchMode(2);
        $advert = $query->fetchAll();
        return $advert;
    }

    public function updateAdvert($adPosition, $title, $price, $owner)
    {
        $connection = $this->getConnection();
        $query = $connection->query("UPDATE advert SET title='$title', price='$price', owner='$owner' WHERE id = '$adPosition'");
        return $query;
    }

    public function deleteAdvert($adPosition)
    {
        $connection = $this->getConnection();
        $query = $connection->query("UPDATE advert SET title='Here can be your text', price='50', owner='NewsPortal' WHERE id = '$adPosition'");
        return $query;
    }

    public function generatePassword($length = 8){
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }

}
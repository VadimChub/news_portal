<?php

namespace db;


class db_settings extends db
{

    public function setNavMode($mode)
    {
        $connection = $this->getConnection();
        $query = $connection->query("UPDATE settings SET mode = '$mode'");
        return $query;
    }

    public function getNavMode()
    {
        $connection = $this->getConnection();
        $query = $connection->query("SELECT mode FROM settings");
        $query->setFetchMode(2);
        $res = $query->fetch();
        return intval($res['mode']);
    }

}
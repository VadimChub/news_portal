<?php

namespace db;


class db_user extends db
{
    public function saveUser ($name, $pass, $email)
    {
        if($this->userDataExist($name, $pass, $email) && $this->emailValidation($email)){

            $userName = htmlentities(trim($name));
            $userEmail = trim($email);
            $userPass = $this->passwordMaker($pass);

        $connection = $this->getConnection();

        $query = $connection->query("INSERT INTO users (`name`, email, password) VALUES ('$userName', '$userEmail', '$userPass')");

        if($query){
            return true;
        } else {
            return false;
        }

        } else {
            return false;
        }
    }

    /**
     * @param $email string
     * @return bool true if user alredy exist, false if not exist
     */
    private function checkUserExist ($email)
    {
        $connection = $this->getConnection();
        $query = $connection->query("SELECT * FROM users WHERE email = '$email'");
        $query->setFetchMode(2);
        $res = $query->fetch();

        if($res){
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $pass string given pass
     * @return string hashed password
     */
    private function passwordMaker ($pass)
    {
        $password = htmlentities(trim($pass));
        $password = hash('sha256', $password);
        return $password;
    }

    /**
     * @param $email string
     * @return mixed bool TRUE if email format is correct
     */
    private function emailValidation ($email)
    {
        $bool = filter_var($email, FILTER_VALIDATE_EMAIL);
        return $bool;
    }

    /**
     * @param $name string username
     * @param $pass string userpass
     * @param $email string user email
     * @return bool true if data is not empty, false if one of params is empty
     */
    private function userDataExist ($name, $pass, $email)
    {
        if (isset($name) && isset($pass) && isset($email)) {
            return true;
        }
        else return false;
    }




}
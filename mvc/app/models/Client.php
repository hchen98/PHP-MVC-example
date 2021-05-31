<?php

class Client extends Database
{
    public $name;
    public $email;

    public static function getAllRecord($query, $params = array())
    {
        /**
         * 
         * Override the func inside Database class
         * 
         * fetch all records from query result
         * INPUT
         * :query (str) sql statement
         * :params (associative arr) optional parameters for the sql statement
         * OUTPUT: return desired records
         * */

        $statement = Database::connect()->prepare($query);

        foreach ($params as $key => $val) {
            $statement->bindValue(":" . $key, $val);
            // print_r($key. " ".$val);
        }

        $statement->execute($params);

        $data = $statement->fetchAll();
        return $data;
    }

    public static function getSingleRecord($query, $params = array())
    {
        /**
         * 
         * Override the func inside Database class
         * 
         * fetch top one record from the query result
         * INPUT
         * :query (str) sql statement
         * :params (associative arr) optional parameters for the sql statement
         * OUTPUT: return a desired records
         * */

        $statement = Database::connect()->prepare($query);

        foreach ($params as $key => $val) {
            $statement->bindValue(":" . $key, $val);
        }

        $statement->execute($params);

        $data = $statement->fetch();
        return $data;
    }
}

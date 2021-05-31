<?php

require_once '../app/config/constant.php';

class Database {

    public static function connect() {
        /**
         * mysql connection through PDO
         * */ 

        $pdo = new PDO("mysql:host=".HOST.";dbname=".DB.";charset=utf8", USERNAME, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function getAllRecord($query, $params = array()) {
        /**
         * fetch all records from query result
         * INPUT
         * :query (str) sql statement
         * :params (associative arr) optional parameters for the sql statement
         * OUTPUT: return desired records
         * */ 

        $statement = self::connect()->prepare($query);

        foreach($params as $key => $val)
        {
            $statement->bindValue(":".$key, $val);
            // print_r($key. " ".$val);
        }

        $statement->execute($params);

        $data = $statement->fetchAll();
        return $data;
        
    }

    public static function getSingleRecord($query, $params = array()) {
        /**
         * fetch top one record from the query result
         * INPUT
         * :query (str) sql statement
         * :params (associative arr) optional parameters for the sql statement
         * OUTPUT: return a desired records
         * */ 

        $statement = self::connect()->prepare($query);

        foreach($params as $key => $val)
        {
            $statement->bindValue(":".$key, $val);
        }

        $statement->execute($params);

        $data = $statement->fetch();
        return $data;
    }
    
}

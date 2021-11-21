<?php
require_once(__DIR__ . '/Connection.php');

class QueryBuilder
{
    public static function EXCQuery($query, $params = [])
    {
        $statement = Connection::GetConnection()->prepare($query);
        $check = $statement->execute($params);

        if (explode(' ', $query)[0] == "SELECT") {
            return $statement->fetchAll();
        } else {
            return $check;
        }
    }

    public static function execute($query)
    {
        $statement = Connection::GetConnection();
        $result = $statement->query($query);
        if (!$result) {
            return false;
        }
        return true;
    }

}
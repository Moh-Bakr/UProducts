<?php
require_once(__DIR__ . '/../Core/QueryBuilder.php');

class FetchProductRequest
{
    public static function FetchAll()
    {
        $query = "SELECT * FROM products";
        return QueryBuilder::EXCQuery($query);
    }
}
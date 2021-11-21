<?php
require_once(__DIR__ . '/../Core/Connection.php');
require_once(__DIR__ . '/../Core/QueryBuilder.php');
require_once(__DIR__ . '/../scripts/Autoload.php');

class RDProductRequest
{
    public static function FetchAll()
    {
        $query = "SELECT * FROM products";
        return QueryBuilder::EXCQuery($query);
    }

    public static function DeleteP()
    {
        $products = $_POST['products'] ?? NULL;
        if ($products != NULL) {
            foreach ($products as $product) {
                $id = substr($product, 7, strlen($product) - 7);
                self::delete(intval($id));
                Autoload::autoloader();
            }
        }
    }

    public static function delete($id = NULL)
    {
        return QueryBuilder::EXCQuery("DELETE FROM products WHERE id=:id", [':id' => $id]);
    }
}
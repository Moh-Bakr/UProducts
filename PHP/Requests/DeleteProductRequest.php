<?php
require_once(__DIR__ . '/../Core/QueryBuilder.php');
require_once(__DIR__ . '/../scripts/Autoload.php');

class DeleteProductRequest
{
    public static function DeleteProducts()
    {
        $products = $_POST['products'] ?? NULL;
        if ($products != NULL) {
            foreach ($products as $product) {
                $id = substr($product, 7, strlen($product) - 7);
                self::Delete(intval($id));
                Autoload::autoloader();
            }
        }
    }

    public static function Delete($id = NULL)
    {
        return QueryBuilder::EXCQuery("DELETE FROM products WHERE id=:id", [':id' => $id]);
    }
}
<?php
require_once(__DIR__ . '/../Requests/AddProductRequest.php');
require_once(__DIR__ . '/../Requests/RDProductRequest.php');

class ProductController
{

    public static function Index()
    {
        $products = RDProductRequest::FetchAll();
        $request = Self::DeleteProducts();
        require_once(__DIR__ . '/../Views/ components/product-list.php');
    }

    public static function CreateProduct()
    {
        require_once(__DIR__ . '/../Views/ components/add-product.php');
    }

    public static function DeleteProducts()
    {
        RDProductRequest::DeleteP();
    }
    public static function Error()
    {
        require_once(__DIR__ . '/../Views/layouts/error.php');
    }

}









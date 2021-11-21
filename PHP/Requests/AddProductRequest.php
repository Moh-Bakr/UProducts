<?php
require_once(__DIR__ . '/../Core/Connection.php');
require_once(__DIR__ . '/../Core/QueryBuilder.php');

class AddProductRequest
{
    private $conn;
    public $db_table = "products";
    public $sku;
    public $name;
    public $price;
    public $type;
    public $size;
    public $weight;
    public $height;
    public $width;
    public $length;
    public $data;

    public function __construct($data, $db)
    {
        $this->conn = $db;
        $this->data = $data;
//        $sku = $data['sku'];
//        $name = $data['name'];
//        $price = $data['price'];
//        $type = $data['type'];
//        $size = $data['size'] ?? NULL;
//        $weight = $data['weight'] ?? NULL;
//        $height = $data['height'] ?? NULL;
//        $width = $data['width'] ?? NULL;
//        $length = $data['length'] ?? NULL;
    }

    public function createProducts()
    {
        $sku = $this->data['sku'];
        $name = $this->data['name'];
        $price = $this->data['price'];
        $type = $this->data['type'];
        $size = $this->data['size'] ?? NULL;
        $weight = $this->data['weight'] ?? NULL;
        $height = $this->data['height'] ?? NULL;
        $width = $this->data['width'] ?? NULL;
        $length = $this->data['length'] ?? NULL;

//        try {
//            $sql = "INSERT INTO products (sku, name, price,type, size, weight, height, width, length) VALUES('$sku', '$name', '$price', '$type', '$size', '$weight',
//                    '$height', '$width', '$length')";
//            $this->conn->exec($sql);
//        } catch (PDOException $e) {
//            echo '<div class="error text - danger text - md - center font - weight - bold ">'
//                . "$sql " . " < br />" . $e->getMessage() . '</div>';
//        }
        $sql = "INSERT INTO products (sku, name, price,type, size, weight, height, width, length) VALUES('$sku', '$name', '$price', '$type', '$size', '$weight',
                    '$height', '$width', '$length')";
        QueryBuilder::execute($sql);
    }

}

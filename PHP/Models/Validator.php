<?php
require_once(__DIR__ . '/../Requests/AddProductRequest.php');
require_once(__DIR__ . '/../Core/Connection.php');

class validator
{
    private $data;
    private $errors = [];
    private static $fields = [];

    public function __construct($post_data)
    {
        $this->data = $post_data;
    }

    public function validateform()
    {
        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                echo '<div class="error text-danger text-md-center font-weight-bold ">'
                    . "$field is not found " . "<br/>" . '</div>';
                return;
            }
        }
        $this->ValidateSku();
        $this->ValidateName();
        $this->ValidatePrice();
        $this->ProductType();

        if (empty($this->errors)) {
            $db = Connection::GetConnection();
            $S_Data = new AddProductRequest($this->data, $db);
            $S_Data->createProducts();
            header('Location: ' . '/');
        }
        return $this->errors;
    }

    private function ValidateSku()
    {
        $val = trim($this->data['sku']);
        $rule = '/^[-@.\/#&+\w\s]*$/';
        if (!$this->required($val, "sku")) {
            if (!($this->max($val, "sku", 30))) {
                if (!($this->regular_expression($rule, $val, "sku"))) {
                    $this->unique($val, "sku");
                }
            }
        }
    }

    private function ValidateName()
    {
        $val = trim($this->data['name']);
//        $rule = '/^[a-zA-Z0-9]{6,12}$/';
        $rule = '/^[-@.\/#&+\w\s]*$/';
        if (!($this->required($val, "name"))) {
            if (!($this->max($val, "name", 25))) {
                $this->regular_expression($rule, $val, "name");
            }
        }
    }

    private function ValidatePrice()
    {
        $val = trim($this->data['price']);
        if (!($this->required($val, "price"))) {
            if (!($this->max($val, "price", 5))) {
                $this->digits($val, "price");
            }
        }
    }

    private function ProductType()
    {
        $val = trim($this->data['type']);
        $size = trim($this->data['size']);
        $weight = trim($this->data['weight']);
        $length = trim($this->data['length']);
        $height = trim($this->data['height']);
        $width = trim($this->data['width']);
        if (!empty($val) && $val != 'DVD' && $val != 'Furniture' && $val != 'Book') {
            $this->addError('type', 'Type is Required');
        } elseif ($val == 'DVD') {
            if (!($this->required($size, "size"))) {
                if (!($this->max($size, "size", 5))) {
                    $this->digits($size, "size");
                }
            }
        } elseif ($val == 'Book') {
            if (!($this->required($weight, "weight"))) {
                if (!($this->max($weight, "weight", 5))) {
                    $this->digits($weight, "weight");
                }
            }
        } elseif ($val == 'Furniture') {
            $this->Furniture($length, $height, $width);
        }
    }

    public function required($val, $key)
    {
        if (empty($val)) {
            $this->addError($key, "$key is required");
            return true;
        }
    }

    private function regular_expression($rule, $val, $key)
    {
        if (!preg_match($rule, $val)) {
            $this->addError($key, "$key must not contains any special char");
            return true;
        }
    }

    private function max($val, $key, $max)
    {
        if (strlen($val) > $max) {
            $this->addError($key, "$key must not exceed $max char");
            return true;
        }
    }

    private function unique($val, $key)
    {
        $sql = "SELECT COUNT(*) sku from products WHERE sku ='" . $val . "'";
        $database = new Connection();
        $db = $database->getConnection();
        $count = $db->prepare($sql);
        $count->execute();
        if ($count->fetchColumn() > 0) {
            $this->addError($key, "$key aleady exists , must be unique");
        }
    }


    private function digits($val, $key)
    {
        if (!is_numeric($val)) {
            $this->addError($key, "$key must be a number");
        }
    }

    private function Furniture($length, $height, $width)
    {
        if (!($this->required($length, "length"))) {
            if (!($this->max($length, "length", 5))) {
                $this->digits($length, "length");
            }
        }
        if (!($this->required($height, "height"))) {
            if (!($this->max($height, "height", 5))) {
                $this->digits($height, "height");
            }
        }
        if (!($this->required($width, "width"))) {
            if (!($this->max($width, "width", 5))) {
                $this->digits($width, "width");
            }
        }
    }

    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }
}
<?php

class Rules
{
    public $errors = [];

    public function required($val, $key)
    {
        if (empty($val)) {
            $this->addError($key, "$key is required");
            return true;
        }
    }

    public function regular_expression($rule, $val, $key)
    {
        if (!preg_match($rule, $val)) {
            $this->addError($key, "$key must not contains any special char");
            return true;
        }
    }

    public function max($val, $key, $max)
    {
        if (strlen($val) > $max) {
            $this->addError($key, "$key must not exceed $max char");
            return true;
        }
    }

    public function unique($val, $key)
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


    public function digits($val, $key)
    {
        if (!is_numeric($val)) {
            $this->addError($key, "$key must be a number");
        }
    }

    public function Furniture($length, $height, $width)
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

    public function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }

}
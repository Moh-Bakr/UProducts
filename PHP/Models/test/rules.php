<?php
require_once('input.php');
require_once('validator.php');
require_once('product.php');

class rules
{
    public static function rule()
    {
        if (Input::Exits()) {
            $validator = new validator();
            $validation = $validator->check($_POST, [
                'sku' => [
                    'required' => true,
                    'min' => 2,
                    'max' => 20,
                    'unique' => 'products'
                ],
                'name' => [
                    'required' => true,
                    'min' => 2,
                    'max' => 20,
                    'regular_expression' => '/^[a-zA-Z0-9]{6,12}$/',
                ],
                'price' => [
                    'required' => true,
                    'min' => 1,
                    'max' => 5,
                    'digits' => true,
                ],
                'size'=>[
                    'req_test'=>true,
                    'digits' => true,
                ]
            ]);


                if ($validation->passed) {

                    $data = [
                        'sku' => Input::GetInput('sku'),
                        'price' => Input::GetInput('price'),
                        'name' => Input::GetInput('name'),
                    ];
//                $type = Input::GetInput('type');
                    echo $data['sku'];
                    $product = new Product($data);
                } else {
                    foreach ($validation->errors() as $error) {
                        echo $error, '<br>';
                    }
                };
        }
    }

}

$test = new rules();
$test->rule();
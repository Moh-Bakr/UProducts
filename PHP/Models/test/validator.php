<?php

class validator
{
    public $passed = false,
        $errors,
        $db = null;

//    public function __construct()
//    {
//        $this->db= DB::getinstance();
//    }
    public function check($source, $items)
    {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {
                $value = $source[$item];
                $item = htmlspecialchars($item);
                if ($rule === 'req_test' && Input::GetInput('type') === 'DVD' && empty($value)) {
                    require_once('../Views/layouts/scripts/types/dvd.php');
                    $this->AddError("$item is required");
                } else if ($rule === 'required' && empty($value)) {
                    $this->AddError("$item is required");
                } elseif (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->AddError
                                ("$item must be at least $rule_value characters");
                            }
                            break;
                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->AddError
                                ("$item must be at most $rule_value characters");
                            }
                            break;
                        case 'regular_expression':
                            if (!preg_match($rule_value, $value)) {
                                $this->AddError
                                ("$item must not contains any special chars ");
                            }
                            break;
//                        case 'unique':
//                            $check = $this->db->get($rule_value, [$item, '=', $value]);
//                            if ($check->count()) {
//                                $this->AddError("{$item} Must be unique");
//                            }
//                            break;
                        case 'digits':
                            if (!is_numeric($value)) {
                                $this->AddError
                                ("$item must be a number");
                            }
                            break;
                    }

                }
            }
        }
        if (empty($this->errors)) {
            $this->passed = true;

        }
        return $this;
    }

    private function AddError($error)
    {
        $this->errors[] = $error;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function passed()
    {
        return $this->passed;
    }
}
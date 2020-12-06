<?php

namespace App;

class HandleForm
{
    /**
     * Validation rules
     * More available at https://www.w3resource.com/php/form/php-form-validation.php
     *
     * @param string $type
     * @param mixed $value
     * @return bool
     */
    public static function validate($value, $type)
    {
        switch ($type) {
            case 'email':
            case 'user_name':
            case 'login':
            case 'body':
            case 'required':
                return !empty($value);
            case 'alphabets':
                preg_match('/^[a-zA-Z]*$/', $value, $matches);
                return !empty($value) && $matches[0];
            case 'numbers':
                preg_match('/^[0-9]*$/', $value, $matches);
                return !empty($value) && $matches[0];
            case 'date(m/d/y)':
                $array = explode("/", $value);
                return !empty($value) && checkdate($array[0], $array[1], $array[2]);
            case 'date(m-d-y)':
                $array = explode("-", $value);
                return !empty($value) && checkdate($array[0], $array[1], $array[2]);
            case 'date(d/m/y)':
                $array = explode("/", $value);
                return !empty($value) && checkdate($array[1], $array[0], $array[2]);
            case 'date(d.m.y)':
                $array = explode(".", $value);
                return !empty($value) && checkdate($array[1], $array[0], $array[2]);
            case 'date(d-m-y)':
                $array = explode("-", $value);
                return !empty($value) && checkdate($array[1], $array[0], $array[2]);
            case 'past':
                return !empty($value) && strtotime($value) < strtotime('now');
            case 'present':
                return !empty($value) && strtotime($value) === strtotime('now');
            case 'future':
                return !empty($value) && strtotime($value) > strtotime('now');
            default:
                return false;
        }
    }

}

<?php

namespace App\Aplication\lib;

final class Validate
{
    public function obligatory($data)
    {
        if (empty($data) || $data === '') {
            return false;
        }
        return true;
    }

    public function date($date)
    {
        $values = explode('-', $date);
        if (
            count($values) !== 3 &&
            !checkdate($values[1], $values[2], $values[0])
        ) {
            return false;
        }
        return true;
    }

    public function text($text, $min, $max)
    {
        $regex = ["options" => ["regexp" => '/^[ a-z|A-Z|ñáéíóú]*$/']];

        if (isset($text) === false || $text === '') {
            return false;
        }
        if (!filter_var($text, FILTER_VALIDATE_REGEXP, $regex)) {
            return false;
        }
        if (strlen($text) < $min || strlen($text) > $max) {
            return false;
        }
        return true;
    }

    public function number($num, $min, $max)
    {
        $regex = ["options" => ["regexp" => '/^[.0-9]*$/']];

        if (isset($num) === false || $num === '') {
            return false;
        }
        if (!filter_var($num, FILTER_VALIDATE_REGEXP, $regex)) {
            return false;
        }
        if (strlen($num) < $min || strlen($num) > $max) {
            return false;
        }
        return true;
    }

    public function email($mail, $min, $max)
    {
        if (isset($mail) === false || $mail === '') {
            return false;
        }
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        if (strlen($mail) < $min || strlen($mail) > $max) {
            return false;
        }
        return true;
    }

    public function password($pass)
    {
        $regex = ["options" => ["regexp" => '/(?=(.*[0-9]))((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.{8,20}$/']];

        if (!isset($pass) || $pass === '') {
            return false;
        }
        if (!filter_var($pass, FILTER_VALIDATE_REGEXP, $regex)) {
            return false;
        }
        return true;
    }

    public function alphanumeric($data, $min, $max)
    {
        $regex = ["options" => ["regexp" => '/^[a-z, |A-Z, |áéíóú, |ÁÉÍÓÚ, |ñÑ, |0-9, ]*$/']];

        if (isset($data) === false || $data === '') {
            return false;
        }
        if (!filter_var($data, FILTER_VALIDATE_REGEXP, $regex)) {
            return false;
        }
        if (strlen($data) < $min || strlen($data) > $max) {
            return false;
        }
        return true;
    }
}

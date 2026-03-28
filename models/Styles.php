<?php
namespace models;

use core\Model;

class Styles extends Model
{
    public static $tableName = 'styles';

    public static function getAllStyles()
    {
        return self::getAll(self::$tableName);
    }
}
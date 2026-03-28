<?php
namespace models;

use core\Model;
use core\Core;

class Favorites extends Model
{
    public static $tableName = 'favorites';

    public static function addFavorite($user_id, $painting_id)
    {
        // Перевіряємо, чи вже є така картина в улюбленому, щоб уникнути дублів
        $existing = self::findByCondition(['user_id' => $user_id, 'painting_id' => $painting_id]);
        if (empty($existing)) {
            $favorite = new Favorites();
            $favorite->user_id = $user_id;
            $favorite->painting_id = $painting_id;
            $favorite->save();
            return true;
        }
        return false;
    }

    public static function removeFavorite($user_id, $painting_id)
    {
        Core::get()->db->delete(self::$tableName, ['user_id' => $user_id, 'painting_id' => $painting_id]);
    }

    public static function getFavoritesByUserId($user_id)
    {
        $sql = "SELECT f.*, p.title, p.image, a.name as artist_name 
                FROM " . self::$tableName . " f
                JOIN paintings p ON f.painting_id = p.id
                LEFT JOIN artists a ON p.artist_id = a.id
                WHERE f.user_id = :user_id 
                ORDER BY f.added_at DESC";
        $stmt = Core::get()->db->pdo->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll();
    }
}
<?php
namespace models;

use core\Model;
use core\Core;

class Paintings extends Model
{
    public static $tableName = 'paintings';

    public static function getPaintings()
    {
        $rows = self::getAll(self::$tableName);
        return !empty($rows) ? $rows : [];
    }

    public static function filterPaintings($filters = [])
    {
        $sql = "SELECT p.*, a.name as artist_name, s.name as style_name 
                FROM " . self::$tableName . " p 
                LEFT JOIN artists a ON p.artist_id = a.id 
                LEFT JOIN styles s ON p.style_id = s.id 
                WHERE 1=1";
        $params = [];

        if (!empty($filters['style_id'])) {
            $sql .= " AND p.style_id = :style_id";
            $params[':style_id'] = $filters['style_id'];
        }
        if (!empty($filters['artist_id'])) {
            $sql .= " AND p.artist_id = :artist_id";
            $params[':artist_id'] = $filters['artist_id'];
        }
        if (!empty($filters['technique'])) {
            $sql .= " AND p.technique = :technique";
            $params[':technique'] = $filters['technique'];
        }

        $sql .= " ORDER BY p.id DESC";

        $stmt = \core\Core::get()->db->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function getUniqueValues($column)
    {
        $sql = "SELECT DISTINCT $column FROM " . self::$tableName . " WHERE $column IS NOT NULL AND $column != ''";
        $stmt = \core\Core::get()->db->pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function deletePaintingById($id)
    {
        $this->db->delete('paintings', ['id' => $id]);
    }

    public function updatePaintingById($id, $newData)
    {
        $this->db->update('paintings', $newData, ['id' => $id]);
    }

    public static function addPainting($title, $description, $year_created, $technique, $dimensions, $image, $style_id, $artist_id)
    {
        $painting = new Paintings();
        $painting->title = $title;
        $painting->description = $description;
        $painting->year_created = $year_created;
        $painting->technique = $technique;
        $painting->dimensions = $dimensions;
        $painting->image = $image;
        $painting->style_id = $style_id;
        $painting->artist_id = $artist_id;
        $painting->save();
    }

    public static function getPaintingById($id)
    {
        // Отримуємо картину разом з іменами художника та стилю
        $sql = "SELECT p.*, a.name as artist_name, s.name as style_name 
                FROM " . self::$tableName . " p 
                LEFT JOIN artists a ON p.artist_id = a.id 
                LEFT JOIN styles s ON p.style_id = s.id 
                WHERE p.id = :id";
        $stmt = \core\Core::get()->db->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetchAll();
        return !empty($result) ? $result[0] : null;
    }
}
<?php
namespace models;

use core\Model;
use core\Core;

class Artists extends Model
{
    public static $tableName = 'artists';

    public static function getAllArtists()
    {
        $sql = "SELECT * FROM " . self::$tableName . " ORDER BY name ASC";
        $stmt = Core::get()->db->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public static function getArtistById($id)
    {
        $rows = self::findByCondition(['id' => $id]);
        if (!empty($rows)) {
            return $rows[0];
        }
        return null;
    }

    public function deleteArtistById($id)
    {
        $this->db->delete(self::$tableName, ['id' => $id]);
    }

    public function updateArtistById($id, $newData)
    {
        $this->db->update(self::$tableName, $newData, ['id' => $id]);
    }

    public static function addArtist($name, $years_of_life, $country, $biography, $image)
    {
        $artist = new Artists();
        $artist->name = $name;
        $artist->years_of_life = $years_of_life;
        $artist->country = $country;
        $artist->biography = $biography;
        $artist->image = $image;
        $artist->save();
    }
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class GameModel extends Model
{
    protected $table      = 'game_list';
    protected $primaryKey = 'id';
    protected $allowedFields = ['short_name', 'full_name'];
    protected $useTimestamps = false;

    public function getAll($limit = 10, $orderBy = "ASC")
    {
        $results = $this->select('short_name, full_name')
                    ->limit($limit)
                    ->orderBy('id', $orderBy)
                    ->get()
                    ->getResultArray();
                    
        $namesArray = [];

    foreach ($results as $row) {
        $namesArray[] = [
            'short_name' => $row['short_name'],
            'full_name' => $row['full_name']
        ];
    }

    return $namesArray;
    }
}

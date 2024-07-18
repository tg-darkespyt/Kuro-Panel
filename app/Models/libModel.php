<?php

namespace App\Models;

use CodeIgniter\Model;

class libModel extends Model
{
    protected $table      = 'lib';
    protected $primaryKey = 'id';
    protected $allowedFields = ['file', 'file_type', 'file_size', 'pass', 'time'];
    protected $useTimestamps = false;

    public function getAll($limit = 1, $orderBy = "DESC")
    {
        $results = $this->select('id, file, file_type, file_size, pass, time')
                    ->limit($limit)
                    ->orderBy('id', $orderBy)
                    ->get()
                    ->getResultArray();
                    
        $namesArray = [];
        foreach ($results as $row)
        {
            $namesArray[] = [
                'file' => $row['file'],
                'file_type' => $row['file_type'],
                'file_size' => $row['file_size'],
                'pass' => $row['pass'],
                'time' => $row['time']
            ];
        }
    return $namesArray;
    }
}

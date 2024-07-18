<?php

namespace App\Models;

use CodeIgniter\Model;

class _ftext extends Model
{
    /*=================================================================*/
    
    protected $table      = '_ftext';
    protected $primaryKey = 'id';
    protected $allowedFields = ['_status','_ftext'];
    public function getVal(int $id)
    {
        return $this->select('id, _status, _ftext')
                    ->where('id', $id)
                    ->get()
                    ->getRow();
    }
}
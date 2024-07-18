<?php

namespace App\Models;

use CodeIgniter\Model;

class onoff extends Model
{
    /*=================================================================*/
    
    protected $table      = 'onoff';
    protected $allowedFields = ['status', 'myinput'];
    
    public function getonoff(int $id)
    {
        return $this->select('id, status, myinput')
                    ->where('id', $id)
                    ->get()
                    ->getRow();
    }
    
}
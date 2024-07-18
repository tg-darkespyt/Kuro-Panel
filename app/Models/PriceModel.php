<?php

namespace App\Models;
use App\Models\UserModel;
use CodeIgniter\Model;

class PriceModel extends Model
{
    protected $table      = 'price';
    protected $primaryKey = 'id';
    protected $allowedFields = ['value', 'duration', 'amount', 'role'];
    protected $useTimestamps = false;

    public function getAll($limit = 100, $orderBy = "ASC")
    {
        $userModel = new UserModel();
        $user = $userModel->getUser();
        return $this->select('value, duration, amount, role')
                    ->where('role', $user->level)
                    ->limit($limit)
                    ->orderBy('id', $orderBy)
                    ->get()
                    ->getResultArray();
    }
    
    public function getAllPrice($orderBy = "ASC")
    {
        return $this->select('id, value, duration, amount, role')
                    ->orderBy('id', $orderBy)
                    ->get()
                    ->getResultArray();
    }
    
    public function getPrice($id)
    {
        return $this->select('id, value, duration, amount, role')
                    ->where('id', $id)
                    ->get()
                    ->getRow();
    }
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class Feature extends Model
{
    /*=================================================================*/
    
    protected $table      = 'Feature';
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['ESP', 'SilentAim', 'AIM','Item', 'Memory', 'BulletTrack', 'Floating', 'Setting', 'versionname', 'tg_name', 'tg_link', 'tg_dev', 'tg_devlink'];
    
    public function getFeature(int $id)
    {
        return $this->select('id, ESP, SilentAim, AIM, Item, Memory, BulletTrack, Floating, Setting, versionname, tg_name, tg_link, tg_dev, tg_devlink')
                    ->where('id', $id)
                    ->get()
                    ->getRow();
    }
}

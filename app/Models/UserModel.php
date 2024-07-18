<?php

namespace App\Models;

use CodeIgniter\Model;
use \Hermawan\DataTables\DataTable;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id_users';
    protected $allowedFields = ['email', 'username', 'fullname', 'saldo', 'level', 'status', 'uplink', 'password','user_ip', 'expiration_date'];
    protected $useTimestamps = true;
    
    /*=================================================================*/
    
    protected $table_m      = 'modname';
    protected $primaryKey_m = 'id';
    protected $allowedFields_m = ['modname'];
    
    
    /*=================================================================*/

    public function getUser($userid = false, $where = 'default')
    {
        $userid = $userid ?: session()->userid;
        $where = ($where == 'default' ? 'id_users' : $where);
        $wfind = $this->where($where, $userid)
            ->get()
            ->getFirstRow();
        return $wfind ?: NULL;
    }

    public function getUserList($select = "*")
    {
        $this->select($select);
        return $this->get()
            ->getResultObject();
    }

    public function API_getUser()
    {
        $connect = db_connect();
        $builder = $connect->table('users');

        $user = $this->getUser();
        if ($user->level != 1) {
            $builder->where('uplink', $user->username);
        }

        $builder->select('CONCAT(users.id_users) as id, username, fullname, saldo, level, status, uplink');

        return DataTable::of($builder)
            ->setSearchableColumns(['username', 'fullname', 'saldo', 'uplink'])
            ->format('fullname', function ($value) {
                return $value ? esc(word_limiter($value, 1, '')) : '';
            })
            ->format('level', function ($value) {
                return getLevel($value);
            })
            ->toJson(true);
    }

    public function checkAuthFilter()
    {
        $time = new \CodeIgniter\I18n\Time;
        $session = session();
        $time_ex = $session->time_login;
        if ($time::now()->isBefore($time_ex)) {
            $userCek = $this->getUser($session->userid);
            if ($userCek->level > 3) {
                $msg = 'Level account invalid!';
            } elseif ($userCek->status == 2) {
                $msg = 'Account has been Blocked!';
            } else {
                return $userCek;
            }
        } else {
            $msg = 'Session account expired!';
        }
        return $this->AuthSessionLogout($msg);
    }

    public function AuthSessionLogout($msg = 'Session terminate')
    {
        $list = ['userid', 'unames', 'time_login', 'time_since'];
        session()->remove($list);
        return redirect()->to('login')->with('msgDanger', $msg);
    }
}

<?php

namespace App\Controllers;

use App\Models\CodeModel;
use App\Models\UserModel;
use CodeIgniter\Config\Services;

class Auth extends BaseController
{
    protected $user;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    function getUserIP()
    {
        $clientIp  = @$_SERVER['HTTP_CLIENT_IP'];
        $forwardIp = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remoteIp  = $_SERVER['REMOTE_ADDR'];
        if(filter_var($clientIp, FILTER_VALIDATE_IP))
        {
            $ipaddress = $clientIp;
        }
        elseif(filter_var($forwardIp, FILTER_VALIDATE_IP))
        {
            $ipaddress = $forwardIp;
        }
        else
        {
            $ipaddress = $remoteIp;
        }
        return $ipaddress;
    }
    public function index()
    {
        /* ---------------------------- Debugmode --------------------------- */
        $a = $this->userModel->getUser(session('userid'));
        dd($a, session());
    }

    public function login()
    {
        if (session()->has('userid'))
            return redirect()->to('dashboard')->with('msgSuccess', 'Login Successful!');

        if ($this->request->getPost())
            return $this->login_action();
        $data = [
            'title' => 'Login',
            'validation' => Services::validation(),
        ];
        return view('Auth/login', $data);
    }

    public function register()
    {
        if (session()->has('userid'))
            return redirect()->to('dashboard')->with('msgSuccess', 'Login Successful!');

        if ($this->request->getPost())
            return $this->register_action();
        $data = [
            'title' => 'Register',
            'validation' => Services::validation(),
        ];
        return view('Auth/register', $data);
    }

    private function login_action()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $stay_log = $this->request->getPost('stay_log');

        $form_rules = [
            'username' => [
                'label' => 'username',
                'rules' => 'required|alpha_numeric|min_length[4]|max_length[25]|is_not_unique[users.username]',
                'errors' => [
                    'is_not_unique' => 'The {field} is not registered.'
                ]
            ],
            'password' => [
                'label' => 'password',
                'rules' => 'required|min_length[6]|max_length[45]',
            ],
            'stay_log' => [
                'rules' => 'permit_empty|max_length[3]'
            ]
        ];

        if (!$this->validate($form_rules)) {
            return redirect()->route('login')->withInput()->with('msgDanger', '<strong>Failed</strong> Please check the form.');
        } else {
            $validation = Services::validation();
            $cekUser = $this->userModel->getUser($username, 'username');
            if ($cekUser) {
                $hashPassword = create_password($password, false);
                if (password_verify($hashPassword, $cekUser->password)) {
                    $time = new \CodeIgniter\I18n\Time;
                    $data = [
                        'userid' => $cekUser->id_users,
                        'unames' => $cekUser->username,
                        'time_login' => $stay_log ? $time::now()->addHours(24) : $time::now()->addMinutes(30),
                        'time_since' => $time::now(),
                    ];
                    session()->set($data);
                    include('UserMail.php');
                    return redirect()->to('dashboard')->with('msgSuccess', 'Login Successful!');

                } else {
                    $validation->setError('password', 'Wrong password, please try again.');
                    return redirect()->route('login')->withInput()->with('msgDanger', '<strong>Failed</strong> Please check the form.');
                }
            }
        }
    }

    public function register_action()
    {
        $email = $this->request->getPost('email');
        $userna = $this->request->getPost('username');
        $fullname = $this->request->getPost('fullname');
        $password = $this->request->getPost('password');
        $referral = $this->request->getPost('referral');
        
        $form_rules = [
            'email' => [
                'label' => 'email',
                'rules' => 'required|min_length[13]|max_length[40]|'
            ],
            'username' => [
                'label' => 'username',
                'rules' => 'required|alpha_numeric|min_length[4]|max_length[25]|is_unique[users.username]',
                'errors' => [
                    'is_unique' => 'The {field} has been taken.'
                ]
            ],
            'fullname' => [
                'label' => 'fullname',
                'rules' => 'required|alpha_numeric|min_length[4]|max_length[25]|is_unique[users.fullname]',
                'errors' => [
                    'is_unique' => 'The {field} has been taken.'
                ]
            ],
            'password' => [
                'label' => 'password',
                'rules' => 'required|min_length[6]|max_length[45]',
            ],
            'password2' => [
                'label' => 'password',
                'rules' => 'required|min_length[6]|max_length[45]|matches[password]',
                'errors' => [
                    'matches' => '{field} not match, check the {field}.'
                ]
            ],
            'referral' => [
                'label' => 'referral',
                'rules' => 'required|min_length[6]|alpha_numeric',
            ]
        ];

        if (!$this->validate($form_rules)) {
            // Form Invalid
        } else {
            $mCode = new CodeModel();
            $rCheck = $mCode->checkCode($referral);
            $validation = Services::validation();
            if (!$rCheck) {
                $validation->setError('referral', 'Wrong referral, please try again.');
            } else {
                if ($rCheck->used_by) {
                    $validation->setError('referral', "Wrong referral, code has been used &middot; $rCheck->used_by.");
                } else {
                    $hashPassword = create_password($password);
                    $ipaddress = $_SERVER['REMOTE_ADDR'];
                    include('conn.php');
                    $sql = "SELECT `acc_expiration` FROM `referral_code` WHERE `Referral` = '".$referral."'";
                    $query = mysqli_query($conn, $sql);
                    $period = mysqli_fetch_assoc($query);
                    
                    $sql1 = "SELECT `level` FROM `referral_code` WHERE `Referral` = '".$referral."'";
                    $query1 = mysqli_query($conn, $sql1);
                    $userLevel = mysqli_fetch_assoc($query1);
                    $data_register = [
                        'email' => $email,
                        'username' => $userna,
                        'fullname' => $fullname,
                        'level' => $userLevel,
                        'password' => $hashPassword,
                        'saldo' => $rCheck->set_saldo ?: 0,
                        'uplink' => $rCheck->created_by,
                        'user_ip' => $ipaddress,
                        'expiration_date' => $period
                    ];
                    $ids = $this->userModel->insert($data_register, true);
                    if ($ids) {
                        $mCode->useReferral($referral);
                        $msg = "Register Successfuly!";
                        return redirect()->to('login')->with('msgSuccess', $msg);
                    }
                }
            }
        }
        return redirect()->route('register')->withInput()->with('msgDanger', '<strong>Failed</strong> Please check the form.');
    }

    public function logout()
    {
        if (session()->has('userid')) {
            $unset = ['userid', 'unames', 'time_login', 'time_since'];
            session()->remove($unset);
            session()->setFlashdata('msgSuccess', 'Logout successfuly.');
        }
        return redirect()->to('login');
    }
}

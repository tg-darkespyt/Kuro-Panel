<?php

namespace App\Controllers;

use App\Models\HistoryModel;
use App\Models\KeysModel;
use App\Models\UserModel;
use App\Models\GameModel;
use App\Models\PriceModel;
use Config\Services;
use CodeIgniter\I18n\Time;

class Keys extends BaseController
{
    protected $userModel, $model, $user, $userId;
    
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->user = $this->userModel->getUser();
        $this->model = new KeysModel();
        $this->time = new \CodeIgniter\I18n\Time;
        $user = $this->user;
        $this->userId=session()->get('userid');
        /* ------- Game ------- */
        $this->game = new GameModel();
        $this->prices = new PriceModel();
        
        $this->game_list = [];
        foreach ($this->game->getAll() as $game)
        {
            $this->game_list[$game['short_name']] = $game['full_name'];
        }
        
        $this->expand = [];
        $this->duration = [];
        $this->price = [];
        foreach($this->prices->getAll() as $row)
        {
            $this->expand[$row['value']] = $row['duration'];
        
            $this->duration[$row['value']] = $row['duration'] .'&mdash; ₹'.$row['amount'].'/Device';
        
            $this->price[$row['value']] = $row['amount'];
        }
        
        $this->status = [
            0 => 'Ban/Block All the Keys',
            1 => 'Active All the Keys',
        ];
        
        $this->type = [
           1 => 'All(Automatically Fetch All of your keys)',
           2 => 'Keys ID(Manually, you want to enter it)',
        ];
        
        $this->accLevel = [
           1 => 'Owner',
           2 => 'Admin',
           3 => 'Reseller',
        ];
        
     if($user->level == 1)
     {
        $this->bulk_key = [
           1 => '1 Key',
           4 => '4 Keys',
           8 => '8 Keys',
           10 => '10 Keys',
           20 => '20 Keys',
           50 => '50 Keys',
           100 => '100 Keys',
           200 => '200 Keys',

        ];
     } else {
        $this->bulk_key = [
           1 => '1 Key',
           4 => '4 Keys',
           8 => '8 Keys',
        ];
     }
    }
    
    public function index()
    {
        $model = $this->model;
        $user = $this->user;

        if ($user->level != 1) {
            $keys = $model->where('registrator', $user->username)
                ->findAll();
        } else {
            $keys = $model->select('user_key')->findAll() ;
        }
        $data = [
            'title' => 'Keys',
            'user' => $user,
            'keylist' => $keys,
            'time' => $this->time,
        ];
        return view('Keys/list', $data);
    }
    
    public function price()
    {
        $model = $this->model;
        $user = $this->user;
        $data = [
            'title' => 'Price List',
            'user' => $user,
            'price' => $this->price,
            'duration' => $this->duration,
            'time' => $this->time,
        ];
        return view('Keys/price', $data);
    }
    
public function download_all_Keys(){
    $model = $this->model;
    $user = $this->user;
    $keys = $model->select('user_key')->findAll();
    $data='';
    for($i=0;$i<count($keys);$i++){
        $data.=$keys[$i]['user_key']."\n";
    }
    write_file('Newkeys.txt', $data);
    $this->downloadFile('Newkeys.txt');
}
    
    public function download_new_Keys(){
    	$this->downloadFile('new.txt');
    }
    
    function downloadFile($yourFile){
        // $yourFile = "newName.txt";
        $file = @fopen($yourFile, "rb");
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=Allkeys.txt');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($yourFile));
        while (!feof($file)) {
            print(@fread($file, 1024 * 8));
            ob_flush();
            flush();
        }
    }
    
    public function alterKeys(){//Used Keys
    	$model=$this->model;
    	$user = $this->user;
    	$data = $model->where('registrator =', $user->username)->where('expired_date <',  date('Y-m-d H:i:s'))->delete();
    	return redirect()->back()->with('msgSuccess', 'success');
    }
    
    public function deleteKeys(){//delete all keys
    	$user = $this->user;
    	$model=$this->model;
    	$username = $user->username;
    	$data=$model->where('registrator =', $username)->delete();
    	return redirect()->back()->with('msgSuccess', 'success');
    }
    
    public function startDate(){//Un-used Keys
    	//echo  date('Y-m-d H:i:s');
    	$model=$this->model;
    	$user = $this->user;
    	$keys=$model->where('expired_date ='.null)->where('registrator =', $user->username)->delete();
    	return redirect()->back()->with('msgSuccess', 'success');
    }
    
    public function api_get_keys()
    {
        // ? API for DataTable Keys
        $model = $this->model;
        return $model->API_getKeys();
    }
    
    public function api_key_reset()
    {
        sleep(1);
        $model = $this->model;
        $keys = $this->request->getGet('userkey');
        $reset = $this->request->getGet('reset');
        $db_key = $model->getKeys($keys);
        $rules = [];
        if ($db_key) {
            $total = $db_key->devices ? explode(',', $db_key->devices) : [];
            $rules = ['devices_total' => count($total), 'devices_max' => (int) $db_key->max_devices];
            $user = $this->user;
            if ($db_key->devices and $reset) {
                if ($user->level == 1 or $db_key->registrator == $user->username) {
                    $model->set('devices', NULL)
                        ->where('user_key', $keys)
                        ->update();
                        $model->set('expired_date', NULL)
                        ->where('user_key', $keys)
                        ->update();
                    $rules = ['reset' => true, 'devices_total' => 0, 'devices_max' => $db_key->max_devices];
                }
            } else {
            }
        }
        $data = [
            'registered' => $db_key ? true : false,
            'keys' => $keys,
        ];
        $real_response = array_merge($data, $rules);
        return $this->response->setJSON($real_response);
    }
    
    public function extend()
    {
        if($this->request->getPost())
            return $this->extend_action();
            
        $msgDanger = "The user key no longer exists.";
        $user = $this->user;
        $model = $this->model;
        $dKey = $model->select('id_keys')->where('registrator', $user->username)->findAll();
        if ($dKey != 0) {
             $validation = Services::validation();
             $data = [
                  'title' => 'Extend',
                  'user' => $user,
                  'id_keys' => $dKey,
                  'key' => $dKey,
                  'type' => $this->type,
                  'expired_date' => $this->expand,
                  'status' => $this->status,
                  'time' => $this->time,
                  'messages' => setMessage('Please carefuly edit information'),
                  'validation' => $validation,
             ];
             return view('Keys/extend', $data);
        } else {
             $msgDanger = "No keys was created by you to extend.";
        }
    }
    private function extend_action()
    {
        $keys_id = [];
        $alreadyexpdate = [];
        $user = $this->user;
        $model = $this->model;
        
        include('conn.php');
        $db = \Config\Database::connect();
        $query = $db->table('keys_code')->where('expired_date IS NOT NULL')->where('registrator', $user->username)->get();
        $results = $query->getResult();
        
        if($this->request->getPost('type') == 1)
        {
            foreach ($results as $result)
            {
                 $keys_id[] .= $result->id_keys;
                 $alreadyexpdate[] .= $result->expired_date;
            }
        }
        
        if($this->request->getPost('type') == 2)
        {
            $input = $this->request->getPost('keys_id');
            $keys_iddd = explode(" ", $input);
            $sub = substr_count($input, " ");
            
            for($i=0; $i<=$sub; $i++)
            {
                 $keys_id[] .= $keys_iddd[$i];
            }
            
            foreach($keys_id as $key)
            {
                 $samp = $db->table('keys_code')->where('id_keys', $key)
                 ->where('expired_date IS NOT NULL')
                 ->where('registrator', $user->username)->get();
                 $values = $samp->getResult();
            
            foreach($values as $value)
            {
                 $alreadyexpdate[] .= $value->expired_date;
            }
            }
        }
        
        $durateee = $this->request->getPost('expired_date');
        $statusss = $this->request->getPost('status');
        
        if(isset($statusss))
        {
            $db->table('keys_code')->where('registrator', $user->username)->update(['status' => $statusss]);
            return redirect()->back()->with('msgSuccess', 'All[OWN] Keys successfully changed Status!');
        }

        foreach (array_combine($keys_id, $alreadyexpdate) as $keys => $aexp)
        {
            $exp = Time::parse($aexp)->addHours($durateee);
            $db->table('keys_code')->where('expired_date IS NOT NULL')
            ->where('expired_date', $aexp)
            ->where('registrator', $user->username)
            ->where('id_keys', $keys)
            ->update(['expired_date' => $exp]);
        }
        return redirect()->back()->with('msgSuccess', count($keys_id) . ' keys successfully extended!');
    }
    
    public function detail()
    {
        $user = $this->user;
        
        if ($this->request->getPost())
            if ($user->level == 1)
            {
                return $this->price_detail();
	    } else {
	        return redirect()->to('dashboard')->with('msgWarning','Access Denied!');
	    }
	
        $validation = Services::validation();
        $data = [
            'title' => 'Price Details',
            'user' => $user,
            'time' => $this->time,
            'code' => $this->prices->getAllPrice(),
            'duration' => $this->expand,
            'accLevel' => $this->accLevel,
            'validation' => $validation
        ];
        return view('Keys/price_detail', $data);
    }
    
    private function hr_to_day($value)
    {
        if($value == 1) {
            return "$value Hour";
        } else if($value >= 2 && $value < 24) {
            return "$value Hours";
        } else if($value == 24) {
            $darkespyt = $value/24;
            return "$darkespyt Day";
        } else if($value > 24) {
            $darkespyt = $value/24;
            return "$darkespyt Days";
        }
    }

    private function price_detail()
    {
        $setprice = $this->request->getPost('setPrice');
        $setduration = $this->request->getPost('duration');
        $setrole = $this->request->getPost('accLevel');
        $sduration = $this->hr_to_day($setduration);
        $form_rules = [
            'setPrice' => [
                'label' => 'Set Price',
                'rules' => 'required|numeric|max_length[11]|greater_than_equal_to[0]',
                'errors' => [
                    'greater_than_equal_to' => 'Invalid currency, cannot set to minus.'
                ]
            ],
            'accLevel' => [
                'label' => 'Select Role',
                'rules' =>  'required|numeric|max_length[2]|greater_than_equal_to[1]',
                'errors' => [
                     'greater_than_equal_to' => 'Invalid Days, cannot set to expired.'
                ]
            ],
            'duration'=> [
                'label' => 'Select Duration',
                'rules' => 'required',
            ]
        ];

        if (!$this->validate($form_rules)) {
            return redirect()->back()->withInput()->with('msgDanger', 'Failed, check the form');
        } else {
            $data = [
                'value' => $setduration,
                'duration' => $sduration,
                'amount' => $setprice,
                'role' => $setrole
            ];
            $ids = $this->prices->insert($data, true);
            if ($ids)
            {
                $msg = "New Price created successfully!";
                return redirect()->back()->with('msgSuccess', $msg);
            }
        }
    }
    
    public function price_delete($id = false)
    {
        $user = $this->user;
        if ($user->level != 1)
            return redirect()->to('dashboard')->with('msgWarning', 'Access Denied!');
        
        $data=$this->prices->where('id =', $id)->delete();
        if($data)
            return redirect()->back()->with('msgSuccess', 'Deleted!');
        
    }
    
    public function price_edit($id = false)
    {
        $user = $this->user;
        if ($user->level != 1)
            return redirect()->to('dashboard')->with('msgWarning', 'Access Denied!');

        if ($this->request->getPost())
            return $this->price_edit_action();

        $validation = Services::validation();

        $data = [
            'title' => 'Edit',
            'user' => $user,
            'target' => $this->prices->getPrice($id),
            'time' => $this->time,
            'validation' => $validation,
        ];
        return view('Keys/price_edit', $data);
    }

    private function price_edit_action()
    {
        $pid = $this->request->getPost('price_id');
        $pvalue = $this->request->getPost('price_value');
        $pduration = $this->request->getPost('price_duration');
        $pamount = $this->request->getPost('price_amount');
        $prole = $this->request->getPost('price_role');
        $target = $this->prices->getPrice($pid);
        if (!$target) {
            $msg = "User no longer exists.";
            return redirect()->back()->with('msgDanger', $msg);
        }

        $form_rules = [
            'price_value' => [
                'label' => 'duration (in hours)',
                'rules' => "required|numeric|min_length[1]|max_length[4]"
            ],
            'price_duration' => [
                'label' => 'duration name',
                'rules' => 'required|min_length[4]|max_length[155]'
            ],
            'price_role' => [
                'label' => 'price roles',
                'rules' => 'required|numeric|in_list[1,2,3]',
                'errors' => [
                    'in_list' => 'Invalid {field}.'
                ]
            ],
            'price_amount' => [
                'label' => 'price amount',
                'rules' => 'required|numeric|max_length[11]|greater_than_equal_to[0]',
                'errors' => [
                    'greater_than_equal_to' => 'Invalid currency, cannot set to minus.'
                ]
            ],
        ];

        if (!$this->validate($form_rules)) {
            return redirect()->back()->withInput()->with('msgDanger', 'Something wrong! Please check the form');
        } else {
            $data_update = [
                'value' => $pvalue,
                'duration' => $pduration,
                'amount' => $pamount,
                'role' => $prole
            ];

            $update = $this->prices->update($pid, $data_update);
            if ($update) {
                return redirect()->back()->with('msgSuccess', "Successfuly update $target->duration price list.");
            }
        }
    }
    
    public function edit_key($key = false)
    {
        if ($this->request->getPost())
        return $this->edit_key_action();
        $msgDanger = "The user key no longer exists.";
        if ($key) {
            $dKey = $this->model->getKeys($key, 'id_keys');
            $user = $this->user;
            if ($dKey) {
                if ($dKey->registrator == $user->username) {
                    $validation = Services::validation();
                    $data = [
                        'title' => 'Key',
                        'user' => $user,
                        'key' => $dKey,
                        'game_list' => $this->game_list,
                        'time' => $this->time,
                        'key_info' => getDevice($dKey->devices),
                        'messages' => setMessage('Please carefuly edit information'),
                        'validation' => $validation,
                    ];
                    return view('Keys/key_edit', $data);
                } else {
                    $msgDanger = "Restricted to this user key.";
                }
            }
        }
        return redirect()->to('keys')->with('msgDanger', $msgDanger);
    }
    
    private function edit_key_action()
    {
        $keys = $this->request->getPost('id_keys');
        $user = $this->user;
        $dKey = $this->model->getKeys($keys, 'id_keys');
        $game = implode(",", array_keys($this->game_list));
        if (!$dKey) {
            $msgDanger = "The user key no longer exists~";
        } else {
            if ($dKey->registrator == $user->username) {
                $form_reseller = [
                    'status' => [
                        'label' => 'status',
                        'rules' => 'required|integer|in_list[0,1]',
                        'erros' => [
                            'integer' => 'Invalid {field}.',
                            'in_list' => 'Choose between list.'
                        ]
                    ]
                ];
                $form_admin = [
                    'id_keys' => [
                        'label' => 'keys',
                        'rules' => 'required|is_not_unique[keys_code.id_keys]|numeric',
                        'errors' => [
                            'is_not_unique' => 'Invalid keys.'
                        ],
                    ],
                    'game' => [
                        'label' => 'Games',
                        'rules' => "required|alpha_numeric_space|in_list[$game]",
                        'errors' => [
                            'alpha_numeric_space' => 'Invalid characters.'
                        ],
                    ],
                    'user_key' => [
                        'label' => 'User keys',
                        'rules' => "required|is_unique[keys_code.user_key,user_key,$dKey->user_key]",
                        'errors' => [
                            'is_unique' => '{field} has been taken.'
                        ],
                    ],
                    'duration' => [
                        'label' => 'duration',
                        'rules' => 'required|numeric|greater_than_equal_to[1]',
                        'errors' => [
                            'greater_than_equal_to' => 'Minimum {field} is invalid.',
                            'numeric' => 'Invalid day {field}.'
                        ]
                    ],
                    'max_devices' => [
                        'label' => 'devices',
                        'rules' => 'required|numeric|greater_than_equal_to[1]',
                        'errors' => [
                            'greater_than_equal_to' => 'Minimum {field} is invalid.',
                            'numeric' => 'Invalid max of {field}.'
                        ]
                    ],
                    'registrator' => [
                        'label' => 'registrator',
                        'rules' => 'required|alpha_numeric_space|min_length[4]'
                    ],
                    'expired_date' => [
                        'label' => 'expired',
                        'rules' => 'permit_empty|valid_date[Y-m-d H:i:s]',
                        'errors' => [
                            'valid_date' => 'Invalid {field} date.',
                        ]
                    ],
                    'devices' => [
                        'label' => 'device list',
                        'rules' => 'permit_empty'
                    ]
                ];
                $form_owner = [
                    'id_keys' => [
                        'label' => 'keys',
                        'rules' => 'required|is_not_unique[keys_code.id_keys]|numeric',
                        'errors' => [
                            'is_not_unique' => 'Invalid keys.'
                        ],
                    ],
                    'game' => [
                        'label' => 'Games',
                        'rules' => "required|alpha_numeric_space|in_list[$game]",
                        'errors' => [
                            'alpha_numeric_space' => 'Invalid characters.'
                        ],
                    ],
                    'user_key' => [
                        'label' => 'User keys',
                        'rules' => "required|is_unique[keys_code.user_key,user_key,$dKey->user_key]",
                        'errors' => [
                            'is_unique' => '{field} has been taken.'
                        ],
                    ],
                    'duration' => [
                        'label' => 'duration',
                        'rules' => 'required|numeric|greater_than_equal_to[1]',
                        'errors' => [
                            'greater_than_equal_to' => 'Minimum {field} is invalid.',
                            'numeric' => 'Invalid day {field}.'
                        ]
                    ],
                    'max_devices' => [
                        'label' => 'devices',
                        'rules' => 'required|numeric|greater_than_equal_to[1]',
                        'errors' => [
                            'greater_than_equal_to' => 'Minimum {field} is invalid.',
                            'numeric' => 'Invalid max of {field}.'
                        ]
                    ],
                    'registrator' => [
                        'label' => 'registrator',
                        'rules' => 'required|alpha_numeric_space|min_length[4]'
                    ],
                    'expired_date' => [
                        'label' => 'expired',
                        'rules' => 'permit_empty|valid_date[Y-m-d H:i:s]',
                        'errors' => [
                            'valid_date' => 'Invalid {field} date.',
                        ]
                    ],
                    'devices' => [
                        'label' => 'device list',
                        'rules' => 'permit_empty'
                    ]
                ];
                if ($user->level == 1) {
                    // Owner full rules.
                    $form_rules = $form_owner;
                    $devices = $this->request->getPost('devices');
                    $max_devices = $this->request->getPost('max_devices');
                    $game = $this->request->getPost('game');
                    $u_key = $this->request->getPost('user_key');
                    $durate32 = $this->request->getPost('duration');
                    $status = $this->request->getPost('status');
                    $creator = $this->request->getPost('registrator');
                    
                    $data_saves = [
                        'game' => $game,
                        'user_key' => $u_key,
                        'duration' => $durate32,
                        'max_devices' => $max_devices,
                        'status' => $status,
                        'registrator' => $creator,
                        'expired_date' => $this->request->getPost('expired_date') ?: NULL,
                        'devices' => setDevice($devices, $max_devices),
                    ];
                } elseif ($user->level == 2) {
                    // Admin 75% rules.
                    $form_rules = $form_admin;
                    $devices = $this->request->getPost('devices');
                    $max_devices = $this->request->getPost('max_devices');
                    $game = $this->request->getPost('game');
                    $u_key = $this->request->getPost('user_key');
                    $durate32 = $this->request->getPost('duration');
                    $status = $this->request->getPost('status');
                    $creator = $this->request->getPost('registrator');
                    
                    $data_saves = [
                        'game' => $game,
                        'user_key' => $u_key,
                        'duration' => $durate32,
                        'max_devices' => $max_devices,
                        'status' => $status,
                        'registrator' => $creator,
                        'expired_date' => $this->request->getPost('expired_date') ?: NULL,
                        'devices' => setDevice($devices, $max_devices),
                    ];
                } else {
                    $form_rules = $form_reseller;
                    $data_saves = ['status' => $this->request->getPost('status')];
                }
                if (!$this->validate($form_rules)) {
                    return redirect()->back()->withInput()->with('msgDanger', 'Failed! Please check the error');
                } else {
                    $this->model->update($dKey->id_keys, $data_saves);
                    return redirect()->back()->with('msgSuccess', 'User key successfuly updated!');
                }
            } else {
                $msgDanger = "Restricted to this user key~";
            }
        }
        return redirect()->to('keys')->with('msgDanger', $msgDanger);
    }
    
    public function generate()
    {
        if ($this->request->getPost())
            return $this->generate_action();
            
        $user = $this->user;
        $validation = Services::validation();
        $message = setMessage("<i class='bi bi-wallet'></i> Total Saldo ₹$user->saldo");
        if ($user->saldo <= 0) {
            $message = setMessage("Please top up to your beloved admin.", 'warning');
        }
        
        $data = [
            'title' => 'Generate',
            'user' => $this->user,
            'time' => $this->time,
            'game' => $this->game_list,
            'duration' => $this->duration,
            'loopcount' => $this->bulk_key,
            'price' => json_encode($this->price),
            'messages' => $message,
            'validation' => $validation,
        ];
        
        return view('Keys/generate', $data);
    }
    
    private function generate_action()
    {
        $user = $this->user;
        $game = $this->request->getPost('game');
        $maxd = $this->request->getPost('max_devices');
        $drtn = $this->request->getPost('duration');
        $loopcount = $this->request->getPost('loopcount');
        $getPrice = getPrice($this->price, $drtn, $loopcount, $maxd);
        
        if ($loopcount == "1")
        {
            $loopcount = 2;
        } else if ($loopcount == "4")
        {
            $loopcount = 5;
        } else if ($loopcount == "8")
        {
            $loopcount = 9;
        } else if ($loopcount == "10")
        {
            $loopcount = 11;
        } else if ($loopcount == "20")
        {
            $loopcount = 21;
        } else if ($loopcount == "50")
        {
            $loopcount = "51";
        } else if($loopcount == "100")
        {
            $loopcount = "101";
        } else if($loopcount == "200")
        {
            $loopcount = "201";
        } else if($loopcount == "500")
        {
            $loopcount = "501";
        }
        
          $game_list = implode(",", array_keys($this->game_list));
          $form_rules = [
              'game' => [
                  'label' => 'Games',
                  'rules' => "required|alpha_numeric_space|in_list[$game_list]",
                  'errors' => [
                      'alpha_numeric_space' => 'Invalid characters.'
                  ],
              ],
              'duration' => [
                  'label' => 'duration',
                  'rules' => 'required|numeric|greater_than_equal_to[1]',
                  'errors' => [
                     'greater_than_equal_to' => 'Minimum {field} is invalid.',
                      'numeric' => 'Invalid duration {field}.'
                  ]
              ],
              'max_devices' => [
                  'label' => 'devices',
                  'rules' => 'required|numeric|greater_than_equal_to[1]',
                  'errors' => [
                      'greater_than_equal_to' => 'Minimum {field} is invalid.',
                      'numeric' => 'Invalid max of {field}.'
                  ]
              ],
          ];
          $validation = Services::validation();
          $reduceCheck = ($user->saldo - $getPrice);
          if ($reduceCheck < 0) {
              $validation->setError('duration', 'Insufficient balance');
              return redirect()->back()->withInput()->with('msgWarning', 'Please top up to your beloved admin.');
          } else {
              if (!$this->validate($form_rules)) {
                  return redirect()->back()->withInput()->with('msgDanger', 'Failed! Please check the error');
              } else {
                  
                  
                 $msg = "Successfuly Generated.";
                 

                   $data='';

                 // * reseller reduce saldo
                 for($i=1;$i<$loopcount;$i++){
                $license = 'NRG-'. $drtn. 'H-'. random_string('alnum', 12);
				/////	$license2 = $license2 . "D-" . $license;
		
                      $chanlicense = $license;
                      $data_response = [
                      'game' => $game,
                      'user_key' => $chanlicense,
                      'duration' => $drtn,
                      'max_devices' => $maxd,
                      'registrator' => $user->username,
                      'admin_id'=>$this->userId
                  ];
                    $data.=$license."\n";
                  
                  $idKeys = $this->model->insert($data_response);
                }
                write_file('new.txt', $data);///
                // $this->downloadFile('new.txt');
                
                  $this->userModel->update(session('userid'), ['saldo' => $reduceCheck]);

                  $history = new HistoryModel();
                  $history->insert([
                      'keys_id' => $idKeys,
                      'user_do' => $user->username,
                      'info' => "$game|" . substr($license, 0, 5) . "|$drtn|$maxd"
                  ]);

                  $other_response = [
                      'fees' => $getPrice
                  ];

                  session()->setFlashdata(array_merge($data_response, $other_response));
                 
                 
                  return redirect()->back()->with('msgSuccess', $msg);
                
              }
          }
     }
 
}

<?php

namespace App\Controllers;

use App\Models\KeysModel;

class Connect extends BaseController
{
    protected $model, $game, $uKey, $sDev;

    public function __construct()
    {
        include('conn.php');
//=================================================
        $sql1 ="select * from onoff where id=1";
        $result1 = mysqli_query($conn, $sql1);
        $userDetails1 = mysqli_fetch_assoc($result1);
//=================================================
        $this->model = new KeysModel();
//=================================================
        if($userDetails1['status'] == 'on')
        {
            $this->maintenance = true;
        } else {
            $this->maintenance = false;
        }
//=================================================
        $this->staticWords = "JoInTEl3graMD4RkeSpYt";
    }

    public function index()
    {
        if ($this->request->getPost()) {
            return $this->index_post();
        } else {
            $nata = [
                "web_info" => [
                    "_client" => BASE_NAME_FULL,
                    "license" => "JoInTEl3graMD4RkeSpYt",
                    "version" => "1.0.0",
                ],
                "web__dev" => [
                    "author" => "@DARKESPYT",
                    "telegram" => "https://telegram.me/DARKESPYT"
                ],
            ];
            
            return "<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<title>Hello 𝗕𝗮𝗰𝗵𝗲𝗲𝗲</title>
	<link rel='preconnect' href='https://fonts.googleapis.com'>
	<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
	<link href='https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap' rel='stylesheet'>
	 <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css'/>
<style>
body{
	margin: 0;
	padding: 0;
	overflow: hidden;
}
p{
	color: white;
	font-size: 16px;
	font-family: monospace;
	animation: animete 3s linear forwards;
}		
section{
	height: 100vh;
	background: #000;
	animation: section 8s linear forwards;
}
@keyframes section{
	0%{
		opacity: 0;
		background: #000;
	}
	25%{
		opacity: 1;
	}
	80%{
		opacity: 1;
		background: #000;
	}
	99%{
		opacity: 0;
		background: #000;
		height: 100vh;
	}
	100%{
		opacity: 1;
		background: pink;
		height: 0;

	}
}
section:before{
	content: '';
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: linear-gradient(to right, #f00,#f00,#0f0,#0ff,#ff0,#0ff);
	mix-blend-mode: color;
	pointer-events: none;
	animation: section1 8s linear forwards;
}
@keyframes section1{
	0%{
		visibility: visible;
	}
	98%{
		visibility: visible;
	}
	99%{
		visibility: hidden;
	}
	100%{
		visibility: hidden;
	}
}
video{
	object-fit: cover;
	overflow: hidden;
	animation: video 8s linear forwards;
}
h1{
	margin: 0;
	padding: 0;
	position: absolute;
	top: 50%;
	transform: translateY(-50%);
	width: 100%;
	text-align: center;
	color: #ddd;
	font-size: 5em;
	font-family: sans-serif;
	letter-spacing: 0.2em;
	animation: video 8s linear forwards;
}
@keyframes video{
	0%{}
	99%{
		visibility: hidden;
	}
	100%{
		visibility: hidden;
	}
}
h1 span{
	opacity: 0;
	display: inline-block;
	animation: animete 1s linear forwards;
}
@keyframes animete{
	0%{
		opacity: 0;
		transform: rotateY(90deg);
		filter: blur(10px);
	}
	100%{
		opacity: 1;
		transform: rotateY(0deg);
		filter: blur(0);
	}
}
h1 span:nth-child(1){
	animation-delay: 1s;
}
h1 span:nth-child(2){
	animation-delay: 2s;
}
h1 span:nth-child(3){
	animation-delay: 2.5s;
}
h1 span:nth-child(4){
	animation-delay: 3s;
}
h1 span:nth-child(5){
	animation-delay: 3.5s;
}
h1 span:nth-child(6){
	animation-delay: 3.75s;
}
h1 span:nth-child(7){
	animation-delay: 4s;
}
h1 span:nth-child(8){
	animation-delay: 4.40s;
}
h1 span:nth-child(9){
	animation-delay: 4.75s;
}

.about{
	width: 100%;
	height: 1400px;
	padding: 100px 0;
	background-color: #191919;
	font-family: 'Josefin Sans', sans-serif;
}
.about-text{
	width: 95%;
}
.main{
	width: 1130px;
	max-width: 95%;
	margin: 0 auto;
	display: flex;
	align-items: center;
	justify-content: space-around;
}
.about-text h2{
	color: white;
	font-size: 50px;
	text-transform: capitalize;
	margin-bottom: 1px;
}
.about-text h5{
	color: white;
	font-size: 25px;
	text-transform: capitalize;
	margin-bottom: 25px;
	letter-spacing: 2px;
}
.about-text h5 span{
	color: #f9004d;
}
.about-text p{
	color: #fcfc;
	line-height: 20px;
	font-size: 13px;
	margin-bottom: 45px;
}
.about-text button{
	background: #f9004d;
	color: white;
	text-decoration: none;
	border: 2px solid transparent;
	font-weight: bold;
	padding: 13px 30px;
	border-radius: 30px;
	transition: .4s;
}
.about-text button:hover{
	background: transparent;
	border: 2px solid #f9004d;
	cursor: pointer;
}
.about-text button a{
	text-decoration: none;
	color: #fff;
}



.toast{
    position: absolute;
    top: 25px;
    right: 30px;
    border-radius: 12px;
    background: #fff;
    padding: 20px 35px 20px 25px;
    box-shadow: 0 5px 10px rgba(0,0,0,0.1);
    border-left: 6px solid #4070f4;
    overflow: hidden;
    transform: translateX(calc(100% + 30px));
    transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);
}

.toast.active{
    transform: translateX(0%);
}

.toast .toast-content{
    display: flex;
    align-items: center;
}

.toast-content .check{
    display: flex;
    align-items: center;
    justify-content: center;
    height: 35px;
    width: 35px;
    background-color: #4070f4;
    color: #fff;
    font-size: 20px;
    border-radius: 50%;
}

.toast-content .message{
    display: flex;
    flex-direction: column;
    margin: 0 20px;
}

.message .text{
    font-size: 20px;
    font-weight: 400;;
    color: #666666;
}

.message .text.text-1{
    font-weight: 600;
    color: #333;
}

.toast .close{
    position: absolute;
    top: 10px;
    right: 15px;
    padding: 5px;
    cursor: pointer;
    opacity: 0.7;
}

.toast .close:hover{
    opacity: 1;
}

.toast .progress{
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    width: 100%;
    background: #ddd;
}

.toast .progress:before{
    content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    height: 100%;
    width: 100%;
    background-color: #4070f4;
}

.progress.active:before{
    animation: progress 5s linear forwards;
}

@keyframes progress {
    100%{
        right: 100%;
    }
}
@media screen and (max-width: 600px){
	h1{
		font-size: 1.5em;
		transform: translateY(-70%);
		letter-spacing: 0.1em;
		top: 54%;
	}
	p{
	    font-size: 9px;
    }
    video{
    	object-fit: none;
    	overflow: hidden;
    	width: 200%;

    }	
    .message .text{
    	 font-size: 13px;
         font-weight: 200;;
    }
}

</style>

</head>
<body>
	<section>
		<video src='smoke.mp4' autoplay muted></video>
		<h1>
			<span>D</span>
			<span>A</span>
			<span>R</span>
			<span>K</span>
			<span>E</span>
			<span>S</span>
			<span>P</span>
			<span>Y</span>
			<span>T</span><br><p>Welcome Mother Fucker</p>
		</h1>
	</section>
	<div class='about'>
		<div class='toast'>
        <div class='toast-content'>
            <i class='fas fa-solid fa-check check'></i>

            <div class='message'>
                <span class='text text-1'>Success</span>
                <span class='text text-2'>Your are Confirmed Bachee</span>
            </div>
        </div>
        <i class='fa-solid fa-xmark close'></i>

        <div class='progress'></div>
        </div>
		<div class='main'>
			<div class='about-text'>
				<h2>Hello 𝗕𝗮𝗰𝗵𝗲𝗲𝗲 </h1>
				<h5>Welcome<span> 𝗠𝗔𝗗𝗘𝗥𝗖𝗛𝗢𝗗</span></h5>
				<p>𝗧𝗘𝗥𝗜 𝗕𝗛𝗘𝗡 𝗞𝗜 𝗖𝗛𝗨𝗧 𝗞𝗛𝗔 𝗝𝗔𝗨 𝗠𝗔𝗗𝗘𝗥𝗖𝗛𝗢𝗗 😡<br>
𝗛𝗜𝗝𝗗𝗘 𝗞𝗜 𝗔𝗨𝗟𝗔𝗗 𝗠𝗔𝗗𝗘𝗥𝗖𝗛𝗢𝗗<br>
𝗧𝗘𝗥𝗜 𝗕𝗛𝗘𝗡 𝗞𝗘 𝗕𝗛𝗢𝗦𝗗𝗔𝗔 𝗠𝗔𝗥𝗨 𝗥𝗔𝗡𝗗𝗜 𝗞𝗜 𝗔𝗨𝗟𝗔𝗧 𝗧𝗘𝗥𝗔 𝗕𝗔𝗔𝗣 𝗛𝗨 𝗠𝗔𝗗𝗘𝗥𝗖𝗛𝗢𝗗 𝗚𝗔𝗟𝗜 𝗗𝗘𝗚𝗔 𝗧𝗘𝗥𝗜 𝗕𝗔𝗔𝗣 𝗥𝗔𝗡𝗗𝗪𝗔 𝗛𝗔𝗜 𝗡𝗔 𝗥𝗔𝗡𝗗𝗜<br>
𝗧𝗨 𝟮 𝗥𝗦 𝗠𝗔𝗜 𝗖𝗛𝗨𝗗𝗪𝗔𝗧𝗜 𝗛𝗔𝗜 𝗡𝗔 𝗠𝗔𝗗𝗘𝗥𝗖𝗛𝗢𝗗 𝗥𝗻𝗱𝗶 𝗸𝗶 𝗮𝘂𝗹𝗮𝗱 𝗺𝗮𝗱𝗲𝗿𝗰𝗵𝗼𝗱 𝗸𝗲 𝗯𝗮𝗰𝗵𝗲𝗲𝗲<br>
𝗚𝗕 𝗥𝗢𝗔𝗗 𝗞𝗜 𝗦𝗔𝗦𝗧𝗜 𝗥𝗔𝗡𝗗𝗜<br>
𝗕𝗛𝗘𝗡 𝗞𝗘 𝗟𝗔𝗪𝗗𝗘𝗘<br>
𝗖𝗼𝗽𝘆 𝗽𝗮𝘀𝘁𝗶𝗻𝗴 𝗸𝗿𝗲𝗴𝗮 𝗺𝗮𝗱𝗲𝗿𝗰𝗵𝗼𝗱<br>
𝗠𝗲𝗿𝗲 𝗱𝗼𝘀𝘁𝗼 𝗸𝗼 𝗴𝗮𝗹𝗶 𝗱𝗲𝗴𝗮 𝗯𝗲𝘁𝗮 𝗯𝗮𝗮𝗽 𝗸𝗼  𝗸𝗿 𝘁𝗲𝗿𝗶 𝗺𝗮𝗸𝗼 𝗻𝗮 𝗰𝗵𝗼𝗱𝗮 𝘁𝗼𝗵 𝗸𝗲𝗵𝗻𝗮 𝗮𝘂𝗿 𝗹𝘂𝗻𝗱 𝘀𝗲 𝗳𝗶𝗴𝗵𝘁 𝗰𝗼𝗺𝗽𝗹𝗲𝘁𝗲 𝗮𝘂𝗸𝗮𝘁 𝗵𝗮𝗶 𝘁𝗼𝗵 𝘃𝗰 𝗮𝗮𝗮𝗮 𝗿𝗮𝗻𝗱𝗶 𝗸𝗲 𝗽𝗶𝗹𝗹𝗲𝗲 😂BHANKELODE TERE MAA KO NANGI CHODU MADHACHODO KE BAACHE LAUDE SE SAKAL KE BHANKELUND TERE MAA KE CHUT KA KAL DUSSEHRA BANAU TERE MAA KE CHUT TRAIN KE NICHE DAABA TU MAA KE CHOD TERE MAA KE CHUT ITNE JOOR SE MAARU KE TERE MAA KE CHUT NASA KE PAAS CHALE JAAYE PHIR NASA BAALE TERE MAA KE CHUT ROCKET SE BAAND KA TERE MAA KA DUSSEHRA BANA DU MADHACHOD BETICHOD.</p>
                  <h5>Hay Bachee Touch Here</h5>
				<button type='button'><a href='#'>Let's Talk</a></button>
			</div>
		</div>
	</div>
	<script>
const button = document.querySelector('button'),
      toast = document.querySelector('.toast')
      closeIcon = document.querySelector('.close'),
      progress = document.querySelector('.progress');

      let timer1, timer2;

      button.addEventListener('click', () => {
        toast.classList.add('active');
        progress.classList.add('active');

        timer1 = setTimeout(() => {
            toast.classList.remove('active');
        }, 5000); //1s = 1000 milliseconds

        timer2 = setTimeout(() => {
          progress.classList.remove('active');
        }, 5300);
      });
      
      closeIcon.addEventListener('click', () => {
        toast.classList.remove('active');
        
        setTimeout(() => {
          progress.classList.remove('active');
        }, 300);

        clearTimeout(timer1);
        clearTimeout(timer2);
      });
	</script>
</body>
</html>";
            $this->response->setJSON($nata);
        }
    }

    public function index_post()
    {
        $isMT = $this->maintenance;
        $game = $this->request->getVar('game');
        $uKey = $this->request->getVar('user_key');
        $sDev = $this->request->getVar('serial');

        $form_rules = [
            'game' => 'required|alpha_dash',
            'user_key' => 'required|min_length[1]|max_length[36]',
            'serial' => 'required|alpha_dash'
        ];

        if (!$this->validate($form_rules)) {
            $data = [
                'status' => false,
                'reason' => "Bad Parameter",
            ];
            return $this->response->setJSON($data);
        }

        if ($isMT) {
            
            include('conn.php');
        
            $sql1 ="select * from onoff where id=1";
            $result1 = mysqli_query($conn, $sql1);
            $userDetails1 = mysqli_fetch_assoc($result1);
        
            
            $data = [
                'status' => true,
                'reason' => $userDetails1['myinput']
            ];
        } else {
            if (!$game or !$uKey or !$sDev) {
                $data = [
                    'status' => false,
                    'reason' => 'INVALID PARAMETER'
                ];
            } else {
                $time = new \CodeIgniter\I18n\Time;
                $model = $this->model;
                $findKey = $model
                    ->getKeysGame(['user_key' => $uKey, 'game' => $game]);

                if ($findKey) {
                    if ($findKey->status != 1) {
                        $data = [
                            'status' => false,
                            'reason' => 'USER BLOCKED'
                        ];
                    } else {
                        $id_keys = $findKey->id_keys;
                        $duration = $findKey->duration;
                        $expired = $findKey->expired_date;
                        $max_dev = $findKey->max_devices;
                        $devices = $findKey->devices;
    
                        function checkDevicesAdd($serial, $devices, $max_dev)
                        {
                            $lsDevice = explode(",", $devices);
                            $cDevices = isset($devices) ? count($lsDevice) : 0;
                            $serialOn = in_array($serial, $lsDevice);
    
                            if ($serialOn) {
                                return true;
                            } else {
                                if ($cDevices < $max_dev) {
                                    array_push($lsDevice, $serial);
                                    $setDevice = reduce_multiples(implode(",", $lsDevice), ",", true);
                                    return ['devices' => $setDevice];
                                } else {
                                    // ! false - devices max
                                    return false;
                                }
                            }
                        }
    
                        if (!$expired) {
                            $setExpired = $time::now()->addHours($duration);
                            $model->update($id_keys, ['expired_date' => $setExpired]);
                            $data['status'] = true;
                        } else {
                            if ($time::now()->isBefore($expired)) {
                                $data['status'] = true;
                            } else {
                                $data = [
                                    'status' => false,
                                    'reason' => 'EXPIRED KEY'
                                ];
                            }
                        }
    
                        if ($data['status']) {
                            
                            include('conn.php');
        
                            $sql2 ="select * from modname where id=1";
                            $result2 = mysqli_query($conn, $sql2);
                            $userDetails2 = mysqli_fetch_assoc($result2);
                            
                            $sql3 ="select * from _ftext where id=1";
                            $result3 = mysqli_query($conn, $sql3);
                            $userDetails3 = mysqli_fetch_assoc($result3);
                            
                            $sql4 = "SELECT expired_date FROM keys_code WHERE user_key='$uKey'";
                            $result4 = mysqli_query($conn, $sql4);
                            $userDetails4 = mysqli_fetch_assoc($result4);
//=================================================
        $sql = "SELECT * FROM Feature WHERE id=1";
        $result = mysqli_query($conn, $sql);
        $ModFeatureStatus = mysqli_fetch_assoc($result);
//=================================================
        $rngcnt = $time->getTimestamp();
//=================================================
                            $devicesAdd = checkDevicesAdd($sDev, $devices, $max_dev);
                            if ($devicesAdd) {
                                if (is_array($devicesAdd)) {
                                    $model->update($id_keys, $devicesAdd);
                                }
                                // ? game-user_key-serial-word di line 15
                                $real = "$game-$uKey-$sDev-$this->staticWords";
                                $data = [
                                    'status' => true,
                                    'data' => [
                                        'real' => $real,
                                        'token' => md5($real),
                                        'modname' => $userDetails2['modname'],
                                        'mod_status' => $userDetails3['_status'],
                                        'credit' => $userDetails3['_ftext'],
                                        'ESP' => $ModFeatureStatus['ESP'],
                                        'Item' => $ModFeatureStatus['Item'],
                                        'AIM' => $ModFeatureStatus['AIM'],
                                        'SilentAim' => $ModFeatureStatus['SilentAim'],
                                        'BulletTrack' => $ModFeatureStatus['BulletTrack'],
                                        'Floating' => $ModFeatureStatus['Floating'],
                                        'Memory' => $ModFeatureStatus['Memory'],
                                        'Setting' => $ModFeatureStatus['Setting'],
                                        'EXP' => $userDetails4['expired_date'],
                                        'device'=> $max_dev,
                                        'rng' => $rngcnt
                                    ],
                                ];
                            } else {
                                $data = [
                                    'status' => false,
                                    'reason' => 'MAX DEVICE REACHED'
                                ];
                            }
                        }
                    }
                } else {
                    $data = [
                        'status' => false,
                        'reason' => 'USER OR GAME NOT REGISTERED'
                    ];
                }
            }
        }
        return $this->response->setJSON($data);
    }
}

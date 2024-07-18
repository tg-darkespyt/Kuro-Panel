<?php

namespace App\Controllers;

use App\Models\CodeModel;
use App\Models\UserModel;
use CodeIgniter\Config\Services;

include('conn.php');
$url = "https://darkespyt.in";

// For Users Mail
$sql = "SELECT email FROM users where username='Owner'";
$result = mysqli_query($conn, $sql);
$usersmail = mysqli_fetch_assoc($result);

function getUserIP1()
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
$user_ip = getUserIP1();


date_default_timezone_set('Asia/Calcutta');
$iplogfile = 'logs.html';
$webpage = $_SERVER['REQUEST_URI'];
$timestamp = date('d/m/Y h:i:sa');
$accesstime = date('h:i:sa');
$browser = $_SERVER['HTTP_USER_AGENT'];
$url = $_SERVER['SERVER_NAME'];


$email = \Config\Services::email();
$email->setFrom('support@darkespyt.in', '𝐃𝐀𝐑𝐊𝐄𝐒𝐏𝐘𝐓🇮🇳');
$email->setTo($usersmail);
$email->setSubject("$user_ip 𝙐𝙨𝙞𝙣𝙜 𝙔𝙤𝙪𝙧 𝙋𝙖𝙣𝙚𝙡 $accesstime");
$email->setMessage("<!DOCTYPE html>
<html>
<head>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>User Details</title>
</head>
<body style='font-family: sans-serif;'>
    <div style='width:1080px;
        height:1760px;
        background-color:red;
        position:absolute;
        border-radius:60px;'>
        <div style='width:1040px;
            height:1740px;
            border-radius:60px;
            margin:20px;
            position:absolute;
            background-color:lightskyblue;'>
            <img 
                src='$url/uploads/images/logo.png' style='width:600px; height:184px; margin:20px;'>
            </img>
            <a href='https://youtube.com/@DARK_ESP_YT'>
                <img 
                    src='$url/uploads/images/yt.png' onclick=''style='width:50px; height:50px; position:absolute; top:20px; right:16px; margin:10px;'>
                </img>
            </a>
            <a href='https://telegram.me/DARKESPYT'>
                <img 
                    src='$url/uploads/images/tg.png' style='width:50px; height:50px; position:absolute; top:20px; right:116px; margin:10px;'>
                </img>
            </a>
            <a href='https://Instagram.com/m__r__.v_i_g_n_e_s_h'>
                <img 
                    src='$url/uploads/images/ig.png' style='width:50px; height:50px; position:absolute; top:20px; right:216px; margin:10px;'>
                </img>
            </a>
            <a href='https://blog.darkespyt.in'>
                <img 
                    src='$url/uploads/images/darkweb.png' style='width:50px; height:50px; position:absolute; top:20px; right:316px; margin:10px;'>
                </img>
            </a>
            <hr>
            <img 
                src='$url/uploads/images/mail.png' width='100%' height='493px'>
            </img>
            <hr>
            <div style='width:1020px;
                height:1000px;
                float:center;
                margin:20px;
                position:absolute;'>
                <h2>
                    &#10071;An User Trying To Access Your Panel &#10075;$user_ip&#10076; &#128099;&#10071;
                </h2>
                <div style='width:1020px;
                    height:940px;
                    float:center;
                    border-radius:60px;
                    margin:20px;
                    position:absolute;'>
                    <table style='width:800px;
                        height:200px;
                        float:center;
                        position:absolute;
                        border:2px solid blue;
                        color:white;
                        background-color:green;
                        text-align:left;'>
                       <tr style='border:2px solid black;'>
                          <th style='border:2px solid black;'>
                            &#10146; User IP : 
                          </th>
                          <td style='border:2px solid black; text-align:center'>
                            $user_ip
                          </td>
                       </tr>
                       <tr style='border:2px solid black;'>
                          <th style='border:2px solid black;'>
                            &#10147; Time : 
                          </th>
                          <td style='border:2px solid black; text-align:center'>
                            $timestamp
                          </td>
                      </tr>
                      <tr style='border:2px solid black;'>
                          <th style='border:2px solid black;'>
                            &#10146; Page & name : 
                          </th>
                          <td style='border:2px solid black; text-align:center'>
                            $webpage & $username
                          </td>
                      </tr>
                      <tr style='border:2px solid black;'>
                          <th style='border:2px solid black;'>
                            &#10147; Browser : 
                          </th>
                          <td style='border:2px solid black; text-align:center'>
                            $browser
                          </td>
                      </tr>
                    </table>
                     <h2 style='text-align:center;'>
                          Thanks For Choosing @DARKESPYT and We Definitely Try To Give Best Things To You!
                       </h2>
                   
                </div>
            </div>
        </div>
    </div>
</body>
</html>");
$email->send();

?>
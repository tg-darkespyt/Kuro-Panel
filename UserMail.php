<?php
namespace App\Controllers;

use App\Models\CodeModel;
use App\Models\UserModel;
use CodeIgniter\Config\Services;

include('conn.php');
$url = "https://darkespyt.in";
$CompName = "DARK ESP YT";

$this->userid = session()->userid;
$this->model = new UserModel();
$this->user = $this->model->getUser($this->userid);
$user = $this->user;
$username = getName($user);

$sql = "SELECT `email` from `users` where username='$username'";
$result = mysqli_query($conn, $sql);
$usermail = mysqli_fetch_array($result);

date_default_timezone_set('Asia/Calcutta');
$timestamp = date('d/m/Y h:i:sa');
$accesstime = date('h:i:sa');
$webpage = $_SERVER['REQUEST_URI'];
$browser = $_SERVER['HTTP_USER_AGENT'];
$url = $_SERVER['SERVER_NAME'];
$server = $_SERVER['HTTP_HOST'];

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
$user_ip = getUserIP();

    if (isset($username)||($email)) {  
        $email = \Config\Services::email();
        $email->setFrom('support@darkespyt.in', '𝐃𝐀𝐑𝐊𝐄𝐒𝐏𝐘𝐓🇮🇳');
        $email->setTo($usermail);
        
        $email->setSubject("[$server]✔ Logged in as $username at $timestamp");
        $email->setMessage("<!DOCTYPE html>
<html>

<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <title>MAIL</title>
  <style>
  @media screen and (max-width: 432px)
{
  .header{
    width:432px !important;
  }
  
  .mail_png{
    width: 200px !important;
    margin: 60% 0px 0px 25% !important;
  }
  
  .mail_box{
    margin: 190% 0px 0px 9% !important;
  }
  
  .mail_box h1{
    padding: 0px 0px 0px 78px !important;
  }
  
  .box_1{
    margin: 310% 0px 0px 10% !important;
  }
  
  .box_2{
    margin: 310% 0px 0px 55% !important;
  }
  
  .social{
    margin:380% 0px 0px 0px !important;
    width: 100% !important;
    padding: 0px 0px 125px 0px !important;
  }
  
  .social p{
    margin: 15% 0px 0px 6.5% !important;
  }
  
  footer{
    width:432px !important;
  }
  
  footer p{
    margin: 2% 0px 0px 30% !important;
  }
  
  footer hr{
    margin: 6% 0px 0px 0px !important;
  }
}
</style>
</head>
<body style='font-family: sans-serif;
background-color: whitesmoke;
margin: 0'>
<div class='header' style='width:100%;
height:50px;
background-color:red;
position:absolute;
border-radius:6px;
display: flex;
justify-content: flex-start;
align-items: center;
margin: 5px 0px'>
  <img src='https://darkespyt.in/uploads/images/logo.png' alter='logo' style='width:123px; height:40px; margin:0px 10px 0px 70px;'>
  </img>

   <img class='mail_png' src='https://darkespyt.in/uploads/images/mail1.png' alt='Mail' style='width: 250px;
   position:absolute;
   margin: 40% 0px 0px 36%;'>
  <div class='mail_box'
    style='width:350px;
    height:320px;
    background-color: white;
    position:absolute;
    border-radius:6px;
    margin: 110% 0px 0px 9%'>
    <h1 style='color: #00FF00;
    padding: 0px 0px 0px 25px;
    font-size: 25px'>Login Successful</h1>
    <hr color= 'red'>
    <p style='padding: 40px;
    font-size: 12px'>Dear [ Name ],<br><br><br>Congratulations! You have successfully logged in to your account. We hope you enjoy using our PANEL services. If you have any questions or need assistance, please don't hesitate to contact us.<br><br>Thank you for being a valued customer.<br><br>Sincerely,<br>[ TEAM DARK - @$CompName ]</p>
  </div>
  
  <!-- veriables -->
  <div class='box_1' style='background-color: #00FFFF;
    width: 150px;
    height: 90px;
    border-radius: 6px;
    position:absolute;
    margin: 95% 0px 0px 58%;'>
    <p style='color: black;
    margin: 10px 0px 0px 15px;
    font-size: 12px;'>Your IP</p>
    <p style='color: black;
    margin: 5px 0px 0px 25px;
    font-size: 10px;'>$user_ip</p>
    <p style='color: black;
    margin: 10px 0px 0px 15px;
    font-size: 12px;'>Time</p>
    <p style='color: black;
    margin: 5px 0px 0px 25px;
    font-size: 10px;'>$timestamp</p>
  </div>
    <div class='box_2' style='background-color: #00FFFF;
      width: 150px;
      height: 90px;
      border-radius: 6px;
      position:absolute;
      margin: 95% 0px 0px 78%'>
      <p style='color: black;
      margin: 10px 0px 0px 15px;
      font-size: 12px;'>Accessed Page</p>
      <p style='color: black;
      margin: 5px 0px 0px 25px;
      font-size: 10px;'>$webpage</p>
      <p style='color: black;
      margin: 10px 0px 0px 15px;
      font-size: 12px;'>Stranger's Browser</p>
      <p style='color: black;
      margin: 5px 0px 0px 25px;
      font-size: 10px;'>$browser</p>
    </div>
    <div class='social' style='position:absolute;
    margin:140% 0px 0px 51%;
    width: 50%;
    padding: 0px 0px 200px 0px'>
    <a href='https://blog.darkespyt.in' id='www'>
                <img 
                    src='https://darkespyt.in/uploads/images/darkweb.png' alter='website' style='width:50px;
                    height:50px;
                    position:absolute;
                    margin:0px 0px 0px 20%;'>
                </img>
    </a>
    <a href='https://Instagram.com/m__r__.v_i_g_n_e_s_h' id='instagram'>
                <img 
                    src='https://darkespyt.in/uploads/images/ig.png' alter='telegram' style='width:50px;
                    height:50px;
                    position:absolute;
                    margin:0px 0px 0px 36%;'>
                </img>
    </a>
    <a href='https://telegram.me/DARKESPYT' id='telegram'>
                <img 
                    src='https://darkespyt.in/uploads/images/tg.png' alter='telegram' style='width:50px;
                    height:50px;
                    position:absolute;
                    margin:0px 0px 0px 52%;'>
                </img>
    </a>
    <a href='https://youtube.com/@DARK_ESP_YT' id='youtube'>
                <img 
                    src='https://darkespyt.in/uploads/images/yt.png' alter='youtube' style='width:50px;
                    height:50px;
                    position:absolute;
                    margin:0px 0px 0px 68%;'>
                </img>
    </a>
    <p style='margin: 17% 0px 0px 11%;
      position: absolute;
      font-size: 10px'>Thanks for choosing @DARKESPYT and we Definitely Try to give Best Things for you!</p>
    </div>
</div>
<footer style='position:fixed;
left:0;
bottom:0;
width:100%;
background-color:red;
color:white;
text-align:center;'>
  <p style='margin: 4px 0px 0px 40%;
  position: absolute;
  font-size: 12px'>Copyright © 2023 Team DARK</p>
  <hr color= 'red' style='margin: 2% 0px 0px 0px;'>
  
</footer>

<body>

</body>

</html>
");
$email->send();
}
?>
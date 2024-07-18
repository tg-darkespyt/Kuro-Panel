<?php

include('conn.php');
//include('mail.php');

$IST_Time = mktime(date('h')+5,date('i')+30,date('s'));
$ct = date('Y-m-d h:i:s', $IST_Time);
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];

    // destination of the file on the server
    $destination = 'TumharaPapaDARK/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];
$x="1";
if($size < 5300000) {
$realsize=$size/1024;
}
function formatBytes($size, $precision = 2)
{
    $base = log($size, 1024);
    $suffixes = array('B', 'KB', 'MB');   

    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}
$realsize=formatBytes($size);
    if (!in_array($extension, ['so'])) {
        echo "<script>Materialize.toast('Only Upload MOD SERVER LIB!', 3000, 'rounded');</script>";
    } elseif ($_FILES['myfile']['size'] > 100000000) { //Upto 10MB 
        echo "File IS LARGEST";
    } elseif (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO `lib` (`id`, `file`, `file_type`, `file_size`, `time`) VALUES ('++$x', '$filename', '$destination', '$realsize', '$ct')";
            if (mysqli_query($conn, $sql)) {
                echo "File Size :". formatBytes($size);
                echo "<br>File Upload Time : ". $ct;
                echo "<br>LIB uploaded successfully";
                
            }
        } else {
            echo "<br><br>Failed to upload LIB";
        }
}
?>
<head>
  <meta http-equiv="refresh" content="3; URL=/lib" />
</head>
<body>
    <h1>This Page Developed For Auto Redirection. Made By <a href="https://telegram.me/DARKESPYT">@DARKESPYT</a>.</h1>
  <p>If you are not redirected in 3 seconds, <a href="/lib">click here</a>.</p>
</body>
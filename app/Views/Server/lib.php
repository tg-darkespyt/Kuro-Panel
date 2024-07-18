<?php

include('conn.php');
include('mail.php');

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
        $msg = "Only Upload MOD LIB Files!";
        return redirect()->back()->with('msgDanger', $msg);
    } elseif ($_FILES['myfile']['size'] > 100000000) { //Upto 10MB 
        $msg = "File IS LARGEST";
        return redirect()->back()->with('msgWarning', $msg);
    } elseif (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO `lib` (`id`, `file`, `file_type`, `file_size`, `time`) VALUES ('++$x', '$filename', '$destination', '$realsize', '$ct')";
            if (mysqli_query($conn, $sql)) {
                $msg = "File Size :". formatBytes($size);
                $msg .= "<br>File Upload Time : ". $ct;
                $msg .= "<br>LIB uploaded successfully";
                return redirect()->back()->with('msgSuccess', $msg);
            }
        } else {
            $msg = "<br><br>Failed to upload LIB";
            return redirect()->back()->with('msgDanger', $msg);
        }
}

$sql2 = "SELECT time FROM lib
ORDER BY id DESC
LIMIT 1;";
$result2 = mysqli_query($conn, $sql2);
$libTime = mysqli_fetch_assoc($result2);

$sql3 = "SELECT file FROM lib
ORDER BY id DESC
LIMIT 1;";
$result3 = mysqli_query($conn, $sql3);
$libName = mysqli_fetch_assoc($result3);

$sql4 = "SELECT file_size FROM lib
ORDER BY id DESC
LIMIT 1;";
$result4 = mysqli_query($conn, $sql4);
$libSize = mysqli_fetch_assoc($result4);

$sql5 = "SELECT file_type FROM lib
ORDER BY id DESC
LIMIT 1;";
$result5 = mysqli_query($conn, $sql5);
$libPath = mysqli_fetch_assoc($result5);

$sql6 = "SELECT id FROM lib
ORDER BY id DESC
LIMIT 1;";
$result6 = mysqli_query($conn, $sql6);
$libID = mysqli_fetch_assoc($result6);

?>


<?= $this->extend('Layout/Starter') ?>
<?= $this->section('content') ?>
<div class="bt container p-3 py-4 mb-3" id="content">
      <div class="row">
        <div class="col-lg-12">
            <?= $this->include('Layout/msgStatus') ?>
        </div>
       <div class="col-lg-6">
        <div class="card mb-3">
            <div class="card-header bg-dark text-white h6 p-3">
                <a class="btn btn-outline-light btn-sm" href="<?= site_url('admin/manage-users') ?>"><i class="bi bi-person-badge"></i> Manage Users</a>
                <a class="btn btn-outline-light btn-sm" href="<?= site_url('keys/generate') ?>"><i class="bi bi-person-plus"></i> Generate Keys</a>
             </div>
           <div class="card-body">
               <label for="file">Current LIB : <font size="2" color ="#a39c9b"><?php echo $libName['file']; ?></font></label>
               <br>
               <label for="size">LIB Size : <font size="2" color ="#a39c9b"><?php echo $libSize['file_size']; ?></font></label>
               <br>
               <label for="size">LIB ID : <font size="2" color ="#a39c9b"><?php echo $libID['id']; ?></font></label>
               <br>
               <label for="path">LIB Path : <font size="2" color ="#a39c9b"><?php echo $libPath['file_type']; ?></font></label>
               <br>
               <label for="time">Last Modified : <font size="2" color ="#a39c9b"><?php echo $libTime['time']; ?></font></label>
               <br>
               <label for="ctime">Current Time : <font size="2" color ="#a39c9b"><?php echo $ct ?></font></label>
               <br><br>
               <a class="btn btn-outline-primary text-dark" href="<?php echo site_url() ?><?php echo $libPath['file_type']; ?>"><i class="bi bi-download"></i> 𝐃𝐨𝐰𝐧𝐥𝐨𝐚𝐝</a>
            </div>
        </div>
    </div>    
          
         <div class="col-lg-6">
            <div class="card mb-3">
               <div class="card-header h6 p-3 bg-dark text-white">
                   Upload LIB
                </div>
                <div class="card body">
                   <div style="padding-top:30px;">
                      <div style="padding-left:10px;">
                        <div class="form-group mb-3">
                          <form action="/lib" method="post" enctype="multipart/form-data">
                             <input type="file" name="myfile"> <br><br>
                        </div>
                        <div class="form-group my-2">
                          <button type="submit" name="save">Upload</button>
                        </div>
                      </form>
                   </div>
                </div>
              </div>
            </div>
         </div>
       </div>
       
     </div>
  </div>
 </div>

<?= $this->endSection() ?>
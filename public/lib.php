<?php

include('conn.php');

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
$lt=filemtime($filename);
    if (!in_array($extension, ['so'])) {
        echo "<script>Materialize.toast('Only Upload MOD SERVER LIB!', 3000, 'rounded');</script>";
    } elseif ($_FILES['myfile']['size'] > 100000000) { //Upto 10MB 
        echo "File IS LARGEST";
    } elseif (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO `lib` (`id`, `file`, `file_type`, `file_size`, `time`) VALUES ('++$x', '$filename', '$destination', '$realsize', '$lt')";
            if (mysqli_query($conn, $sql)) {
                echo "File Size :". formatBytes($size);
                echo "<br>LIB uploaded successfully";
                
            }
        } else {
            echo "<br><br>Failed to upload LIB";
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <style>
        body{
            background-image: url(https://images.unsplash.com/photo-1639080494293-a6c409e3bb88?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxjb2xsZWN0aW9uLXBhZ2V8MXwyNDU1MTM5fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=700&q=60);
            font-family: 'Poppins', sans-serif !important;
            background-size: cover;
            transform: rotate(0deg);
        }
        main{
            height: 100vh;
            display: flex;
            background-size: cover;
            overflow: hidden;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }
        .bt{
            height: 50vh;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>

<header>
<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm align-middle" style="background-image:url('https://mir-s3-cdn-cf.behance.net/project_modules/1400/e5210952533973.5913d568d0053.jpg')">
        <div class="container px-3">
            <a class="navbar-brand text-dark" href="https://dark-esp-yt.tk"><i class="bi bi-x-diamond-fill"></i>𝐃𝐀𝐑𝐊 𝐄𝐒𝐏 𝐘𝐓 𝐏𝐀𝐍𝐄𝐋</a>
            <button class="navbar-toggler bg-dark text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                    <ul class="navbar-nav text-dark me-auto mb-2 mb-lg-0">

                    <li class="nav-item text-dark">
                            <a class="nav-link text-dark" href="https://dark-esp-yt.tk/admin/manage-users')users">Users</a>
                        </li>
                        <li class="nav-item text-dark">
                            <a class="nav-link text-dark" href="https://dark-esp-yt.tk/keys">Keys</a>
                        </li>
                        <li class="nav-item text-dark">
                            <a class="nav-link text-dark" href="https://dark-esp-yt.tk/keys/generate">Generate</a>
                        </li>
                    </ul>
                    <div class="float-right" >
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown" >
                                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle pe-2"></i>
                                    𝐃𝐀𝐑𝐊 𝐄𝐒𝐏 𝐘𝐓
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="navbarDropdown"  >
                                    <li>
                                        <a class="dropdown-item" href="https://dark-esp-yt.tk/settings">
                                            <i class="bi bi-gear"></i> Settings
                                        </a>
                                    </li>
                                   
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    
                                        <li class="dropdown-item text-muted">Admin</li>
                                    <li>
                                            <a class="dropdown-item" href="https://dark-esp-yt.tk/Server">
                                                <i class="bi bi-sliders"></i> Online System
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="https://dark-esp-yt.tk/lib.php">
                                                <i class="bi bi-sliders"></i> Online LIB(Beta)
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="https://dark-esp-yt.tk/admin/create-referral">
                                                <i class="bi bi-people"></i> Create Referral
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                    
                                    <li>
                                        <a class="dropdown-item text-danger" href="https://dark-esp-yt.tk/logout">
                                            <i class="bi bi-box-arrow-in-left"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
            </div>
        

        </div>
    </nav>
</header>

<main>
<div class="bt container p-3 py-4 mb-3" id="content">
    <div class="fixed text-center container">
    <div class="row" style="padding-top:40px;">
    <div>
      <div class="row">
         <div class="col-lg-6">
            <div class="card mb-3">
               <div class="card-header h6 p-3 bg-primary text-white">
                   Upload LIB
                </div>
                <div class="card body" style="padding-bottom:40px;">
                   <div style="padding-top:30px;">
                      <div style="padding-left:10px;">
                        <div class="form-group mb-3">
                          <form action="lib" method="post" enctype="multipart/form-data">
                             <input type="file" name="myfile"> <br><br>
                        </div>
                        <div class="form-group my-2 fixed text-left">
                          <button type="submit" name="save">upload</button>
                        </div>
                      </form>
                   </div>
                </div>
              </div>
            </div>
         </div>
       </div>
       <br><br><br><br>
     </div>
  </div>
</main>
    
<footer class="fixed-bottom bg-body border-top py-3 text-muted" style="background-image:url('https://mir-s3-cdn-cf.behance.net/project_modules/1400/e5210952533973.5913d568d0053.jpg')">
        <div class="container">
            <small class="text-dark">&copy; <?= date('Y') ?> - 𝐃𝐀𝐑𝐊 𝐄𝐒𝐏 𝐘𝐓 𝐏𝐀𝐍𝐄𝐋</small>
        </div>
    </footer>

</body>
</html>

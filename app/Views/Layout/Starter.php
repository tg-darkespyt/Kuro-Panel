<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= BASE_NAME ?> - <?= isset($title) ? $title : 'Panel' ?></title>
    <?= $this->renderSection('css') ?>

    <?= link_tag('assets/css/natacode.css') ?>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>
<style>
        body{
            background-image: url('/uploads/images/bgjp.webp');
            font-family: 'Poppins', sans-serif !important;
            background-size: auto;
        }
        .hacks {
          position: relative;
          display: inline-block;
          width: 100%;
          height: 20px;
          float: left;
          margin: 5%;
        }
        .switch {
          position: relative;
          display: inline-block;
          width: 40px;
          height: 20px;
          float: right-end;
          align-items: flex-end;
          margin: 5px 5px 5px 5px;
        }
        
        /* Hide default HTML checkbox */
        .switch input {
          opacity: 0;
          width: 0;
          height: 0;
        }
        
        /* The slider */
        .slider {
          position: absolute;
          cursor: pointer;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: #ccc;
          -webkit-transition: .4s;
          transition: .4s;
        }
        
        .slider:before {
          position: absolute;
          content: "";
          height: 12px;
          width: 12px;
          left: 4px;
          bottom: 4px;
          background-color: white;
          -webkit-transition: .4s;
          transition: .4s;
        }
        
        input:checked + .slider {
          background-color: #2196F3;
        }
        
        input:focus + .slider {
          box-shadow: 0 0 1px #2196F3;
        }
        
        input:checked + .slider:before {
          -webkit-transform: translateX(20px);
          -ms-transform: translateX(20px);
          transform: translateX(20px);
        }
        
        /* Rounded sliders */
        .slider.round {
          border-radius: 34px;
        }
        
        .slider.round:before {
          border-radius: 50%;
        }
    </style>
<body>
    <!-- Start menu -->
    <?= $this->include('Layout/Header') ?>
    <!-- End of menu -->
    <main>
        <div class="container p-3 py-4 mb-3" id="content">
            <!-- Start content -->
            <?= $this->renderSection('content') ?>

            <!-- End of content -->
        </div>
    </main>
    <footer class="fixed-bottom bg-body border-top py-3 text-dark" style="background-image:url('/uploads/images/bgjp.webp')">
        <div class="container">
            <small class="text-dark"><strong>&copy; <?= date('Y')-2 ?> - <?= date('Y') ?> | PANEL By <?= BASE_NAME_FULL ?></strong></small>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.0/sweetalert2.all.min.js" integrity="sha512-0UUEaq/z58JSHpPgPv8bvdhHFRswZzxJUT9y+Kld5janc9EWgGEVGfWV1hXvIvAJ8MmsR5d4XV9lsuA90xXqUQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <?= script_tag('assets/js/natacode.js') ?>

    <?= $this->renderSection('js') ?>

</body>

</html>
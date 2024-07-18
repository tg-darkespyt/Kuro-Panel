<?php
include('mail.php');
?>

<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <?= $this->include('Layout/msgStatus') ?>
        <?php if (session()->getFlashdata('user_key')) : ?>
            <div class="alert alert-success" role="alert">
            <?php
            $durate = '';
            if(session()->getFlashdata('duration') <= 24) {
                $duration = session()->getFlashdata('duration');
                $durate .=$duration." Hour(s)";
            } else {
                $duration = (session()->getFlashdata('duration')/24);
                $durate .=$duration." Day(s)";
            }
            ?>
                Game : <?= session()->getFlashdata('game') ?> / <?php echo $durate ?><br>
                License : <strong class="key-sensi"><?= session()->getFlashdata('user_key') ?></strong><i class="bi bi-clipboard" name="copy" id="copybtn" onclick="copyText()"></i>
                <br>
                
                <body>
                  <textarea type="" name="mytext" id="mytext"><?= session()->getFlashdata('user_key') ?></textarea>
                <script>
            function copyText() {
                var mytext = document.getElementById("mytext"); 
                mytext.select(); // Select Text Field
                document.execCommand("copy");  // Copy Text
                document.getElementById("msg").innerHTML = "";
            }
            </script>    
    <style>
    // CSS
    .button-49,
    .button-49:after {
        width: 150px;
        height: 60px;
        text-align: center;
        line-height: 78px;
        font-size: 20px;
        font-family: 'Bebas Neue', sans-serif;
        background: linear-gradient(45deg, transparent 5%, #FF013C 5%);
        border: 0;
        color: #fff;
        letter-spacing: 3px;
        box-shadow: 6px 0px 0px #00E6F6;
        outline: transparent;
        position: relative;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
    }
textarea {
            width: 0%;
            height: 0px;
            padding: 0x 0px;
            border: 0px solid #00000000; 
            border-radius: 0px;
            background-color: #00000000;
            font-size: 16px;
            resize: none;
        }
    .button-49:after {
        --slice-0: inset(50% 50% 50% 50%);
        --slice-1: inset(80% -6px 0 0);
        --slice-2: inset(50% -6px 30% 0);
        --slice-3: inset(10% -6px 85% 0);
        --slice-4: inset(40% -6px 43% 0);
        --slice-5: inset(80% -6px 5% 0);
  
        content: 'ALTERNATE TEXT';
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, transparent 3%, #00E6F6 3%, #00E6F6 5%, #FF013C 5%);
        text-shadow: -3px -3px 0px #F8F005, 3px 3px 0px #00E6F6;
        clip-path: var(--slice-0);
    }

    .button-49:hover:after {
        animation: 1s glitch;
        animation-timing-function: steps(2, end);
    }

    @keyframes glitch {
        0% {
            clip-path: var(--slice-1);
            transform: translate(-20px, -10px);
        }
        10% {
            clip-path: var(--slice-3);
            transform: translate(10px, 10px);
        }
        20% {
            clip-path: var(--slice-1);
            transform: translate(-10px, 10px);
        }
        30% {
            clip-path: var(--slice-3);
            transform: translate(0px, 5px);
        }
        40% {
            clip-path: var(--slice-2);
            transform: translate(-5px, 0px);
        }
        50% {
            clip-path: var(--slice-3);
            transform: translate(5px, 0px);
        }
        60% {
            clip-path: var(--slice-4);
            transform: translate(5px, 10px);
        }
        70% {
            clip-path: var(--slice-2);
            transform: translate(-10px, 10px);
        }
        80% {
            clip-path: var(--slice-5);
            transform: translate(20px, -10px);
        }
        90% {
            clip-path: var(--slice-1);
            transform: translate(-10px, 0px);
        }
        100% {
            clip-path: var(--slice-1);
            transform: translate(0);
        }
    }

    @media (min-width: 768px) {
        .button-49,
        .button-49:after {
            width: 200px;
            height: 86px;
            line-height: 88px;
        }
    }
            
          // CSS
    .button-85 {
        padding: 0.6em 2em;
        border: none;
        outline: none;
        color: rgb(255, 255, 255);
        background: #111;
        cursor: pointer;
        position: relative;
        z-index: 0;
        border-radius: 10px;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
    }

    .button-85:before {
        content: "";
        background: linear-gradient(
            45deg,
            #ff0000,
            #ff7300,
            #fffb00,
            #48ff00,
            #00ffd5,
            #002bff,
            #7a00ff,
            #ff00c8,
            #ff0000
        );
        position: absolute;
        top: -2px;
        left: -2px;
        background-size: 400%;
        z-index: -1;
        filter: blur(5px);
        -webkit-filter: blur(5px);
        width: calc(100% + 4px);
        height: calc(100% + 4px);
        animation: glowing-button-85 20s linear infinite;
        transition: opacity 0.3s ease-in-out;
        border-radius: 10px;
    }

    @keyframes glowing-button-85 {
        0% {
            background-position: 0 0;
        }
        50% {
            background-position: 400% 0;
        }
        100% {
            background-position: 0 0;
        }
    }

    .button-85:after {
        z-index: -1;
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background: #222;
        left: 0;
        top: 0;
        border-radius: 10px;
    }

    </style>



                Available for <?= session()->getFlashdata('max_devices') ?> Devices<br>
                <small>
                    <i>Duration will start when license login.</i><br>
                    <i class="bi bi-wallet"></i> Saldo Reduce :
                    <span class="text-danger">-<?= session()->getFlashdata('fees') ?></span>
                    (Total left <?= $user->saldo ?>₹)
                </small>
            </div>
        <?php endif; ?>
        <div class="card">
 <div class="card-header p3 bg-dark text-white">
                <div class="row">
                    <div class="col pt-1">
                        🅒🅡🅔🅐🅣🅔 🅛🅘🅒🅔🅝🅢🅔
                    </div>
                    <div class="col text-end">
                        <a class="btn btn-outline-light btn-sm" href="<?= site_url('keys/download/new') ?>"><i class="bi bi-download"></i></a>
                        <a class="btn btn-sm btn-outline-light" href="<?= site_url('keys') ?>"><i class="bi bi-people"></i></a>
                        <a class="btn btn-sm btn-outline-light" href="<?= site_url('keys/price_detail') ?>"><i class="bi bi-tags-"></i>Price List</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= form_open() ?>

                <div class="row">
                    <div class="form-group col-lg-6 mb-3">
                        <label for="game" class="form-label">Games</label>
                        <?= form_dropdown(['class' => 'form-select', 'name' => 'game', 'id' => 'game'], $game, old('game') ?: '') ?>
                        <?php if ($validation->hasError('game')) : ?>
                            <small id="help-game" class="text-danger"><?= $validation->getError('game') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group col-lg-6 mb-3">
                        <label for="max_devices" class="form-label">Max Devices</label>
                        
                        <input type="number" name="max_devices" id="max_devices" class="form-control" placeholder="1" value="<?= old('max_devices') ?: 1 ?>" max="1000" min="1">
                        <?php if ($validation->hasError('game')) : ?>
                        
                        
                            <small id="help-max_devices" class="text-danger"><?= $validation->getError('max_devices') ?></small>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="form-group mb-3">
                    <label for="duration" class="form-label">Duration</label>
                    <?= form_dropdown(['class' => 'form-select', 'name' => 'duration', 'id' => 'duration'], $duration, old('duration') ?: '') ?>
                    <?php if ($validation->hasError('duration')) : ?>
                        <small id="help-duration" class="text-danger"><?= $validation->getError('duration') ?></small>
                    <?php endif; ?>
                </div>
                
                <div class="form-group col-lg-6 mb-3">
                   <label for="loopcount" class="form-label">Bulk Keys</label>         
                      <?= form_dropdown(['class'=>'form-select', 'name'=>'loopcount', 'id'=>'loopcount'], $loopcount, old('loopcount') ?: '') ?>
                      <?php if ($validation->hasError('loopcount')) : ?>
                            <small id="help-loopcount" class="text-danger"><?= $validation->getError('loopcount') ?></small>
                      <?php endif; ?>
                </div>
                
                
                <div class="form-group mb-3">
                    <label for="estimation" class="form-label">Estimation</label>
                    <input type="text" id="estimation" class="form-control" placeholder="Your order will total" readonly>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-dark">Generate</button>
                </div>
                <?= form_close() ?>

            </div>
        </div>
    </div>
</div>
</br></br></br>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?php if(($user->level == 1) || ($user->level == 2)) : ?>
<script>
    $(document).ready(function() {
        var price = JSON.parse('<?= $price ?>');
        getPrice(price);
        // When selected
        $("#max_devices, #loopcount, #duration, #game").change(function() {
            getPrice(price);
        });
        // try to get price
        function getPrice(price) {
            var price = price;
            var device = $("#max_devices").val();
            var durate = $("#duration").val();
            var bulk = $("#loopcount").val();
            var gprice = price[durate];
            if (gprice != NaN) {
                var res123 = (device * gprice);
                var result = (res123 * bulk);
                $("#estimation").val(result);
            } else {
                $("#estimation").val('Estimation error');
            }
        }
    });
</script>
<?php endif; ?>
<?php if($user->level == 3) : ?>
<script>
    $(document).ready(function() {
        var price = JSON.parse('<?= $price ?>');
        getPrice(price);
        // When selected
        $("#max_devices, #duration, #game").change(function() {
            getPrice(price);
        });
        // try to get price
        function getPrice(price) {
            var price = price;
            var device = $("#max_devices").val();
            var durate = $("#duration").val();
            var gprice = price[durate];
            if (gprice != NaN) {
                var result = (device * gprice);
                $("#estimation").val(result);
            } else {
                $("#estimation").val('Estimation error');
            }
        }
    });
</script>
<?php endif; ?>
<?= $this->endSection() ?>
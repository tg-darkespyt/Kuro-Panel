<?php

include('conn.php');
include('mail.php');

// For Credits
$sql = "SELECT * FROM credit where id=1";
$result = mysqli_query($conn, $sql);
$credit = mysqli_fetch_assoc($result);

?>

<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center pt-5">
    <div class="col-lg-4">
        <?= $this->include('Layout/msgStatus') ?>
            <marquee width="100%" direction="alternate" height="25px" onmouseover="this.stop();" onmouseout="this.start();">
                <strong> <p style="color:black;">CREDIT : PANEL DEVLOPED BY  </strong> <a href="https://telegram.me/DARKESPYT" class=" btn-buy text-secondary"><strong> <?php echo $credit['name']; ?> </strong></a>
            </marquee>
        <div class="card shadow-sm mb-5">
            <div class="card-header h5 p-3 bg-danger text-white">
                𝐋𝐎𝐆𝐈𝐍
            </div>
            <div class="card-body text-dark" style="color: white; background: rgba(0, 0, 0, 0); card-shadow: 0px 20px 0px; blur: 24px; alpha: 20%;">
                <?= form_open() ?>
                <div class="form-group mb-3">
                    <label for="username">𝑼𝒔𝒆𝒓𝒏𝒂𝒎𝒆</label>
                    <input type="text" class="form-control mt-2" name="username" id="username" aria-describedby="help-username" placeholder="Your username" required minlength="4">
                    <?php if ($validation->hasError('username')) : ?>
                        <small id="help-username" class="form-text text-danger"><?= $validation->getError('username') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group mb-3">
                    <label for="password">𝑷𝒂𝒔𝒔𝒘𝒐𝒓𝒅</label>
                    <input type="password" class="form-control mt-2 fa fa-fw fa-eye field_icon toggle-password" name="password" id="password" aria-describedby="help-password" placeholder="Your password" required minlength="6">
                    <?php if ($validation->hasError('password')) : ?>
                        <small id="help-password" class="form-text text-danger"><?= $validation->getError('password') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-check mb-3">
                    <label class="form-check-label" data-bs-toggle="tooltip" data-bs-placement="top" title="Keep session more than 30 minutes">
                        <input type="checkbox" class="form-check-input" name="stay_log" id="stay_log" value="yes">𝑺𝒕𝒂𝒚 𝑳𝒐𝒈𝒊𝒏?
                    </label>
                </div>
                <div class="form-group mb-2">
                    <button type="submit" class="btn btn-outline-warning text-dark"><i class="bi bi-box-arrow-in-right"></i> 𝐋𝐎𝐆𝐈𝐍</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
        <p class="text-center text-dark after-card">
            <small class="bg-dark text-white px-auto p-2 rounded">
                𝐷𝑜 𝑛𝑜𝑡 ℎ𝑎𝑣𝑒 𝑎𝑛 𝐴𝑐𝑐𝑜𝑢𝑛𝑡 𝑌𝑒𝑡?
                <a href="<?= site_url('register') ?>" class="text-white">𝑹𝒆𝒈𝒊𝒔𝒕𝒆𝒓 𝑯𝒆𝒓𝒆</a>
            </small>
            </br></br></br>
        </p>
</div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script> 
    $(document).on('click', '.toggle-password', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#password");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
</script> 
<?= $this->endSection() ?>
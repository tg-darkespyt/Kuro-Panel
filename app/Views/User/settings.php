<?php
include('mail.php');
?>

<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>

 <div class="row">
    <div class="col-lg-12">
        <?= $this->include('Layout/msgStatus') ?>
    </div>
  <div class="col-lg-12">
    <?php if (($user->level == 1) || ($user->level == 2)) : ?>
    <div class="col-lg-6">
        <div class="card mb-3">
            <div class="card-header h6 p-3 bg-danger text-dark">
                <strong>Change Password</strong>
            </div>
            <div class="card-body">
                <?= form_open() ?>

                <input type="hidden" name="password_form" value="1">
                <div class="form-group mb-2">
                    <label for="current">Current Password</label>
                    <input type="password" name="current" id="current" class="form-control mt-2 fa fa-fw fa-eye field_icon toggle-password-current" placeholder="Current Password">
                    <?php if ($validation->hasError('current')) : ?>
                        <small id="help-current" class="text-danger"><?= $validation->getError('current') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group mb-2">
                    <label for="password">New Password</label>
                    <input type="password" name="password" id="password" class="form-control mt-2 fa fa-fw fa-eye field_icon toggle-password" placeholder="New Password" aria-describedby="help-password">
                    <?php if ($validation->hasError('password')) : ?>
                        <small id="help-password" class="text-danger"><?= $validation->getError('password') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group mb-2">
                    <label for="password2">Confirm Password</label>
                    <input type="password" name="password2" id="password2" class="form-control mt-2 fa fa-fw fa-eye field_icon toggle-password2" placeholder="Password" aria-describedby="help-password2">
                    <?php if ($validation->hasError('password2')) : ?>
                        <small id="help-password2" class="text-danger"><?= $validation->getError('password2') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group my-2">
                    <button type="submit" class="btn btn-danger text-dark"><strong>Change Password</strong></button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="col-lg-6">
        <div class="card mb-3">
            <div class="card-header h6 p-3 bg-dark text-white">
                Accont Information
            </div>
            <div class="card-body">
                <?= form_open() ?>
                <input type="hidden" name="fullname_form" value="1">
                <div class="form-group mb-3">
                    <label for="fullname">Full Name</label>
                    <input type="text" name="fullname" id="fullname" class="form-control mt-2" placeholder="DARK ESP YT" aria-describedby="help-fullname" value="<?= old('fullname') ?: ($user->fullname ?: '') ?>">
                    <?php if ($validation->hasError('fullname')) : ?>
                        <small id="help-fullname" class="text-danger"><?= $validation->getError('fullname') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group my-2">
                    <button type="submit" class="btn btn-dark">Update Account</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script> 
    $(document).on('click', '.toggle-password-current', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#current");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
$(document).on('click', '.toggle-password', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#password");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
$(document).on('click', '.toggle-password2', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#password2");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
</script> 
<?= $this->endSection() ?>
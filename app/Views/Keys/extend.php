<?php
include('mail.php');
?>

<?= $this->extend('Layout/Starter') ?>
<?= $this->section('content') ?>

<div class="row pb-5 justify-content-center">
    <div class="col-lg-8">
        <?= $this->include('Layout/msgStatus') ?>

    </div>
    <?php if($user->level == 1) : ?>
    <div class="col-lg-8 mb-3">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <div class="row">
                    <div class="col pt-1">
                        Key Extend
                    </div>
                    <div class="col">
                        <div class="text-end">
                            <a class="btn btn-sm btn-outline-light" href="<?= site_url('keys/generate') ?>"><i class="bi bi-person-plus"></i></a>
                            <a class="btn btn-sm btn-outline-light" href="<?= site_url('keys') ?>"><i class="bi bi-people"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= form_open('keys/extend') ?>

                <div class="row">
                    
                        <div class="col-lg-6 mb-3">
                            <label for="type" class="form-label">Type</label>
                            <?= form_dropdown(['class' => 'form-select', 'name' => 'type', 'id' => 'type'], $type, old('type') ?: '') ?>
                            <?php if ($validation->hasError('type')) : ?>
                                 <small id="help-type" class="text-danger"><?= $validation->getError('type') ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-kg-6 mb-3" id="keys">
                            <label for="keys_id" class="form-label">Keys ID</label>
                            <input type="text" name="keys_id" id="keys_id" class="form-control" placeholder="Seperated with single space eg. 1 4 9 15" aria-describedby="help-keys_id" value="<?= old('keys_id') ?>">
                            <?php if($validation->hasError('keys_id')) : ?>
                                <small id="help-keys_id" class="text-danger"><?= $validation->getError('keys_id') ?></small>
                            <?php endif; ?>
                        </div>
                    <div class="col-md-12 mb-3">
                        <label for="expired_date" class="form-label">Expand Keys</label>
                        <?= form_dropdown(['class' => 'form-select', 'name' => 'expired_date', 'id' => 'expired_date'], $expired_date, old('expired_date') ?: '') ?>
                        <?php if ($validation->hasError('expired_date')) : ?>
                            <small id="help-expired_date" class="text-danger"><?= $validation->getError('expired_date') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-outline-dark btnUpdate">Update</button>
                    </div>
                    <?= form_close() ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

    <div class="col-lg-8 mb-3">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <div class="row">
                    <div class="col pt-1">
                        Status of Keys
                    </div>
                    <div class="col">
                        <div class="text-end">
                            <a class="btn btn-sm btn-outline-light" href="<?= site_url('keys/generate') ?>"><i class="bi bi-person-plus"></i></a>
                            <a class="btn btn-sm btn-outline-light" href="<?= site_url('keys') ?>"><i class="bi bi-people"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <?= form_open('keys/extend') ?>

                <div class="row">
                    
                        <div class="col-lg-6 mb-3">
                            <label for="type" class="form-label">Status</label>
                            <?= form_dropdown(['class' => 'form-select', 'name' => 'status', 'id' => 'status'], $status, old('status') ?: '') ?>
                            <?php if ($validation->hasError('status')) : ?>
                                 <small id="help-status" class="text-danger"><?= $validation->getError('status') ?></small>
                            <?php endif; ?>
                        </div>
                        
                        <div class="col-lg-6">
                            <button class="btn btn-outline-dark btnUpdate">Update</button>
                        </div>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script>
$(document).ready(function(event) {
  $('#type').on('change', function() {
    let selected = $('#type').val();
    if (selected == 2) {
      $("#keys").show();
    } else {
      $("#keys").hide();
    }
  });
  $("#keys").hide();
});
</script>
<?= $this->endSection() ?>
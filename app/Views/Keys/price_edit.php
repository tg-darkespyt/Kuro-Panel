<?php
include('mail.php');
?>

<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center pt-3">
    <div class="col-lg-8">
        <?= $this->include('Layout/msgStatus') ?>
    </div>
    <div class="col-lg-8 mb-3">
        <div class="card mb-5">
            <div class="card-header p-3 bg-dark text-white">
                Price - <?= $title ?>
                <div class="col text-end">
                        <a class="btn btn-sm btn-outline-light" href="<?= site_url('keys/price_detail') ?>" class="py-1 px-2 bg-white text-muted"><i class="bi bi-arrow-left"></i></a>
                </div>
            </div>
            <div class="card-body">
                <?= form_open() ?>
                <input type="hidden" name="price_id" value="<?= $target->id ?>">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label for="price_value" class="form-label">Duration (in hours)</label>
                        <input type="number" name="price_value" id="price_value" class="form-control" placeholder="Duration (in hours)" aria-describedby="help-price_value" value="<?= old('price_value') ?: $target->value ?>">
                        <?php if ($validation->hasError('price_value')) : ?>
                            <small id="help-price_value" class="form-text text-danger"><?= $validation->getError('price_value') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="price_duration" class="form-label">Duration Name</label>
                        <input type="text" name="price_duration" id="price_duration" class="form-control" placeholder="" aria-describedby="help-price_duration" value="<?= old('price_duration') ?: $target->duration ?>">
                        <?php if ($validation->hasError('price_duration')) : ?>
                            <small id="help-price_duration" class="form-text text-danger"><?= $validation->getError('price_duration') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="price_role" class="form-label">Roles</label>
                        <?php $sel_level = ['1' => 'Owner', '2' => 'Admin', '3' => 'Reseller']; ?>
                        <?= form_dropdown(['class' => 'form-select', 'name' => 'price_role', 'id' => 'price_role'], $sel_level, $target->role) ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="price_amount" class="form-label">Amount</label>
                        <input type="number" name="price_amount" id="price_amount" class="form-control" placeholder="" aria-describedby="help-price_amount" value="<?= old('price_amount') ?: $target->amount ?>">
                        <?php if ($validation->hasError('price_amount')) : ?>
                            <small id="help-price_amount" class="form-text text-danger"><?= $validation->getError('price_amount') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-12 mt-2">
                        <button type="submit" class="btn btn-outline-dark">Update</button>
                    </div>
                </div>
                <?= form_close() ?>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
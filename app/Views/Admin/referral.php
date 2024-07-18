<?php
include('conn.php');
include('mail.php');

// For Highest id Ref
$sqli = "SELECT * FROM referral_code
ORDER BY id_reff DESC
LIMIT 1;";
$result = mysqli_query($conn, $sqli);
$id_reff = mysqli_fetch_assoc($result);

// For Referral Code
$sql = "SELECT Referral FROM referral_code";
$result = mysqli_query($conn, $sql);
$refcode = mysqli_fetch_assoc($result);
$row = $refcode;

?>

<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12">
        <?= $this->include('Layout/msgStatus') ?>
    </div>
    <div class="col-lg-4 mb-3">
        <div class="card">
            <div class="card-header bg-dark text-white p-3">
                Generate <?= $title ?>
            </div>
            <div class="card-body">
                <?= form_open() ?>

                <div class="form-group mb-3">
                    <label for="set_saldo">You can set with multiple saldo</label>
                    <div class="input-group mt-2">
                        <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                        <input type="number" class="form-control" name="set_saldo" id="set_saldo" minlength="1" maxlength="11" value="5">
                    </div>
                    <?php if ($validation->hasError('set_saldo')) : ?>
                        <small id="help-saldo" class="text-danger"><?= $validation->getError('set_saldo') ?></small>
                    <?php endif; ?>
                </div>
                
                <div class="form-group mb-3">
                    <label for="accExpire" class="form-label">Account Expiration</label>
                    <?= form_dropdown(['class' => 'form-select', 'name' => 'accExpire', 'id' => 'accExpire'], $accExpire, old('accExpire') ?: '') ?>
                    <?php if ($validation->hasError('accExpire')) : ?>
                        <small id="help-accExpire" class="text-danger"><?= $validation->getError('accExpire') ?></small>
                    <?php endif; ?>
                </div>
                
                <div class="form-group mb-3">
                    <label for="accLevel" class="form-label">Account Level</label>
                    <?= form_dropdown(['class' => 'form-select', 'name' => 'accLevel', 'id' => 'accLevel'], $accLevel, old('accLevel') ?: '') ?>
                    <?php if ($validation->hasError('accLevel')) : ?>
                        <small id="help-accLevel" class="text-danger"><?= $validation->getError('accLevel') ?></small>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-dark">Create Code</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <?php if ($code) : ?>
            <div class="card">
                <div class="card-header bg-dark text-white p-3">
                    History Generate - Total <?= $total_code ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Referral</th>
                                    <th>Hashed</th>
                                    <th>Saldo</th>
                                    <th>Level</th>
                                    <th>Expiration</th>
                                    <th>Used by</th>
                                    <th>Create by</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($code as $c) : ?>
                                    <tr>
                                        <td><?= $c->id_reff ?></td>
                                        <td><?= $c->Referral ?></td>
                                        <td><?= substr($c->code, 1, 15) ?></td>
                                        <td>₹<?= $c->set_saldo ?></td>
                                        <td><?= $c->level ?></td>
                                        <td><?= $c->acc_expiration ?></td>
                                        <td><?= $c->used_by ?></td>
                                        <td><?= $c->created_by ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<br><br>
<?= $this->endSection() ?>
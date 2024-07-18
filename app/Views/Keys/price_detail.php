<?php include('mail.php'); ?>
<?= $this->extend('Layout/Starter') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12">
        <?= $this->include('Layout/msgStatus') ?>
    </div>
    <div class="col-lg-4 mb-3">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <div class="col pt-1">
                    <?= $title ?>
                </div>
                <div class"col text-end">
                    <a class="btn btn-sm btn-outline-light" href="<?= site_url('keys') ?>"><i class="bi bi-people"></i></a>
                    <a class="btn btn-outline-light btn-sm" href="<?= site_url('keys/generate') ?>"><i class="bi bi-person-plus "></i></a>
                </div>
            </div>
            <div class="card-body">
                <?= form_open() ?>
                
                <div class="form-group mb-3">
                    <label for="duration" class="form-label">Select Duration</label>
                    <?= form_dropdown(['class' => 'form-select', 'name' => 'duration', 'id' => 'duration'], $duration, old('duration') ?: '') ?>
                    <?php if ($validation->hasError('duration')) : ?>
                        <small id="help-duration" class="text-danger"><?= $validation->getError('duration') ?></small>
                    <?php endif; ?>
                </div>
                
                <div class="form-group mb-3">
                    <label for="setPrice">Set Price</label>
                    <div class="input-group mt-2">
                        <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                        <input type="number" class="form-control" name="setPrice" id="setPrice" minlength="1" maxlength="11" value="40">
                    </div>
                    <?php if ($validation->hasError('setPrice')) : ?>
                        <small id="help-price" class="text-danger"><?= $validation->getError('setPrice') ?></small>
                    <?php endif; ?>
                </div>
                
                <div class="form-group mb-3">
                    <label for="accLevel" class="form-label">Select Role/Level</label>
                    <?= form_dropdown(['class' => 'form-select', 'name' => 'accLevel', 'id' => 'accLevel'], $accLevel, old('accLevel') ?: '') ?>
                    <?php if ($validation->hasError('accLevel')) : ?>
                        <small id="help-accLevel" class="text-danger"><?= $validation->getError('accLevel') ?></small>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-dark">Create Price List</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <?php if ($code) : ?>
            <div class="card">
                <div class="card-header bg-dark text-white p-3">
                    Existing <?= $title ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Hour(s)</th>
                                    <th>Duration</th>
                                    <th>Price</th>
                                    <th>Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($code as $c) : ?>
                                    <tr>
                                        <td><?= $c['id'] ?></td>
                                        <td><?= $c['value'] ?></td>
                                        <td><?= $c['duration'] ?></td>
                                        <td>₹<?= $c['amount'] ?></td>
                                        <td><?= $c['role'] ?></td>
                                        <td>
                                            <a href="price/edit/<?php echo $c['id']; ?>" class="btn btn-dark btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <br></br>
                                            <a href="price/delete/<?php echo $c['id']; ?>" class="btn btn-dark btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
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
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
                    <a class="btn btn-outline-light btn-sm" href="<?= site_url('admin/manage-users') ?>">
                        <i class="bi bi-person-badge"></i>
                         Manage Users
                    </a>
                    <a class="btn btn-outline-light btn-sm" href="<?= site_url('keys/generate') ?>">
                        <i class="bi bi-person-plus"></i>
                         Generate Keys
                    </a>
                </div>
                <div class="card-body">
                    <?= form_open() ?>
                    <div class="row">
                        <div class="form-group mb-3">
                            <label class="h6 p-3" name="balance">
                                <i class="bi bi-wallet">
                                    Available Balance : 
                                </i>
                                ₹
                                <?= print_r($price, true); ?>
                            </label>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-dark" name="transfer">
                                    Transfer
                                </button>
                            </div>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </divî
</div>
<?= $this->endSection() ?>
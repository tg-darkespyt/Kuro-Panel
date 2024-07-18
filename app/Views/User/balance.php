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
                                <?= $balance ?>
                            </label>
                            <label for="userlist" class="form-label col-lg-6 mb-3">
                                Transfer Balance to
                            </label>
                            <select name="userlist" id="userlist" class="form-select col-lg-6 mb-3">
                                <option value="">
                                    Select an User
                                </option>
                                <?php foreach ($userlist as $user): ?>
                                    <option name="target_user_id" value="<?= $user['id_users'] ?>"><?= $user['username'] ?></option>
                                <?php endforeach; ?>
                            </select>
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
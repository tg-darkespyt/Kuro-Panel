<?php if (session()->getFlashdata('msgDanger')) : ?>
    <div class="alert alert-danger fade show" role="alert">
        <?= session()->getFlashdata('msgDanger') ?>
    </div>
<?php elseif (session()->getFlashdata('msgSuccess')) : ?>
    <div class="alert alert-success fade show" role="alert">
        <?= session()->getFlashdata('msgSuccess') ?>
    </div>
<?php elseif (session()->getFlashdata('msgWarning')) : ?>
    <div class="alert alert-warning fade show" role="alert">
        <?= session()->getFlashdata('msgWarning') ?>
    </div>
<?php else : ?>
    <?php if (session()->has('userid')) : ?>
        <?php if (isset($messages)) : ?>
            <div class="alert alert-<?= $messages[1] ?> fade show" role="alert">
                <?= $messages[0] ?>
            </div>
        <?php else : ?>
            <div class="alert alert-secondary fade show" role="alert">
                Welcome <?= getName($user) ?>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>WARN :</strong> This Site Gathers Your IP Address & Some Info to Save & Share with the Owner. Agree it to use else Please Ignore Our Site.!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
<?php endif; ?>
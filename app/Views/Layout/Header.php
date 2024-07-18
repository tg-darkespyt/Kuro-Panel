<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm align-middle" role="alert">
        <div class="container px-3">
            <a class="navbar-brand text-light" href="<?= site_url() ?>"><img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Zero_Logo.png" width="100" height="50" alt="" class="d-inline-block align-text-top"></a>
            <button class="navbar-toggler bg-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php if (session()->has('userid')) : ?>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="<?= site_url('keys') ?>">All Keys</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="<?= site_url('keys/generate') ?>">Create Key</a>
                        </li>

                        <!-- Topbar Search -->
                        <li
                            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                    aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="float-left">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle pe-2"></i><?= getName($user) ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="<?= site_url('settings') ?>">
                                            <i class="bi bi-sliders"></i> Settings
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li class="dropdown-item text-muted">Tools</li>
                                    <li>
                                        <a class="dropdown-item" href="<?= site_url('Profile') ?>">
                                            <i class="bi bi-person-lines-fill"></i> Profile
                                        </a>
                                    </li>

                                    <?php if ($user->level == 1) : ?>
                                        <li class="dropdown-item text-muted">Owner Control</li>
                                        <li>
                                            <a class="dropdown-item" href="<?= site_url('admin/manage-users') ?>">
                                                <i class="bi bi-person-lines-fill"></i> Manage Users
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?= site_url('admin/create-referral') ?>">
                                                <i class="bi bi-person-plus-fill"></i> Add Resellers
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?= site_url('admin/lib') ?>">
                                                <i class="bi bi-hammer"></i> Online Lib
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?= site_url('Server') ?>">
                                                <i class="bi bi-controller"></i> Mod Control
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                    <?php endif; ?>
                                    <li>
                                        <a class="dropdown-item text-danger" href="<?= site_url('logout') ?>">
                                            <i class="bi bi-box-arrow-in-left"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </nav>
</header>
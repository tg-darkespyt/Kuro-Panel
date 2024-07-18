<?php
include('mail.php');
?>

<?= $this->extend('Layout/Starter') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="row">
        <div class="col-lg-12">
            <?= $this->include('Layout/msgStatus') ?>
         </div>
<div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <div class="row">
                        <div class="col pt-1">
                            Keys Registered
                        </div>
                        
                        <div class="col text-end">
                          <div class="float-right">
                      
                         <?php if ($user->level == 1) : ?>
                           <a class="btn btn-outline-light btn-sm" href="<?= site_url('keys/extend') ?>"><i class="bi bi-calendar-plus"></i> Extend </i></a> 
                                         <?php endif; ?>  


                       <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-file-arrow-down-fill"></i> Menu   </a>
                              
                        
                   <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="navbarDropdown">
                                 <div class="card-header bg-light text-black h6 p-3">
                                     
                                     
                                        <li>     
                                        
   <a class="dropdown-item" id="blur-out" data-bs-toggle="tooltip" data-bs-placement="top" title="Eye Protect"><i class="bi bi-eye-slash"></i></a>    
                   

                           <a class="dropdown-item" href="<?= site_url('keys/generate') ?>"> <i class="bi bi-people style="color: red"></i> Generate Keys </i></a>

                          
                                 
                            <?php if($user->level == 1) : ?>
                            <a class="dropdown-item" href="<?= site_url('keys/download/all') ?>"><i class="bi bi-download"></i> 𝑑𝑜𝑤𝑛𝑙𝑜𝑎𝑑 𝑎𝑙𝑙 𝑘𝑒𝑦</a>
                            <?php endif; ?>
                           
                            <a class="dropdown-item" href="<?= site_url('keys/start')  ?>"><i class="bi bi-trash-fill"></i> 𝑈𝑠𝑒𝑑 𝐾𝑒𝑦 </a>
                        
                        
                              
                            <?php if($user->level == 1) : ?>
                            <a class="dropdown-item" href="<?= site_url('keys/alter') ?>"><i class="bi bi-trash-fill"></i> 𝑈𝑠𝑒𝑑 </a>
                            <?php endif; ?>
                           
                            <a class="dropdown-item" href="<?= site_url('keys/delete') ?>"><i class="bi bi-trash-fill"></i> 𝑑𝑒𝑙𝑒𝑡𝑒 𝐴𝑙𝑙</a>
                    </div>
                 </div>
              </div>
              <div class="card-body bg-light">
                    <?php if ($keylist) : ?>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-hover text-center" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Game</th>
                                        <th>User Keys</th>
                                        <th>Devices</th>
                                        <th>Duration</th>
                                        <th>Expired</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    <?php else : ?>
                        <p class="text-center">Nothing keys to show</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</br></br></br>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<?= link_tag("https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css") ?>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?= script_tag("https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js") ?>
<?= script_tag("https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js") ?>
<script>
    $(document).ready(function() {
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [0, "desc"]
            ],
            ajax: "<?= site_url('keys/api') ?>",
            columns: [{
                    data: 'id',
                    name: 'id_keys'
                },
                {
                    data: 'game',
                },
                {
                    data: 'user_key',
                    render: function(data, type, row, meta) {
                        var is_valid = (row.status == 'Active') ? "text-success" : "text-danger";
                        return `<span class="${is_valid} keyBlur key-sensi">${(row.user_key ? row.user_key : '&mdash;')}</span> `;
                    }
                },
                {
                    data: 'devices',
                    render: function(data, type, row, meta) {
                        var totalDevice = (row.devices ? row.devices : 0);
                        return `<span id="devMax-${row.user_key}">${totalDevice}/${row.max_devices}</span>`;
                    }
                },
                {
                    data: 'duration',
                    render: function(data, type, row, meta) {
                        return row.duration;
                    }
                },
                {
                    data: 'expired',
                    name: 'expired_date',
                    render: function(data, type, row, meta) {
                        return row.expired ? `<span id="exp-${row.user_key}" class="badge text-dark">${row.expired}</span>` : '(not started yet)';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        var btnReset = `<button class="btn btn-outline-danger btn-sm" onclick="resetUserKey('${row.user_key}')"
                        data-bs-toggle="tooltip" data-bs-placement="left" title="Reset key?"><i class="bi bi-bootstrap-reboot"></i></button>`;
                        var btnEdits = `<a href="${window.location.origin}/keys/${row.id}" class="btn btn-outline-dark btn-sm"
                        data-bs-toggle="tooltip" data-bs-placement="left" title="Edit key information?"><i class="bi bi-person"></i></a>`;
                        return `<div class="d-grid gap-2 d-md-block">${btnReset} ${btnEdits}</div>`;
                    }
                }
            ]
        });
        $("#blur-out").click(function() {
            if ($(".keyBlur").hasClass("key-sensi")) {
                $(".keyBlur").removeClass("key-sensi");
                $("#blur-out").html(`<i class="bi bi-eye"></i>`);
            } else {
                $(".keyBlur").addClass("key-sensi");
                $("#blur-out").html(`<i class="bi bi-eye-slash"></i>`);
            }
        });
    });
        
    function resetUserKey(keys) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reset'
        }).then((result) => {
            if (result.isConfirmed) {
                Toast.fire({
                    icon: 'info',
                    title: 'Please wait...'
                })
                var base_url = window.location.origin;
                var api_url = `${base_url}/keys/reset`;
                $.getJSON(api_url, {
                        userkey: keys,
                        reset: 1
                    },
                    function(data, textStatus, jqXHR) {
                        if (textStatus == 'success') {
                            if (data.registered) {
                                if (data.reset) {
                                    $(`#devMax-${keys}`).html(`0/${data.devices_max}`);
                                    Swal.fire(
                                        'Reset!',
                                        'Your device key has been reset.',
                                        'success'
                                    )
                                } else {
                                    Swal.fire(
                                        'Failed!',
                                        data.devices_total ? "You don't have any access to this user." : "User key devices already reset.",
                                        data.devices_total ? 'error' : 'warning'
                                    )
                                }
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    "User key no longer exists.",
                                    'error'
                                )
                            }
                        }
                    }
                );
            }
        });
    }
</script>
<?= $this->endSection() ?>
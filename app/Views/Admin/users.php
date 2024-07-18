<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-dark" role="alert">
            <strong>INFO :</strong> Search specify user by their (username, fullname, saldo or uplink).
        </div>
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white h6 p-3">
                <h2>𝐌𝐚𝐧𝐚𝐠𝐞 𝐔𝐬𝐞𝐫𝐬</h2>
           <div class="col text-end">
           <div class="float-right">
                        <a class="btn btn-outline-danger text=dark" href="<?= site_url('admin/user/alter') ?>">
                                            <i class="bi bi-trash-fill"></i>Delete Users
                                        </a>
                
           
            </div>
</div>
</div>
            <div class="card-body">
                <!-- <?php if ($user_list) : ?> -->

                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-hover text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="row">#</th>
                                <th>Username</th>
                                <th>Fullname</th>
                                <th>Level</th>
                                <th>Saldo</th>
                                <th>Status</th>
                                <th>Uplink</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- <?php endif; ?> -->

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
            ajax: "<?= site_url('admin/api/users') ?>",
            columns: [{
                    data: 'id',
                },
                {
                    data: 'username',
                },
                {
                    data: 'fullname',
                    render: function(data, type, row, meta) {
                        return (row.fullname ? row.fullname : '~');
                    }
                },
                {
                    data: 'level',
                },
                {
                    data: 'saldo',
                    render: function(data, type, row, meta) {
                        var textc = (row.level === 'Owner' ? 'primary' : 'dark');
                        var saldo = (row.level === 'Owner' ? '&mstpos;' : row.saldo);
                        return `<span class="badge text-${textc}">${saldo}</span>`;
                    }
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row, meta) {
                        var act = `<span class="text-success">Active</span>`;
                        var ban = `<span class="text-danger">Banned</span>`;
                        return (row.status == 1 ? act : ban);
                    }
                },
                {
                    data: 'uplink',
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        return `<a href="${window.location.origin}/admin/user/${row.id}" class="btn btn-dark btn-sm">EDIT</a>`;
                    }
                }
            ]
        });
    });
</script>

<?= $this->endSection() ?>
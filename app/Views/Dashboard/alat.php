<?= $this->extend('Layout/main') ?>
<?= $this->section('content') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Alat</h1>
    <a href="<?= base_url('alat/tambah') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Alat</a>
</div>
<!-- Content Row -->
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <div class="table-responsive">
                    <table class="init-datatable table table-hover table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">Gambar</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->section('script') ?>
<script>
    const myTable = new DataTable('.init-datatable', {
        responsive: true,
        ajax: {
            url: baseUrl + 'api/alat?wrap=data'
        },
        columns: [{
                data: 'gambar',
                width: "20%",
                render: function(data, type) {
                    if (type === 'display') {
                        return '<img src="' + data + '" height="100" />';
                    }

                    return data;
                }
            },
            {
                data: 'kategori.label'
            },
            {
                data: 'nama'
            },
            {
                data: 'id',
                width: "15%",
                render: function(data, type) {
                    if (type === 'display') {
                        return `<a class="btn btn-warning mr-2 btn-edit" href="${baseUrl + 'alat/edit/' + data}"><i class="fas fa-fw fa-pen"></i></a><button type="button" class="btn btn-danger btn-delete" data-id="${data}"><i class="fas fa-fw fa-trash"></i></button>`;
                    }

                    return data;
                }
            },
        ]
    });

    $('.init-datatable').on('click', '.btn-delete', function() {
        const id = $(this).data('id');

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: baseUrl + 'api/alat/' + id,
                    type: 'DELETE',
                    success: function() {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data berhasil di hapus!'
                        })
                        myTable.ajax.reload();
                    }
                })
            }
        })
    });
</script>
<?= $this->endSection(); ?>
<?= $this->endSection(); ?>
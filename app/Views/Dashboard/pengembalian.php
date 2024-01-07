<?= $this->extend('Layout/main') ?>
<?= $this->section('content') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pengembalian Alat</h1>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <div class="table-responsive">
                    <table class="init-datatable table table-hover table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Tanggal Sewa</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?= base_url('js/pages/pengembalian.js') ?>"></script>
<?= $this->endSection() ?>
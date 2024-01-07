<?= $this->extend('Layout/main') ?>
<?= $this->section('content') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Konfirmasi Pembayaran</h1>
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
                                <th scope="col">Status</th>
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
<template id="view-bukti">
    <div class="container">
        <img src="" alt="bukti" id="gambar-bukti" style="width: 100%;">
    </div>
</template>
<template id="control-bukti">
    <div style="display: flex; justify-content: end; align-items: center; gap: .3rem;">
        <button type="button" class="btn btn-danger btn-sm btn-close">Tutup</button>
    </div>
</template>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?= base_url('js/pages/konfirmasi.js') ?>"></script>
<?= $this->endSection() ?>
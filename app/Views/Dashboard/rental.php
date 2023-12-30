<?= $this->extend('Layout/main') ?>
<?= $this->section('content') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Rental</h1>
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

<template id="upload">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-info text-justify" role="alert">
                    Silahkan melakukan pembayaran dengan minimal DP 50% ke salah satu rekening dibawah ini lalu upload
                    bukti transfer ke form upload berikut.<br>
                    Jika sudah membayar DP minimal 50%, Pelunasan sisa pembayaran berada di akhir masa rental sekaligus
                    pengembalian alat.
                </div>
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    ATM & Mobile Bank
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex align-items-center w-100">
                                            <img src="<?= base_url('img/bri.png') ?>" height="60" class="mr-2">
                                            <div>
                                                <h5 class="mb-1">3291-8085-9211-4095</h5>
                                                <p class="mb-1">A/n Rikza Agung Trivianto</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    E-Wallet
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex align-items-center w-100">
                                            <img src="<?= base_url('img/dana.png') ?>" height="40" class="mr-2">
                                            <div>
                                                <h5 class="mb-1">0857-8656-6546</h5>
                                                <p class="mb-1">A/n Rikza Agung Trivianto</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <form action="/file-upload" class="dropzone" id="upload-form"></form>
            </div>
        </div>
    </div>
</template>
<template id="upload-control">
    <div style="display: flex; justify-content: end; align-items: center; gap: .3rem;">
        <button type="button" class="btn btn-danger btn-sm btn-close">Batal</button>
        <button type="button" class="btn btn-primary btn-sm btn-send" disabled>Upload</button>
    </div>
</template>
<?= $this->section('script') ?>
<script src="<?= base_url('js/pages/rental.js') ?>"></script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>
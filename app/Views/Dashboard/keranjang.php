<?= $this->extend('Layout/main') ?>
<?= $this->section('content') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Keranjang</h1>
</div>
<form action="#" method="POST" id="keranjang-form">
    <div class="keranjang-wrapper"></div>
    <div class="keranjang-bottom">
        <div>
            <p>Total Bayar :
                <span class="currency">Rp.</span>
                <span class="nominal">0</span>
            </p>
        </div>
        <a href="#" class="btn btn-primary btn-co">Checkout</a>
    </div>
</form>

<template id="keranjang-co">
    <div class="keranjang-co-items"></div>
</template>
<template id="keranjang-co-item">
    <div class="keranjang-item">
        <div class="k-left">
            <img src="" alt="">
            <div class="k-desc">
                <span class="k-category"></span>
                <p class="k-name"></p>
            </div>
        </div>
        <div class="k-right">
            <div class="k-price">
                <span class="currency">Rp.</span>
                <span class="nominal">100.000</span>
            </div>
        </div>
    </div>
</template>
<template id="keranjang-co-control">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <input type="text" class="form-control" name="tanggal_sewa" value="" style="width: auto;" required />
            <p style="margin: 0 1rem; padding: 0;">
                ( <span class="hari">0</span>
                Hari )
            </p>
            <p style="margin: 0 1rem; padding: 0;">Total Bayar : Rp.
                <span class="nominal">0</span>
            </p>
        </div>
        <div>
            <button type="button" class="btn btn-danger btn-sm btn-cancel">Batal</button>
            <button type="button" class="btn btn-primary btn-sm btn-co-konfirmasi" disabled>Konfirmasi</button>
        </div>
    </div>
</template>

<?= $this->section('script') ?>
<script src="<?= base_url('js/pages/keranjang_var.js') ?>"></script>
<script src="<?= base_url('js/pages/keranjang.js') ?>"></script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>
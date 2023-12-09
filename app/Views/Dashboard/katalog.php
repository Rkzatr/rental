<?= $this->extend('Layout/main') ?>
<?= $this->section('content') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Katalog</h1>
</div>

<div class="container">
    <div class="row">
        <div class="katalog-wrapper">
        </div>
    </div>
</div>
<?= $this->section('script') ?>
<script>
$(document).ready(async function() {
    await cloud.add(baseUrl + 'api/alat', {
        name: "alat"
    });
    cloud
        .addCallback("alat", (data) => {
            $(".katalog-wrapper").empty();
            data.forEach((alat) => {
                $(".katalog-wrapper").append(`<div class="katalog-item">
                <div class="image">
                    <img src="${alat.gambar}" alt="">
                    <span class="kategori">${alat.kategori.label}</span>
                </div>
                <div class="desc text-center">
                    <p class="title">${alat.nama}</p>
                    <p class="price">Rp. ${alat.harga}</p>
                    <button type="button" class="btn btn-success btn-sm">+ Keranjang</button>
                </div>
            </div>`);
            });
        })
        .pull("alat");
});
</script>
<?= $this->endSection(); ?>
<?= $this->endSection() ?>
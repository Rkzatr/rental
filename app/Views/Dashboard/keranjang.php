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
        <a href="#" class="btn btn-primary">Checkout</a>
    </div>
</form>

<?= $this->section('script') ?>
<script>
$("body").on('click', '.btn-hapus', function(e) {
    e.preventDefault();
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
            let id = $(this).data("id");
            let keranjang = JSON.parse(localStorage.getItem("keranjang"));
            delete keranjang[id];
            localStorage.setItem("keranjang", JSON.stringify(keranjang));
            $(this).closest(".keranjang-item").fadeOut("normal", function() {
                $(this).remove();
            });
        }
    })
});
$("body").on('click', '.btn-kurang', function(e) {
    e.preventDefault();
    if ($(this).closest(".keranjang-item").find(".k-qty").text() == 1) {
        return false;
    }
    let id = $(this).data("id");
    let keranjang = JSON.parse(localStorage.getItem("keranjang"));
    keranjang[id]--;
    localStorage.setItem("keranjang", JSON.stringify(keranjang));
    $(this).closest(".keranjang-item").find(".k-qty").text(keranjang[id]);
    let alat = cloud.get("alat").find(x => x.id == id);
    $(this).closest(".keranjang-item").find(".k-price .nominal").text((alat.harga * keranjang[id]).toString()
        .replace(/\B(?=(\d{3})+(?!\d))/g, "."));
    updateTotal();
});
$("body").on('click', '.btn-tambah', function(e) {
    e.preventDefault();
    let alat = cloud.get("alat").find(x => x.id == $(this).data("id"));
    let keranjang = JSON.parse(localStorage.getItem("keranjang"));
    if (keranjang[alat.id] == alat.stok) {
        Toast.fire({
            icon: 'warning',
            title: 'Stok sudah mencapai batas!'
        })
        return false;
    }
    keranjang[alat.id] = (keranjang[alat.id] ?? 0) + 1;
    localStorage.setItem("keranjang", JSON.stringify(keranjang));
    $(this).closest(".keranjang-item").find(".k-qty").text(keranjang[alat.id]);
    $(this).closest(".keranjang-item").find(".k-price .nominal").text((alat.harga * keranjang[alat.id])
        .toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
    updateTotal();
});

function updateTotal() {
    $(".keranjang-bottom .nominal").text(getTotal().toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
}

function getTotal() {
    let total = 0;
    $("input[name=items]").each(function(index, e) {
        if ($(e).is(":checked")) {
            let alat = cloud.get("alat").find(x => x.id == $(e).val());
            total += alat.harga * JSON.parse(localStorage.getItem("keranjang"))[$(e).val()];
        }
    });
    return total;
}

$("body").on('change', 'input.k-checkbox', function(e) {
    updateTotal();
});
$(document).ready(async function() {
    await cloud.add(baseUrl + 'api/alat', {
        name: "alat"
    });
    $(".keranjang-wrapper").empty();
    $.each(JSON.parse(localStorage.getItem("keranjang")) ?? {}, function(id, qty) {
        let alat = cloud.get("alat").find(x => x.id == id);
        $(".keranjang-wrapper").append(`
<div class="keranjang-item ${
qty == 0 ? "disabled" : ""
}">
    <div class="k-left">
        <input type="checkbox" name="items" value="${id}" class="k-checkbox" ${
qty == 0 ? "disabled" : ""
}>
        <img src="${
alat.gambar
}" alt="">
        <div class="k-desc">
            <span class="k-category">${
alat.kategori.label
}</span>
            <p class="k-name">${
alat.nama
}</p>
        </div>
    </div>
    <div class="k-right">
        <div class="k-price">
            <span class="currency">Rp.</span>
            <span class="nominal">${
(alat.harga * qty).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
}</span>
        </div>
        <a href="#" class="btn btn-warning btn-kurang" data-id="${id}">
            <i class="fas fa-minus"></i>
        </a>
        <p class="k-qty">${qty}</p>
        <a href="#" class="btn btn-success btn-tambah" data-id="${id}">
            <i class="fas fa-plus"></i>
        </a>
        <a href="#" class="btn btn-danger btn-hapus" data-id="${id}">
            <i class="fas fa-trash"></i>
        </a>
    </div>
</div>
        `);
    });
});
</script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>
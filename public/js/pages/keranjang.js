$("body").on("click", ".btn-hapus", function (e) {
  e.preventDefault();
  Swal.fire({
    title: "Apakah anda yakin?",
    text: "Anda tidak akan dapat mengembalikan ini!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya, Hapus!",
  }).then((result) => {
    if (result.isConfirmed) {
      let id = $(this).data("id");
      let keranjang = JSON.parse(localStorage.getItem("keranjang"));
      delete keranjang[id];
      localStorage.setItem("keranjang", JSON.stringify(keranjang));
      $(this)
        .closest(".keranjang-item")
        .fadeOut("normal", function () {
          $(this).remove();
          updateTotal();
          if (Object.keys(keranjangBarang.items).length === 0) {
            $(".keranjang-wrapper").append(`<img width="25%" src="${baseUrl}img/photographer.png" style="display: block; margin: 0 auto;"></img><p class="text-center">keranjang masih kosong</p>`);
          }
        });
    }
  });
});
$("body").on("click", ".btn-kurang", function (e) {
  e.preventDefault();
  if ($(this).closest(".keranjang-item").find(".k-qty").text() == 1) {
    return false;
  }
  let id = $(this).data("id");
  let keranjang = keranjangBarang.items;
  keranjang[id]--;
  localStorage.setItem("keranjang", JSON.stringify(keranjang));
  $(this).closest(".keranjang-item").find(".k-qty").text(keranjang[id]);
  let alat = cloud.get("alat").find((x) => x.id == id);
  $(this)
    .closest(".keranjang-item")
    .find(".k-price .nominal")
    .text((alat.harga * keranjang[id]).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
  updateTotal();
});
$("body").on("click", ".btn-tambah", function (e) {
  e.preventDefault();
  let alat = cloud.get("alat").find((x) => x.id == $(this).data("id"));
  let keranjang = keranjangBarang.items;
  if (keranjang[alat.id] == alat.stok) {
    Toast.fire({
      icon: "warning",
      title: "Stok sudah mencapai batas!",
    });
    return false;
  }
  keranjang[alat.id] = (keranjang[alat.id] ?? 0) + 1;
  localStorage.setItem("keranjang", JSON.stringify(keranjang));
  $(this).closest(".keranjang-item").find(".k-qty").text(keranjang[alat.id]);
  $(this)
    .closest(".keranjang-item")
    .find(".k-price .nominal")
    .text((alat.harga * keranjang[alat.id]).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
  updateTotal();
});

function updateTotal() {
  $(".keranjang-bottom .nominal").text(
    getTotal()
      .toString()
      .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
  );
}

function getTotal() {
  let total = 0;
  $("input[name=items]").each(function (index, e) {
    if ($(e).is(":checked")) {
      let alat = cloud.get("alat").find((x) => x.id == $(e).val());
      total += alat.harga * keranjangBarang.items[$(e).val()];
    }
  });
  console.log(total);
  return total;
}

$("body").on("change", "input.k-checkbox", function (e) {
  updateTotal();
});

$("body").on("click", ".swiper .btn-cancel", function (e) {
  $(".swiper-wrapper").fadeOut(400, function () {
    $(this).removeClass("active");
  });
});

$("body").on("click", ".btn-co", function (e) {
  if ($("input[name=items]:checked").length == 0) {
    Toast.fire({
      icon: "warning",
      title: "Pilih item terlebih dahulu!",
    });
    return false;
  }
  $(".swiper .content")
    .empty()
    .append($("template#keranjang-co").html())
    .promise()
    .then(function (e) {
      $('input[name="tanggal_sewa"]').daterangepicker(
        {
          minDate: new Date(),
          opens: "left",
          drops: "up",
          locale: {
            format: "DD/MM/YYYY",
          },
        },
        function (start, end, label) {
          let day = Math.abs(start.diff(end, "days"));
          $(".swiper .control")
            .find(".nominal")
            .text((getTotal() * day).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
          $(".swiper .control").find(".hari").text(day);
          if (day > 0) {
            $(".swiper .control")
              .find(".btn-co-konfirmasi")
              .attr("disabled", false)
              .off("click")
              .on("click", () => {
                let items = [];
                let qty = [];
                $.each($("input[name=items]:checked"), function (i, v) {
                  items.push($(this).val());
                  qty.push(keranjangBarang.items[$(this).val()]);
                });
                $.ajax({
                  type: "POST",
                  url: baseUrl + "api/rental",
                  data: {
                    tgl_sewa: start.format("YYYY-MM-DD"),
                    tgl_kembali: end.format("YYYY-MM-DD"),
                    harga: getTotal() * day,
                    alat: items,
                    qty: qty,
                  },
                  success: function (r) {
                    let keranjang = JSON.parse(localStorage.getItem("keranjang"));
                    $.each($("input[name=items]:checked"), function (i, v) {
                      delete keranjang[$(this).val()];
                    });
                    localStorage.setItem("keranjang", JSON.stringify(keranjang));
                    $(this)
                      .closest(".keranjang-item")
                      .fadeOut("normal", function () {
                        $(this).remove();
                        updateTotal();
                        if (Object.keys(keranjangBarang.items).length === 0) {
                          $(".keranjang-wrapper").append(`<img width="25%" src="${baseUrl}img/photographer.png" style="display: block; margin: 0 auto;"></img><p class="text-center">keranjang masih kosong</p>`);
                        }
                      });
                    Toast.fire({
                      icon: "success",
                      title: "Berhasil!",
                    });
                    setTimeout(function () {
                      window.location.href = baseUrl + "rental";
                    }, 1000);
                  },
                });
              });
          } else {
            $(".swiper .control").find(".btn-co-konfirmasi").attr("disabled", true);
          }
        }
      );
      $('input[name="tanggal_sewa"]').on("cancel.daterangepicker", function (ev, picker) {
        $(this).val("");
      });
      $.each($("input[name=items]:checked"), function (i, v) {
        const el = $($("template#keranjang-co-item").html());
        el.find("img").attr("src", cloud.get("alat").find((x) => x.id == $(this).val()).gambar);
        el.find(".k-name").text(cloud.get("alat").find((x) => x.id == $(this).val()).nama);
        el.find(".k-category").text(cloud.get("alat").find((x) => x.id == $(this).val()).kategori.label);
        el.find(".nominal").text((cloud.get("alat").find((x) => x.id == $(this).val()).harga * keranjangBarang.items[$(v).val()]).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        $(".keranjang-co-items").append(el);
      });
      $(".keranjang-co-items")
        .append(
          `
  <div class="keranjang-item">
      <div class="k-left">
          <div class="k-desc">
              <p class="k-name">Total</p>
          </div>
      </div>
      <div class="k-right">
          <div class="k-price">
              <span class="currency">Rp.</span>
              <span class="nominal total">100.000</span>
          </div>
      </div>
  </div>`
        )
        .find(".total")
        .text(
          getTotal()
            .toString()
            .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        );
      $(".swiper .control")
        .find(".nominal")
        .text((0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
    });
  $(".swiper .control").empty().append($("template#keranjang-co-control").html());
  $(".swiper-wrapper").fadeIn(400);
});
$(document).ready(async function () {
  await cloud.add(baseUrl + "api/alat", {
    name: "alat",
  });
  $(".keranjang-wrapper").empty();
  $.each(keranjangBarang.items, function (id, qty) {
    let alat = cloud.get("alat").find((x) => x.id == id);
    $(".keranjang-wrapper").append(`
<div class="keranjang-item ${qty == 0 ? "disabled" : ""}">
    <div class="k-left">
        <input type="checkbox" name="items" value="${id}" class="k-checkbox" ${qty == 0 ? "disabled" : ""}>
        <img src="${alat.gambar}" alt="">
        <div class="k-desc">
            <span class="k-category">${alat.kategori.label}</span>
            <p class="k-name">${alat.nama}</p>
        </div>
    </div>
    <div class="k-right">
        <div class="k-price">
            <span class="currency">Rp.</span>
            <span class="nominal">${(alat.harga * qty).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</span>
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
  if (Object.keys(keranjangBarang.items).length === 0) {
    $(".keranjang-wrapper").append(`<img width="25%" src="${baseUrl}img/photographer.png" style="display: block; margin: 0 auto;"></img><p class="text-center">keranjang masih kosong</p>`);
  }
});

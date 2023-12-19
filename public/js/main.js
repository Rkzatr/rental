$("body").on("click", ".katalog-item", function (e) {
  let alat = cloud.get("alat").find((a) => a.id == $(e.currentTarget).data("id"));
  console.log(alat);
  $(".slide-image img").attr("src", alat.gambar);
  $(".slide-image .kategori").text(alat.kategori.label);
  $(".slide-content h4").text(alat.nama);
  $(".slide-content .slide-text").html(alat.deskripsi.replace(new RegExp("\r?\n", "g"), "<br />"));
  $(".slide-content .nominal").text(alat.harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
  $(".slide-content .stok").text(alat.stok);
  $(".slide-wrapper").addClass("active");
  $(".slide-button .sewa").attr("data-id", alat.id);
  alat.stok > 0 ? $(".slide-button a").removeClass("disabled") : $(".slide-button a").addClass("disabled");
  setTimeout(function () {
    $(".slide").css("right", "0%");
  }, 100);
});
$("body").on("click", ".slide-close", function (e) {
  $(".slide").css("right", "-100%");
  setTimeout(function () {
    $(".slide-wrapper").removeClass("active");
  }, 100);
});
$("body").on("click", ".sewa", async function (e) {
  let alat = cloud.get("alat").find((a) => a.id == $(e.currentTarget).data("id"));
  let val = alat.id in JSON.parse(localStorage.getItem("keranjang") ?? "{}") ? JSON.parse(localStorage.getItem("keranjang"))[alat.id] : 1;
  console.log(val);
  const { value: jumlah } = await Swal.fire({
    title: "Mau sewa berapa?",
    icon: "question",
    input: "range",
    inputLabel: "masukkan jumlah",
    showCancelButton: true,
    inputAttributes: {
      min: "1",
      max: alat.stok,
      step: "1",
    },
    inputValue: val,
  });
  if (jumlah) {
    console.log(alat, jumlah);
    let store = localStorage.getItem("keranjang") ? JSON.parse(localStorage.getItem("keranjang")) : {};
    store[alat.id] = jumlah;
    localStorage.setItem("keranjang", JSON.stringify(store));
  }
});

$(document).ready(async function () {
  await cloud.add(baseUrl + "api/alat", { name: "temp" });
  let myStore = localStorage.getItem("keranjang") ? JSON.parse(localStorage.getItem("keranjang")) : {};
  $.each(myStore, function (i, v) {
    let temp100 = cloud.get("temp").find((a) => a.id == i);
    if (temp100.stok > 0) {
      if (v > temp100.stok) myStore[i] = temp100.stok;
    } else {
      myStore[i] = 0;
    }
    localStorage.setItem("keranjang", JSON.stringify(myStore));
  });
  $(".nav-item").removeClass("active");

  $.each(listMenu, function (label, v) {
    let menu = $($("#menu-single").html());
    menu.attr("data-id", v.id);
    menu.find(".nav-link").attr("href", v.url);
    menu.find(".fas").addClass("fa-" + v.icon);
    menu.find("span").text(label);
    menuContainer.append(menu);
    console.log(menu);
  });

  $(`.nav-item[data-id='${page}']`).addClass("active");
});

$("body").on("click", '.btn-upload', function () {
  $(".swiper .content")
    .empty()
    .append($("template#upload").html())
    .promise()
    .then(function (e) {
      $("#upload-form").dropzone({
        resizeMimeType: "image/jpeg"
      });
      //       $('input[name="tanggal_sewa"]').daterangepicker(
      //         {
      //           minDate: new Date(),
      //           opens: "left",
      //           drops: "up",
      //           locale: {
      //             format: "DD/MM/YYYY",
      //           },
      //         },
      //         function (start, end, label) {
      //           let day = Math.abs(start.diff(end, "days"));
      //           $(".swiper .control")
      //             .find(".nominal")
      //             .text((getTotal() * day).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
      //           $(".swiper .control").find(".hari").text(day);
      //           if (day > 0) {
      //             $(".swiper .control")
      //               .find(".btn-co-konfirmasi")
      //               .attr("disabled", false)
      //               .off("click")
      //               .on("click", () => {
      //                 let items = [];
      //                 let qty = [];
      //                 $.each($("input[name=items]:checked"), function (i, v) {
      //                   items.push($(this).val());
      //                   qty.push(keranjangBarang.items[$(this).val()]);
      //                 });
      //                 $.ajax({
      //                   type: "POST",
      //                   url: baseUrl + "api/rental",
      //                   data: {
      //                     tgl_sewa: start.format("YYYY-MM-DD"),
      //                     tgl_kembali: end.format("YYYY-MM-DD"),
      //                     harga: getTotal() * day,
      //                     alat: items,
      //                     qty: qty,
      //                   },
      //                   success: function (r) {
      //                     let keranjang = JSON.parse(localStorage.getItem("keranjang"));
      //                     $.each($("input[name=items]:checked"), function (i, v) {
      //                       delete keranjang[$(this).val()];
      //                     });
      //                     localStorage.setItem("keranjang", JSON.stringify(keranjang));
      //                     $(this)
      //                       .closest(".keranjang-item")
      //                       .fadeOut("normal", function () {
      //                         $(this).remove();
      //                         updateTotal();
      //                         if (Object.keys(keranjangBarang.items).length === 0) {
      //                           $(".keranjang-wrapper").append(`<img width="25%" src="${baseUrl}img/photographer.png" style="display: block; margin: 0 auto;"></img><p class="text-center">keranjang masih kosong</p>`);
      //                         }
      //                       });
      //                     Toast.fire({
      //                       icon: "success",
      //                       title: "Berhasilat!",
      //                     });
      //                     setTimeout(function () {
      //                       window.location.href = baseUrl + "rental";
      //                     }, 1000);
      //                   },
      //                 });
      //               });
      //           } else {
      //             $(".swiper .control").find(".btn-co-konfirmasi").attr("disabled", true);
      //           }
      //         }
      //       );
      //       $('input[name="tanggal_sewa"]').on("cancel.daterangepicker", function (ev, picker) {
      //         $(this).val("");
      //       });
      //       $.each($("input[name=items]:checked"), function (i, v) {
      //         const el = $($("template#keranjang-co-item").html());
      //         el.find("img").attr("src", cloud.get("alat").find((x) => x.id == $(this).val()).gambar);
      //         el.find(".k-name").text(cloud.get("alat").find((x) => x.id == $(this).val()).nama);
      //         el.find(".k-category").text(cloud.get("alat").find((x) => x.id == $(this).val()).kategori.label);
      //         el.find(".nominal").text((cloud.get("alat").find((x) => x.id == $(this).val()).harga * keranjangBarang.items[$(v).val()]).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
      //         $(".keranjang-co-items").append(el);
      //       });
      //       $(".keranjang-co-items")
      //         .append(
      //           `
      // <div class="keranjang-item">
      //     <div class="k-left">
      //         <div class="k-desc">
      //             <p class="k-name">Total</p>
      //         </div>
      //     </div>
      //     <div class="k-right">
      //         <div class="k-price">
      //             <span class="currency">Rp.</span>
      //             <span class="nominal total">100.000</span>
      //         </div>
      //     </div>
      // </div>`
      //         )
      //         .find(".total")
      //         .text(
      //           getTotal()
      //             .toString()
      //             .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
      //         );
      //       $(".swiper .control")
      //         .find(".nominal")
      //         .text((0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
    });
  $(".swiper .control").empty().append($("template#upload-control").html());
  $(".swiper-wrapper").fadeIn(400);
});

$("body").on("click", ".swiper .btn-close", function (e) {
  $(".swiper-wrapper").fadeOut(400, function () {
    $(this).removeClass("active");
  });
});

$(document).ready(async function () {
  await cloud.add(baseUrl + "api/alat", {
    name: "alat",
  });
  const myTable = new DataTable(".init-datatable", {
    responsive: true,
    ajax: {
      url: baseUrl + "api/rental?wrap=data",
    },
    columns: [
      {
        data: "detail",
        render: function (data, type, row) {
          let view = "";
          $.each(data, function (i, d) {
            const a = cloud.get("alat").find((x) => x.id == d.id_alat);
            view += `<li>(${d.qty}) ${a.nama}</li>`;
          });
          return view;
        },
      },
      {
        data: "tgl_sewa",
        render: function (data, type, row) {
          const dari = moment(data, "YYYY-MM-DD");
          const sampai = moment(row.tgl_kembali, "YYYY-MM-DD");
          return dari.format("DD/MM/YYYY") + " - " + sampai.format("DD/MM/YYYY") + " (" + Math.abs(dari.diff(sampai, "days")) + " Hari)";
        },
      },
      {
        data: "status",
        render: function (data, type) {
          switch (data) {
            case 0:
              return '<span class="badge badge-warning">Menunggu Pembayaran</span>';
            case 1:
              return '<span class="badge badge-info">Menunggu Konfirmasi</span>';
            case 2:
              return '<span class="badge badge-primary">Rental berjalan</span>';
            case 5:
              return '<span class="badge badge-danger">Membayar Denda</span>';
            case 10:
              return '<span class="badge badge-success">Rental Selesai</span>';
            case 11:
              return '<span class="badge badge-danger">Rental Ditolak</span>';
            default:
              return '<span class="badge badge-danger">Error</span>';
          }
        },
      },
      {
        data: "id",
        width: "15%",
        render: function (data, type, row) {
          const btnCancel = `<a class="btn btn-danger btn-sm mr-2 btn-cancel" href="#!"><i class="fas fa-fw fa-times"></i></a>`;
          const btnUpload = `<a class="btn btn-primary btn-sm mr-2 btn-upload" href="#!"><i class="fas fa-fw fa-upload"></i></a>`;
          const btnView = `<a class="btn btn-success btn-sm mr-2 btn-view" href="#!"><i class="fas fa-fw fa-eye"></i></a>`;

          switch (row.status) {
            case 0:
              return btnUpload + btnCancel;
            case 1:
              return btnView + btnCancel;
            case 11:
              return '<span class="badge badge-danger">Rental Ditolak</span>';
            default:
              return btnView;
          }
        },
      },
    ],
  });
});

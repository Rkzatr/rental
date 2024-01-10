$("body").on("click", ".swiper .btn-close", function (e) {
  $(".swiper-wrapper").fadeOut(400, function () {
    $(this).removeClass("active");
  });
});

$(document).ready(async function () {
  await cloud.add(baseUrl + "api/alat", {
    name: "alat",
  });
  await cloud.add(baseUrl + "api/rental", {
    name: "rental",
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
        render: function (data, type, row) {
          switch (data) {
            case 0:
              return '<span class="badge badge-warning">Menunggu Pembayaran</span>';
            case 1:
              return '<span class="badge badge-info">Menunggu Konfirmasi</span>';
            case 2:
              return '<span class="badge badge-primary">Rental berjalan</span>';
            case 5:
              return '<span class="badge badge-danger">Membayar Denda</span><br><small>Rp. ' + row.denda.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '</small>';
            case 10:
              return '<span class="badge badge-success">Rental Selesai</span>';
            case 11:
              return '<span class="badge badge-danger">Rental Ditolak</span>';
            case 12:
              return '<span class="badge badge-danger">Rental Dibatalkan</span>';
            default:
              return '<span class="badge badge-danger">Error</span>';
          }
        },
      },
      {
        data: "id",
        width: "15%",
        render: function (data, type, row) {
          const btnCancel = `<a class="btn btn-danger btn-sm mr-2 btn-cancel" href="#!" data-id="${data}"><i class="fas fa-fw fa-times"></i></a>`;
          const btnKonfirmasi = `<a class="btn btn-primary btn-sm mr-2 btn-konfirmasi" href="#!" data-id="${data}"><i class="fas fa-fw fa-check"></i></a>`;
          const btnDenda = `<a class="btn btn-primary btn-sm mr-2 btn-denda" href="#!" data-id="${data}"><i class="fas fa-fw fa-check"></i></a>`;
          const btnView = `<a class="btn btn-success btn-sm mr-2 btn-view" href="#!" data-id="${data}"><i class="fas fa-fw fa-eye"></i></a>`;

          switch (row.status) {
            case 0:
              return btnKonfirmasi + btnCancel;
            case 1:
              return btnKonfirmasi + btnView + btnCancel;
            case 5:
              return btnDenda + btnView;
            case 11:
              return '<span class="badge badge-danger">Rental Ditolak</span>';
            default:
              return btnView;
          }
        },
      },
    ],
  });
  cloud.addCallback("rental", function () {
    myTable.ajax.reload();
  });
});

$("body").on("click", ".btn-konfirmasi", function (e) {
  const id = $(this).data("id");
  Swal.fire({
    title: "Apakah anda yakin ingin mengkonfirmasi rental ini?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya",
    cancelButtonText: "Tidak",
  }).then((result) => {
    if (result.isConfirmed == false) return;
    $.ajax({
      url: baseUrl + "api/rental/konfirmasi/" + id,
      type: "GET",
      success: function (data) {
        cloud.pull("rental");
        console.log(data);
      },
    });
  });
});
$("body").on("click", ".btn-denda", function (e) {
  const id = $(this).data("id");
  Swal.fire({
    title: "Apakah anda yakin user ini sudah membayar denda?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya",
    cancelButtonText: "Tidak",
  }).then((result) => {
    if (result.isConfirmed == false) return;
    $.ajax({
      url: baseUrl + "api/rental/denda/" + id,
      type: "GET",
      success: function (data) {
        cloud.pull("rental");
        console.log(data);
      },
    });
  });
});

$("body").on("click", ".btn-cancel", function (e) {
  const id = $(this).data("id");
  Swal.fire({
    title: "Apakah anda yakin ingin membatalkan rental ini?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya",
    cancelButtonText: "Tidak",
  }).then((result) => {
    if (result.isConfirmed == false) return;
    $.ajax({
      url: baseUrl + "api/rental/cancel/" + id,
      type: "GET",
      success: function (data) {
        cloud.pull("rental");
        console.log(data);
      },
    });
  });
});

$("body").on("click", ".btn-view", function (e) {
  const id = $(this).data("id");
  const data = cloud.get("rental").find((x) => x.id == id);
  $(".swiper .content")
    .empty()
    .append($("template#view-bukti").html())
    .promise()
    .then(function (e) {
      console.log(data);
      $(this).find("img#gambar-bukti").attr("src", baseUrl + "img/bukti/" + data.file);
    });
  $(".swiper .control").empty().append($("template#control-bukti").html());
  $(".swiper-wrapper").fadeIn(400);
});
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
      url: baseUrl + "api/rental?wrap=data&status=2",
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
        data: "id",
        width: "15%",
        render: function (data, type, row) {
          const btnKonfirmasi = `<a class="btn btn-primary btn-sm mr-2 btn-konfirmasi" href="#!" data-id="${data}"><i class="fas fa-fw fa-check"></i></a>`;
          return btnKonfirmasi;
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
    title: "Apakah alat rental ini sudah dikembalikan ?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sudah",
    cancelButtonText: "Belum",
  }).then((result) => {
    if (result.isConfirmed == false) return;
    $.ajax({
      url: baseUrl + "api/rental/pengembalian/" + id,
      type: "GET",
      success: function (data) {
        cloud.pull("rental");
        console.log(data);
      },
    });
  });
});
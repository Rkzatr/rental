$(document).ready(function () {
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
            const a = cloud.get("temp").find((x) => x.id == d.id_alat).nama;
            view += `<li>${a}</li>`;
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
              return '<span class="badge badge-danger">Denda</span>';
            case 10:
              return '<span class="badge badge-success">Rental Selesai</span>';
            default:
              return '<span class="badge badge-danger">Error</span>';
          }
        },
      },
      {
        data: "id",
        width: "15%",
        render: function (data, type) {
          return data;
        },
      },
    ],
  });
});

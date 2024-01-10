const keranjangBarang = {
  get items() {
    let store = {};
    if (localStorage.getItem("keranjang") && Object.keys(JSON.parse(localStorage.getItem("keranjang"))).includes(cloud.get("user").id.toString())) {
      console.log(cloud.get("user").id.toString());
      $.each(JSON.parse(localStorage.getItem("keranjang"))[cloud.get("user").id], function (i, v) {
        store[i] = parseInt(v);
      });
    }
    return store;
  },
  setItem(id, jumlah) {
    const alat = cloud.get("temp").find((a) => a.id == id);
    let store = JSON.parse(localStorage.getItem("keranjang") ?? "{}");
    let item = this.items;
    item[id] = jumlah > alat.stok ? parseInt(alat.stok) : parseInt(jumlah);
    store[cloud.get("user").id] = item;
    localStorage.setItem("keranjang", JSON.stringify(store));
  },
  removeItem(id) {
    let item = this.items;
    delete item[id];
    let store = JSON.parse(localStorage.getItem("keranjang") ?? "{}");
    store[cloud.get("user").id] = item;
    localStorage.setItem("keranjang", JSON.stringify(store));
  },
  clear() {
    let item = this.items;
    $.each(item, function (a, j) {
      delete item[a];
    });
    let store = JSON.parse(localStorage.getItem("keranjang") ?? "{}");
    store[cloud.get("user").id] = item;
    localStorage.setItem("keranjang", JSON.stringify(store));
  },
  addItem(id) {
    let item = this.items;
    const alat = cloud.get("temp").find((a) => a.id == id);
    if (item[id] == alat.stok) {
      Toast.fire({
        icon: "warning",
        title: "Stok sudah mencapai batas!",
      });
      return false;
    }
    item[id] = item[id] + 1;
    let store = JSON.parse(localStorage.getItem("keranjang") ?? "{}");
    store[cloud.get("user").id] = item;
    localStorage.setItem("keranjang", JSON.stringify(store));
  },
  subItem(id) {
    let item = this.items;
    if (item[id] == 1) {
      Swal.fire({
        icon: "warning",
        title: "Apakah anda ingin menghapus item ini?",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Hapus!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.removeItem(id);
        }
      })
      return false;
    }
    item[id] = item[id] - 1;
    let store = JSON.parse(localStorage.getItem("keranjang") ?? "{}");
    store[cloud.get("user").id] = item;
    localStorage.setItem("keranjang", JSON.stringify(store));
  },
  getItem(id) {
    return this.items[id] ?? null;
  },
};

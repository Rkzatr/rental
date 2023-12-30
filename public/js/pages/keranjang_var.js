const keranjangBarang = {
  get items() {
    let store = {};
    $.each(JSON.parse(localStorage.getItem("keranjang") ?? "{}"), function (i, v) {
      store[i] = parseInt(v);
    });
    return store;
  },
};

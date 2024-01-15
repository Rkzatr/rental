$("body").on("submit", "#form-profil", function (e) {
  e.preventDefault();
  const data = {};
  $(this).serializeArray().map(function (x) { data[x.name] = x.value; });
  console.log(data);
  $.ajax({
    type: "POST",
    url: baseUrl + "api/profil/save",
    data: data,
    dataType: "JSON",
    success: function (res) {
      Toast.fire({
        icon: Object.keys(res.messages)[0],
        title: Object.values(res.messages)[0],
      })
    }
  });
});
$("body").on("click", ".btn-form-password", function (e) {
  $(".swiper .content")
    .empty()
    .append($("template#profil-password").html())
    .promise()
    .then(function (e) {
    });
  $(".swiper .control").empty().append($("template#profil-password-control").html());
  $(".swiper-wrapper").fadeIn(400);
});
$("body").on("click", ".btn-form-password-submit", function (e) {
  e.preventDefault();
  const data = {};
  $("#form-password").serializeArray().map(function (x) { data[x.name] = x.value; });
  $("#form-password")[0].reportValidity();
  if ($("#form-password")[0].checkValidity()) {
    if (data.password !== data.password_confirm) {
      Toast.fire({
        icon: "warning",
        title: "Password tidak sama!",
      });
      return false;
    }
    $.ajax({
      type: "POST",
      url: baseUrl + "api/profil/save",
      data: data,
      dataType: "JSON",
      success: function (res) {
        Toast.fire({
          icon: Object.keys(res.messages)[0],
          title: Object.values(res.messages)[0],
        });
        $(".swiper-wrapper").fadeOut(400, function () {
          $(this).removeClass("active");
        })
      }
    })
  }
});
$("body").on("click", ".swiper .btn-cancel", function (e) {
  $(".swiper-wrapper").fadeOut(400, function () {
    $(this).removeClass("active");
  });
});
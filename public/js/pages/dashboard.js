$(document).ready(async function () {
  await cloud.add(baseUrl + "api/rental", {
    name: "rental",
  });
  for (const status of [1, 2, 5, 10]) {
    $('.count-' + status).text(cloud.get("rental").filter((x) => x.status == status).length).counterUp({
      delay: 10,
    });
  }
});
for (let element of document.querySelectorAll(".modal-data")) {
  element.onclick = function (event) {
    let id = event.target.getAttribute("data-row-id")
    let flag = event.target.getAttribute("data-modal-flag")
    document.location.search = flag + "=" + id
  }
}

for (let element of document.querySelectorAll(".modal")) {
  element.addEventListener("hidden.bs.modal", function () {
    document.location.search = ""
  })
}

if (document.location.search !== "") {
  let action = document.location.search
      .substring(1)
      .split("&")[0]
      .split("=")[0]
  document.getElementById(action + "_modal").click()
}

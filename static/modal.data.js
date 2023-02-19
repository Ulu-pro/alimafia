for (let button of document.querySelectorAll(".modal-data")) {
  button.onclick = function (event) {
    let id = event.target.getAttribute("data-row-id")
    let flag = event.target.getAttribute("data-modal-flag")
    document.location.search = flag + "=" + id
  }
}

for (let modal of document.querySelectorAll(".modal")) {
  modal.addEventListener("hide.bs.modal", function () {
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

for (let form of document.querySelectorAll("form")) {
  form.setAttribute("autocomplete", "off")
}

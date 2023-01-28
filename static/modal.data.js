for (let element of document.querySelectorAll(".modal-data")) {
  element.onclick = function (event) {
    let id = event.target.getAttribute("data-row-id")
    let flag = event.target.getAttribute("data-modal-flag")
    document.getElementById(flag + "RowID").value = id;
  }
}
for (let button of document.querySelectorAll(".modal-data")) {
  button.onclick = function (event) {
    let id = event.target.getAttribute("data-row-id")
    let flag = event.target.getAttribute("data-modal-flag")
    document.location.search = flag + "=" + id
  }
}

for (let modal of document.querySelectorAll(".modal")) {
  modal.addEventListener("show.bs.modal", function (event) {
    compute(event.target.querySelector("[name='price']"))
  })
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

for (let label of document.querySelectorAll("[name='price'], [name='discount']")) {
  label.addEventListener('input', function (event) {
    compute(event.target)
  })
}

function compute(element) {
  let price, discount, computed
  price = element.form.querySelector("[name='price']").value
  discount = element.form.querySelector("[name='discount']").value
  computed = element.form.querySelector("[data-price-computed]")
  computed.innerText = (price * (1 - discount / 100)).toFixed(2)
}

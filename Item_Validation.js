function validateItem() {
  let f = document.itemForm;
  if (
    f.item_code.value === "" ||
    f.item_name.value === "" ||
    f.category.value === "" ||
    f.sub_category.value === "" ||
    f.quantity.value === "" ||
    f.unit_price.value === ""
  ) {
    alert("All fields are required!");
    return false;
  }
  if (isNaN(f.unit_price.value)) {
    alert("Unit price must be numeric!");
    return false;
  }
  return true;
}

function searchItem() {
  let keyword = document.getElementById("search").value.toLowerCase();
  let rows = document.querySelectorAll("#itemTable tbody tr");
  rows.forEach(row => {
    row.style.display = row.innerText.toLowerCase().includes(keyword) ? "" : "none";
  });
}

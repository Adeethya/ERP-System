function validation() {
  const title = document.MyForm.title.value;
  const fname = document.MyForm.first_name.value;
  const lname = document.MyForm.last_name.value;
  const contact = document.MyForm.contact_number.value;
  const district = document.MyForm.district.value;

  if (title === "" || fname === "" || lname === "" || contact === "" || district === "") {
    alert("All fields are required!");
    return false;
  }

  if (isNaN(contact)) {
    alert("Contact number must be numeric!");
    return false;
  }

  return true;
}

function searchCategoryChange(category) {
  document.getElementById("category").innerText = "Search " + category;
  document.getElementById("inputcategory").value = category;
}

function setPreviewImg(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      document.getElementById('previewimg').src=e.target.result;
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

function divHide(div_id) {
  document.getElementById(div_id).style.display = "none";
}

function divShow(div_id) {
  document.getElementById(div_id).style.display = "";
}

function checkBoxChange(book_id) {
  var checkBox = document.getElementById("checkbox_" + book_id);
  if (checkBox.checked == true) {
    divShow("div_hide_" + book_id);
  } else {
    divHide("div_hide_" + book_id);
  }
}
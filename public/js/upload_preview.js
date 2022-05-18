// Periksa format file
function checkFormat(file) {
    const fileName = file.files[0].name.toLowerCase();
    const fileExtension = fileName.split(".").slice(-1)[0];
  
    // Tentukan format yang diterima untuk setiap input
    const acceptedFormat = ["jpg", "jpeg", "png"];
  
    if (acceptedFormat.includes(fileExtension)) {
      return false;
    } else {
      return true;
    }
  }
  
  // Periksa ukuran file
  function checkSize(file) {
    const fileSize = file.files[0].size;
    if (fileSize > 1000000) {
      return true;
    } else {
      return false;
    }
  }
  
  // Beritahu kesalahan kepada user
  function createErrorMessage(element, message) {
    const errorElement = document.createElement("small");
    const errorText = document.createTextNode(message);
    errorElement.appendChild(errorText);
    errorElement.classList.add("error-message");
    element.parentElement.appendChild(errorElement);
  }

//   MAIN FUNC

const previewImage=()=>{
    const image=document.getElementById('input_image');
    const imagePreview=document.getElementById('img-preview');

    imagePreview.style.display='block';

    const oFReader=new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload=function(oFREvent){
        imagePreview.src=oFREvent.target.result;
    }

   
      if (checkFormat(image)) {
        if (image.parentElement.querySelector(".error-message")) {
          image.parentElement.querySelector(".error-message").innerText =
            "The file you uploaded is not an image";
        } else {
          createErrorMessage(image, "The file you uploaded is not an image");
        }
        image.classList.add("is-invalid");
      } else if (checkSize(image)) {
        if (image.parentElement.querySelector(".error-message")) {
          image.parentElement.querySelector(".error-message").innerText =
            "Maximum file size is 2MB";
        } else {
          createErrorMessage(image, "Maximum file size is 2MB");
        }
        image.classList.add("is-invalid");
      } else {
        if (
          image.classList.contains(
            "is-invalid"
          )
        ) {
          image.classList.remove(
            "is-invalid"
          );
          image.parentElement.querySelector(".error-message").remove();
        }
      }
}

 

  


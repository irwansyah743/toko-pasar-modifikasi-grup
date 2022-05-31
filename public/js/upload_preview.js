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
    const imagePreview=document.getElementById('img-preview')
    const file = image.files[0];
    const reader = new FileReader();;

    imagePreview.style.display='block';
    if (file) {
      reader.readAsDataURL(file);
    }
    reader.addEventListener("load", function () {
      // convert image file to base64 string
      imagePreview.src = reader.result;
    }, false);

   
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

const previewImages=()=>{
  const image=document.getElementById('input_images');
    const imagePreview=document.getElementById('img-previews');
    removeAllChildNodes(imagePreview);
    const files = image.files;
  
    if (files) {
      Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.addEventListener("load", function () {
          const imageToAppend=document.createElement("IMG");
          imageToAppend.src=reader.result;
          imageToAppend.classList.add('col-md-3');
          imageToAppend.classList.add('mt-2');
          imagePreview.appendChild(imageToAppend);
        }, false);
      });
    }
}

function removeAllChildNodes(parent) {
  while (parent.firstElementChild) {
      parent.removeChild(parent.firstElementChild);
  }
}

 

  


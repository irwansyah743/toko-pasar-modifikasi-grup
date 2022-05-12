const previewImage=()=>{
    const image=document.getElementById('input_image');
    const imagePreview=document.getElementById('img-preview');

    imagePreview.style.display='block';

    const oFReader=new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload=function(oFREvent){
        imagePreview.src=oFREvent.target.result;
    }
}
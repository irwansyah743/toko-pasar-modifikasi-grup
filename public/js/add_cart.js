async function productView(id){
    try {
        const data = await getProduct(id);
        document.getElementById('pname').innerHTML=data.product.product_name;
        
        document.getElementById('pcode').innerHTML=data.product.product_code;
        document.getElementById('pstock').innerHTML=data.product.product_qty;
        document.getElementById('pcategory').innerHTML=data.product.category.category_name;
        document.getElementById('pbrand').innerHTML=data.product.brand.brand_name;
        document.getElementById('pimage').src=`storage/${data.product.product_thambnail}`;
        if(data.product.discount_price==null){
            document.getElementById('price').innerHTML=`Rp.${data.product.selling_price}K`;
        }else{
            document.getElementById('price').innerHTML=`Rp.${data.product.discount_price}K`;
            document.getElementById('oldprice').innerHTML=` Rp.${data.product.selling_price}K`;
        }
        removeAllChildNodes( document.getElementById('pcolor'));
        removeAllChildNodes( document.getElementById('psize'));
        
        data.colors.forEach(color => {
            document.getElementById('pcolor').innerHTML+=createSelectOption(color);
            document.getElementById('pcolor').value=color;
        });


        data.sizes.forEach(size => {
            document.getElementById('psize').innerHTML+=createSelectOption(size);
            document.getElementById('psize').value=size;
        });
    } catch (err) {

        console.log(err);

    }
}

async function getProduct(id) {
    return fetch(`http://127.0.0.1:8000/product/view/modal/${id}`,{
        type: "GET",
        dataType: "json",
    }).then((response) => {
        if (response.status !== 200) {
            
            throw new Error(response.statusText);
        }
        return response.json();
    });
}

function createSelectOption(data) {
    return `<option value="${data}">${data}</option>`;
}
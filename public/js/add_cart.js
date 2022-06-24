// -------------------------------------- MODAL ----------------------------------
async function productView(id){
    try {
        const data = await getProduct(id);
        document.getElementById('pname').innerHTML=data.product.product_name;
        
        document.getElementById('pcode').innerHTML=data.product.product_code;
        document.getElementById('pstock').innerHTML=data.product.product_qty;
        document.getElementById('pcategory').innerHTML=data.product.category.category_name;
        document.getElementById('pbrand').innerHTML=data.product.brand.brand_name;
        document.getElementById('pid').value=data.product.id;
        document.getElementById('pimage').src=`http://127.0.0.1:8000/storage/${data.product.product_thambnail}`;
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

// -------------------------------------- END MODAL ----------------------------------

// -------------------------------------- ADD TO CART ----------------------------------
function addToCart(){
    const selectColor=document.getElementById('pcolor');
    const selectSize=document.getElementById('psize');

    const pName=document.getElementById('pname').innerText;
    const pId=document.getElementById('pid').value;
    
    const pColor=selectColor.options[selectColor.selectedIndex].value;
    const pSize=selectSize.options[selectSize.selectedIndex].value;
    const pQty=document.getElementById('qty').value;
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const data = {
        product_name: pName,
        product_id: pId,
        product_color: pColor,
        product_size: pSize,
        product_qty: pQty,
    };

    fetch(`http://127.0.0.1:8000/cart/data/store/${pId}`,{
        method:'post',
        body:JSON.stringify(data),
        headers: {
            
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        }
    }).then(
        document.getElementById('closeModel').click()
    ).then(response=> {
        if (!response.ok) {
            throw Error(response.statusText);
        }
        return response.json();
    }).then(data=>{
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: data.success,
                showConfirmButton: false,
                timer: 3000
              })
          }
      // End Message 
    ).then(miniCart())
    .catch(error=> {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: error,
            showConfirmButton: false,
            timer: 3000
          })
    });
}

// -------------------------------------- END ADD TO CART ----------------------------------


// -------------------------------------- CART PAGE ----------------------------------

// -------------------------------------- END CART PAGE ----------------------------------
async function cart(){
    try {
        const data = await getCart();
    
        removeAllChildNodes( document.getElementById('cartPage'));
    Object.values(data.carts).forEach((cart) => {
        document.getElementById('cartPage').innerHTML+=createCartPage(cart);
    });
    } catch (err) {
        console.log(err);
    }
}

if(document.getElementById('cartPage')){
    cart();
}

function createCartPage(cart) {
    return `<tr>
    <td class="col-md-2"><img src="http://127.0.0.1:8000/storage/${cart.options.image} " alt="imga"></td>
    
    <td class="col-md-7">
        <div class="product-name"><a href="#">${cart.name}</a></div>
         
        <div class="price"> 
                        ${cart.price}
                    </div>
                </td>
     
    <td class="col-md-1 close-btn">
        <button type="submit" class="" id="${cart.rowId}" onclick="cartRemove(this.id)"><i class="fa fa-times"></i></button>
    </td>
            </tr>`;
}
// -------------------------------------- MINI CART ----------------------------------



async function miniCart(){
    try {
        const data = await getCart();
        document.getElementById('cartQty').innerText=data.cartQty;

        const cartTotalEls=document.querySelectorAll('.cartTotal');
        cartTotalEls.forEach(cartTotalEl=>{
            cartTotalEl.innerText=data.cartTotal;
        })
        removeAllChildNodes( document.getElementById('miniCart'));
    Object.values(data.carts).forEach((cart) => {
        document.getElementById('miniCart').innerHTML+=createCartItem(cart);
    });
    } catch (err) {
        console.log(err);
    }
}
miniCart();

async function getCart() {
    return fetch(`http://127.0.0.1:8000/cart/products`,{
        type: "GET",
        dataType: "json",
    }).then((response) => {
        if (response.status !== 200) {
            throw new Error(response.statusText);
        }
        return response.json();
    });
}

function createCartItem(cart) {
    return `<div class="cart-item product-summary">
    <div class="row">
      <div class="col-xs-4">
        <div class="image"> <a href="detail.html"><img src="http://127.0.0.1:8000/storage/${cart.options.image}" alt=""></a> </div>
      </div>
      <div class="col-xs-6">
        <h3 class="name"><a href="index.php?page-detail">${cart.name}</a></h3>
        <div class="price"> ${cart.price} * ${cart.qty} </div>
      </div>
      <div class="col-xs-2 action"> 
      <button type="submit" id="${cart.rowId}" onclick="cartRemove(this.id)"><i class="fa fa-trash"></i></button> </div>
    </div>
  </div>
  <!-- /.cart-item -->
  <div class="clearfix"></div>
  <hr>`;
}


// -------------------------------------- END MINI CART ----------------------------------

// --------------------------------------  REMOVE MINI CART ----------------------------------

const cartRemove=(rowId)=>{
            fetch(`http://127.0.0.1:8000/cart/products/${rowId}`,{
                method:'POST',
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(
                miniCart()
                
            ).then(
                cart()
            ).then(
                // Start Message 
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: "Product was Removed from Cart",
                    showConfirmButton: false,
                    timer: 3000
                })
                // End Message 
            ) .catch(error=> {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: error,
                    showConfirmButton: false,
                    timer: 3000
                  })
            });
        }

//  end mini cart remove 
// -------------------------------------- END REMOVE MINI CART ----------------------------------





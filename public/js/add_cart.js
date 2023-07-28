// -------------------------------------- MODAL ----------------------------------
async function productView(id){
    try {
        const data = await getProduct(id);
        document.getElementById('pname').innerHTML=data.product.nama_produk;
        
        document.getElementById('pcode').innerHTML=data.product.kode_produk;
        document.getElementById('pstock').innerHTML=data.product.kuantitas_produk;
        document.getElementById('pcategory').innerHTML=data.product.category.nama_kategori;
        document.getElementById('pbrand').innerHTML=data.product.brand.nama_merek;
        document.getElementById('pid').value=data.product.id;
        document.getElementById('pimage').src=`${window.location.origin}/storage/${data.product.thumbnail_produk}`;
        if(data.product.harga_diskon==null){
            document.getElementById('price').innerHTML=`Rp.${data.product.harga_jual}`;
        }else{
            document.getElementById('price').innerHTML=`Rp.${data.product.harga_diskon}`;
            document.getElementById('oldprice').innerHTML=` Rp.${data.product.harga_jual}`;
        }

        const pcolor=document.getElementById('pcolor');
        const psize=document.getElementById('psize');
        removeAllChildNodes( pcolor);
        removeAllChildNodes( psize);
        
        data.colors.forEach(color => {
            pcolor.innerHTML+=createSelectOption(color);
            pcolor.value=color;
        });


        data.sizes.forEach(size => {
            psize.innerHTML+=createSelectOption(size);
            psize.value=size;
        });
    } catch (err) {

        console.log(err);

    }
}

async function getProduct(id) {
    return fetch(`${window.location.origin}/product/view/modal/${id}`,{
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
function addToCart(kuantitas_produk){
    const selectColor=document.getElementById('pcolor');
    const selectSize=document.getElementById('psize');

    const pName=document.getElementById('pname').innerText;
    const pId=document.getElementById('pid').value;
    
    const pColor=selectColor.options[selectColor.selectedIndex].value;
    const pSize=selectSize.options[selectSize.selectedIndex].value;
    let pQty=null;

    console.log(parseInt(document.getElementById('kuantitas').value, 10));
    console.log(parseInt(kuantitas_produk));
    if(parseInt(document.getElementById('kuantitas').value, 10) > parseInt(kuantitas_produk)){
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'Pemesanan tidak boleh melebihi ketersediaan',
            showConfirmButton: false,
            timer: 3000
          });
        throw Error("Pemesanan tidak boleh melebihi ketersediaan");
    }else{
        pQty=document.getElementById('kuantitas').value;
    }
    
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const data = {
        nama_produk: pName,
        product_id: pId,
        warna_produk: pColor,
        ukuran_produk: pSize,
        kuantitas_produk: pQty,
    };

    fetch(`${window.location.origin}/cart/data/store/${pId}`,{
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
        if(document.getElementById('cartPage')){
            removeAllChildNodes( document.getElementById('cartPage'));
        }
    Object.values(data.carts).forEach((cart) => {
        if(document.getElementById('cartPage')){
            document.getElementById('cartPage').innerHTML+=createCartPage(cart);
        }
    });
    } catch (err) {
        console.log(err);
    }
}

if(document.getElementById('cartPage')){
    cart();
    couponCalculation();
}

function createCartPage(cart) {
    return `<tr>
    <td class="col-md-2"><img src="${window.location.origin}/storage/${cart.options.image} " alt="${cart.name}" style="width:60px; height:60px;"></td>
    
    <td class="col-md-2">
        <div class="product-name"><a href="#">${cart.name}</a></div>
         
                    <div class="price"> 
                        Rp. ${cart.price}
                    </div>
                </td>
             <td class="col-md-2">
            <strong>${cart.options.warna} </strong> 
            </td>
         <td class="col-md-2">
          ${cart.options.size == null
            ? `<span> .... </span>`
            :
          `<strong>${cart.options.size} </strong>` 
          }           
            </td>
           <td class="col-md-2">
           ${cart.qty > 1
            ? `<button type="submit" class="btn btn-danger btn-sm" id="${cart.rowId}" onclick="cartDecrement(this.id)" >-</button> `
            : `<button type="submit" class="btn btn-danger btn-sm" disabled >-</button> `
            } 
           <input type="text" value="${cart.qty}" min="1" max="100" disabled="" style="width:25px;" >  
            <button type="submit" class="btn btn-success btn-sm" id="${cart.rowId}" onclick="cartIncrement(this.id)" >+</button>    
            </td>
             <td class="col-md-2">
            <strong>Rp.${cart.subtotal} </strong> 
            </td>

    <td class="col-md-1 close-btn">
        <button type="submit" class="" id="${cart.rowId}" onclick="cartRemove(this.id)"><i class="fa fa-times"></i></button>
    </td>
            </tr>`;
}

 // -------- CART INCREMENT --------//
 function cartIncrement(rowId){
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`${window.location.origin}/cart-increment/${rowId}`,{
        method:'post',
        headers: {
            
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        }
    }).then(
        couponCalculation()
    ).then(
        miniCart()
    ).then(
        cart()
    ).catch(error=> {
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
// ---------- END CART INCREMENT -----///

 // -------- CART DECREMENT --------//
 function cartDecrement(rowId){
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`${window.location.origin}/cart-decrement/${rowId}`,{
        method:'post',
        headers: {
            
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        }
    }).then(()=>{
        if( document.getElementById('couponCalField')){
            couponCalculation()
        }
    }
    ).then(
        miniCart()
    ).then(
        cart()
    ).catch(error=> {
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
// ---------- END CART DECREMENT -----///

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
    return fetch(`${window.location.origin}/cart/products`,{
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
        <div class="image"> <a href="detail.html"><img src="${window.location.origin}/storage/${cart.options.image}" alt=""></a> </div>
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
            fetch(`${window.location.origin}/cart/products/${rowId}`,{
                method:'POST',
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(()=>{
                if( document.getElementById('couponCalField')){
                    couponCalculation()
                }
            }
            ).then(
                miniCart()
                
            ).then(
                cart()
            ).then(()=>{
                if( document.getElementById('couponField')){
                    document.getElementById('couponField').style.display='block'
                }
            }
            ).then(()=>{
                if( document.getElementById('coupon_name')){
                    document.getElementById('coupon_name').value=''
                }
            }
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



// -------------------------------------- COUPON ----------------------------------
  
  function applyCoupon(){
    const coupon_name=document.getElementById('coupon_name').value;
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`${window.location.origin}/coupon-apply`,{
        method:'post',
        body:JSON.stringify({coupon_name:coupon_name}),
        headers: {
            
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        }
    }).then(response=> {
        if (!response.ok) {
            throw Error(response.statusText);
        }
        return response.json();
    }).then(data=>{
        if (data.error) {
            throw Error(data.error);
        }
        return data;
    }).then(
        couponCalculation()
    ).then(data=>{
        if(data.validity==true){
            document.getElementById('couponField').style.display='none';
        }
        return data;
    }).then(data=>{
        console.log(data);
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
).catch(error=> {
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
// -------------------------------------- END COUPON ----------------------------------

// -------------------------------------- COUPON CALCULATION ----------------------------------

  async function couponCalculation() {
    return fetch(`${window.location.origin}/coupon-calculation`,{
        type: "GET",
        dataType: "json",
    }).then((response) => {
        if (response.status !== 200) {
            throw new Error(response.statusText);
        }
        return response.json();
    }).then((cart)=>{
        if (cart.total) {
            document.getElementById('couponCalField').innerHTML=
                `<tr>
            <th>
                <div class="cart-sub-total">
                    Subtotal<span class="inner-left-md" style="float:right;">Rp. ${cart.total}</span>
                </div>
                <div class="cart-grand-total">
                    Grand Total<span class="inner-left-md" style="float:right;">Rp. ${cart.total}</span>
                </div>
            </th>
        </tr>`
        
        }else{
            document.getElementById('couponCalField').innerHTML=
                `<tr>
        <th>
        <div class="cart-sub-total">
            Subtotal<span class="inner-left-md" style="float:right;">Rp. ${cart.subtotal}</span>
        </div>
        <div class="cart-sub-total">
            Coupon<span class="inner-left-md" style="float:right;"> ${cart.nama_kupon}</span>
            <button type="submit" onclick="couponRemove()"><i class="fa fa-times"></i>  </button>
        </div>
         <div class="cart-sub-total">
            Discount Amount<span class="inner-left-md" style="float:right;">Rp. ${cart.discount_amount}</span>
        </div>
        <div class="cart-grand-total">
            Grand Total<span class="inner-left-md" style="float:right;">Rp. ${cart.total_amount}</span>
        </div>
     </th>
        </tr>`
        }
    }
        
    );
}
// -------------------------------------- END COUPON CALCULATION ----------------------------------

// -------------------------------------- COUPON REMOVE ----------------------------------
 const couponRemove=()=>{
    fetch(`${window.location.origin}/coupon-remove`,{
        method:'POST',
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }).then(
        couponCalculation()
    ).then(
        document.getElementById('couponField').style.display='block'
    ).then(
            document.getElementById('nama_kupon').value=''
    ).then(
        // Start Message 
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: "Coupon was removed succesfully",
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
// -------------------------------------- END COUPON REMOVE ----------------------------------








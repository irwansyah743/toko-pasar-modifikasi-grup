function removeAllChildNodes(parent) {
    while (parent.firstElementChild) {
        parent.removeChild(parent.firstElementChild);
    }
}
// -------------------------------------- ADD WISHLIST ----------------------------------
const addToWishList=(product_id)=>{
    fetch(`http://127.0.0.1:8000/wishlist/${product_id}`,{
        method:'POST',
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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


// -------------------------------------- END ADD WISHLIST ----------------------------------

// --------------------------------------  WISHLIST ----------------------------------
async function wishlist(){
    try {
        const products = await getWishList();
        removeAllChildNodes( document.getElementById('wishlist'));

        products.forEach((product) => {
            document.getElementById('wishlist').innerHTML+=createWishlistItem(product);
        });
    } catch (err) {
        console.log(err);
    }
}

if(document.getElementById('wishlist')){
    wishlist();
}

async function getWishList() {
    return fetch(`http://127.0.0.1:8000/getwishlist`,{
        type: "GET",
        dataType: "json",
    }).then((response) => {
        if (response.status !== 200) {
            throw new Error(response.statusText);
        }
        return response.json();
    });
    
}

function createWishlistItem(product) {
    return `<tr>
    <td class="col-md-2"><img src="http://127.0.0.1:8000/storage/${product.product.product_thambnail} " alt="imga"></td>
    <td class="col-md-7">
        <div class="product-name"><strong><a href="#">${product.product.product_name}</a><strong></div>
         
        <div class="price">
        ${product.product.discount_price == null
            ? `${product.product.selling_price}`
            :
            `${product.product.discount_price} <span>${product.product.selling_price}</span>`
        }
        </div>
    </td>
    <td class="col-md-2">
    <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="${product.product_id}" onclick="productView(this.id)"> Add to Cart </button>
    </td>
    <td class="col-md-1 close-btn">
    <button type="submit" class="" id="${product.product_id}" onclick="wishlistRemove(this.id)"><i class="fa fa-times"></i></button>
    </td>
    </tr>`;
}

// -------------------------------------- END ADD WISHLIST ----------------------------------

// -------------------------------------- REMOVE WISHLIST ----------------------------------

const wishlistRemove=(id)=>{
    fetch(`http://127.0.0.1:8000/wishlist-remove/${id}`,{
        method:'POST',
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }).then(
        wishlist()
    ).then(
        // Start Message 
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: "Product was Removed from Wishlist",
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
// End Wishlist remove   
// -------------------------------------- END REMOVE WISHLIST ----------------------------------
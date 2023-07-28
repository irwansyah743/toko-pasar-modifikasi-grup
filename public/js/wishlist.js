function removeAllChildNodes(parent) {
    while (parent.firstElementChild) {
        parent.removeChild(parent.firstElementChild);
    }
}
// -------------------------------------- ADD WISHLIST ----------------------------------
const addToWishList=(product_id)=>{
    fetch(`${window.location.origin}/wishlist/${product_id}`,{
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
        if(document.getElementById('wishlist')){
            removeAllChildNodes( document.getElementById('wishlist'));
        }

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
    return fetch(`${window.location.origin}/getwishlist`,{
        type: "GET",
        dataType: "json",
    }).then((response) => {
        if (response.status !== 200) {
            throw new Error(response.json().error);
        }
        return response.json();
    });
    
}

function createWishlistItem(product) {
    return `<tr>
    <td class="col-md-2"><img src="${window.location.origin}/storage/${product.product.thumbnail_produk} " alt="imga"></td>
    <td class="col-md-7">
        <div class="product-name"><strong><a href="#">${product.product.nama_produk}</a><strong></div>
         
        <div class="price">
        ${product.product.harga_diskon == null
            ? `${product.product.harga_jual}`
            :
            `${product.product.harga_diskon} <span>${product.product.harga_jual}</span>`
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
    fetch(`${window.location.origin}/wishlist-remove/${id}`,{
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
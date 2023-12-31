    // -------------------------------------- MIDTRANS ----------------------------------

  // For example trigger on button clicked, or any time you need
  const payButton = document.getElementById('pay-button');
  payButton.addEventListener('click',midTrans);
  // -------------------------------------- END MIDTRANS ----------------------------------


  // -------------------------------------- GET TOKEN ----------------------------------

function midTrans(){
    const name=document.getElementById('nama_pengiriman').value;
    const email=document.getElementById('email_pengiriman').value;
    const phone=document.getElementById('no_telepon_pengiriman').value;
    const kodePos=document.getElementById('kode_pos').value;

    const provinsi=document.getElementById('provinsi').value;
    const kabupaten=document.getElementById('kabupaten').value;
    const kecamatan=document.getElementById('kecamatan').value;
    const address=document.getElementById('alamat').value;
    const catatan=document.getElementById('catatan').value;

    const ongkir_choose=document.getElementById('ongkir_choose').value;


    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const shippingData = {
        name: name,
        email: email,
        phone: phone,
        kodePos: kodePos,
        provinsi: provinsi,
        kabupaten: kabupaten,
        kecamatan: kecamatan,
        alamat: address,
        ongkir_choose: ongkir_choose,
    };

    if(catatan){
        shippingData.catatan=catatan;
    }

    if(document.getElementById('coupon_discount')){
        const discount={
            'id': Math.random(),
            'price': - parseInt(document.getElementById('coupon_discount').innerText) ,
            'quantity': 1,
            'name': document.getElementById('coupon_name').innerText.concat(' COUPON'),
        }
        shippingData.discount=discount;
    }

    fetch(`${window.location.origin}/midtrans/getToken`,{
        method:'POST',
        body:JSON.stringify(shippingData),
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
    }).then((data)=>{
        window.snap.pay(data.snapToken, {
            onSuccess: function(result){
                /* You may add your own implementation here */
                alert('Pembayaran diterima, terimakasih!');
                window.location.replace(`${window.location.origin}/user/order/detail/${data.id_pesanan}`);
                console.log(result);
              },
              onPending: function(result){
                /* You may add your own implementation here */
                console.log(result);

              },
              onError: function(result){
                /* You may add your own implementation here */
                console.log(result);

              },
              onClose: function(){
                /* You may add your own implementation here */
                alert('Mohon untuk menyelesaikan pembayaran di halaman order!');
                window.location.replace(`${window.location.origin}/user/order/detail/${data.id_pesanan}`);
              }
        });
    }).catch(error=> {
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

// -------------------------------------- END GET TOKEN ----------------------------------

// -------------------------------------- TRANSACTION DATA HANDLER ----------------------------------
const send_response_to_form=(result)=>{
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`${window.location.origin}/midtrans/postTrans`,{
        method:'POST',
        body:JSON.stringify(result),
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
    }).then(
        // Start Message
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: "Payment was successfull",
            showConfirmButton: false,
            timer: 3000
        })
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
// -------------------------------------- END TRANSACTION DATA HANDLER ----------------------------------

// -------------------------------------- SHIPPING STORE ----------------------------------
const storeShipping=(data)=>{
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`${window.location.origin}/midtrans/shippingStore`,{
        method:'POST',
        body:JSON.stringify(data),
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
    }).catch(error=> {
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
// -------------------------------------- END SHIPPING STORE ----------------------------------

// -------------------------------------- SEND EMAIL ----------------------------------
const sendEmail=(data)=>{
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`${window.location.origin}/midtrans/sendEmail`,{
        method:'POST',
        body:JSON.stringify(data),
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
    }).catch(error=> {
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
// -------------------------------------- END SEND EMAIL ----------------------------------

// -------------------------------------- ITEMS STORE ----------------------------------
const storeItems=()=>{
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`${window.location.origin}/midtrans/itemStore`,{
        method:'POST',
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
    }).catch(error=> {
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
// -------------------------------------- END ITEMS STORE ----------------------------------

// -------------------------------------- SHIPPING UPDATE ----------------------------------
const shippingUpdate=(result)=>{
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`${window.location.origin}/midtrans/shippingUpdate`,{
        method:'POST',
        body:JSON.stringify(result),
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
    }).then(
        // Start Message
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: "Payment was successfull",
            showConfirmButton: false,
            timer: 3000
        })
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
// -------------------------------------- END SHIPPING UPDATE ----------------------------------

// -------------------------------------- FORM HANDLING VALIDATION ----------------------------------
const checkForm=()=>{
    if(
    document.getElementById('nama_pengiriman').value !== '' &&
    document.getElementById('email_pengiriman').value !=='' &&
    document.getElementById('no_telepon_pengiriman').value !=='' &&
    document.getElementById('kode_pos').value!=='' &&
    document.getElementById('provinsi').value !==''&&
    document.getElementById('kabupaten').value !==''&&
    document.getElementById('kecamatan').value !==''&&
    document.getElementById('alamat').value!=='' &&
    document.getElementById('ongkir_choose').value!==''
    ){
        document.getElementById('pay-button').disabled = false
    }else{
        document.getElementById('pay-button').disabled = true
    }
}
// -------------------------------------- END FORM HANDLING VALIDATION ----------------------------------


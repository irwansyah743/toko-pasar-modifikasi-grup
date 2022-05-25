const deleteConfirmation=(prefix,id)=>{
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // console.log(prefix);
                    // console.log(id);
                    const formId='delete'.concat(prefix,id)
                    // console.log(formId);
                    const data=new FormData(document.getElementById(formId));
                    const url=`${prefix}/${id}`;
                    fetch(`${url}`,{
                        method:'post',
                        body:data
                    }).then(
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    ).then(
                        // e.target.parentElement.parentElement.parentElement.style.display='none'
                        location.reload()
                    )
                }
            })
        }

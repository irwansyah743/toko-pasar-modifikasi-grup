        const categoryInput=document.getElementById('category_id');
        const subCategoryInput=document.getElementById('subcategory_id');

        categoryInput.addEventListener('change',async function (e){
            const categoryId=categoryInput.value;
            if(categoryId){
                try {
                    const subCategories = await getSubCategory(categoryId);
                    removeAllChildNodes(subCategoryInput);
                    subCategories.forEach(subCategory => {
                        subCategoryInput.innerHTML+=createSelectOption(subCategory);
                       
                    });
                } catch (err) {
                    console.log(err);
                }
                   
            }
        });

        async function getSubCategory(categoryId) {
            return fetch(`/subsubcategory/ajax/${categoryId}`,{
                type: "GET",
                // headers: {
                //     'X-CSRF-TOKEN': document.getElementById('csrf-token').getAttribute('content')
                // },
                dataType: "json",
            }).then((response) => {
                if (response.status !== 200) {
                    throw new Error(response.statusText);
                }
                return response.json();
            });
        }

        function createSelectOption(subCategory) {
            return `<option value=${subCategory.id}>${subCategory.subcategory_name}</option>`;
        }

        function removeAllChildNodes(parent) {
            while (parent.firstElementChild) {
                parent.removeChild(parent.firstElementChild);
            }
        }
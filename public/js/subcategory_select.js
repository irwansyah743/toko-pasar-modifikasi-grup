        const categoryInput=document.getElementById('id_kategori');
        const subCategoryInput=document.getElementById('id_subkategori');
        const subsubCategoryInput=document.getElementById('id_subsubkategori');
        function removeAllChildNodes(parent) {
            while (parent.firstElementChild) {
                parent.removeChild(parent.firstElementChild);
            }
        }

        // SUB CATEGORY
        categoryInput.addEventListener('change',async function (e){
            const categoryId=categoryInput.value;
            if(categoryId){
                try {
                    const subCategories = await getSubCategory(categoryId);
                    removeAllChildNodes(subCategoryInput);
                    subCategories.forEach(subCategory => {
                        subCategoryInput.innerHTML+=createSelectOption(subCategory);
                        subCategoryInput.value=subCategory.id;
                    });
                    SubSubUpdate(subCategoryInput);
                } catch (err) {
                    console.log(err);
                }
                   
            }
               
          
        });
       

        async function getSubCategory(categoryId) {
            return fetch(`/subcategory/ajax/${categoryId}`,{
                type: "GET",
                dataType: "json",
            }).then((response) => {
                if (response.status !== 200) {
                    
                    throw new Error(response.statusText);
                }
                return response.json();
            });
        }


        function createSelectOption(subCategory) {
            return `<option value=${subCategory.id}>${subCategory.nama_subkategori}</option>`;
        }

        // SUB SUB CATEGORY
        subCategoryInput.addEventListener('input',async function (e){
            const subcategoryId=subCategoryInput.value;
            if(subcategoryId){
                try {
                    const subsubCategories = await getSubSubCategory(subcategoryId);
                    removeAllChildNodes(subsubCategoryInput);
                    subsubCategories.forEach(subsubCategory => {
                        subsubCategoryInput.innerHTML+=createSelectOptionSubSub(subsubCategory);
                   
                    });
                } catch (err) {
                    console.log(err);
                }
            }
        });

        async function getSubSubCategory(subcategoryId) {
            return fetch(`/subsubcategory/ajax/${subcategoryId}`,{
                type: "GET",
                dataType: "json",
            }).then((response) => {
                if (response.status !== 200) {
                    throw new Error(response.statusText);
                }
                return response.json();
            });
        }

        function createSelectOptionSubSub(subsubCategory) {
            return `<option value=${subsubCategory.id}>${subsubCategory.nama_subsubkategori}</option>`;
        }


   const SubSubUpdate=async function(subCategoryInput){
    const subcategoryId=subCategoryInput.value;
    if(subcategoryId){
        try {
            const subsubCategories = await getSubSubCategory(subcategoryId);
            removeAllChildNodes(subsubCategoryInput);
            subsubCategories.forEach(subsubCategory => {
                subsubCategoryInput.innerHTML+=createSelectOptionSubSub(subsubCategory);
           
            });
        } catch (err) {
            console.log(err);
        }
    }
   }
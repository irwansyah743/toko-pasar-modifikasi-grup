        const categoryInput=document.getElementById('category_id');
        const subCategoryInput=document.getElementById('subcategory_id');
        const subsubCategoryInput=document.getElementById('subsubcategory_id');
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
            return `<option value=${subCategory.id}>${subCategory.subcategory_name}</option>`;
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
            return `<option value=${subsubCategory.id}>${subsubCategory.subsubcategory_name}</option>`;
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
<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form id="updateForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Expense</h5>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Date *</label>
                                <input type="date" class="form-control" id="entryDate">
                                <label class="form-label">Category *</label>
                                <select class="form-control" name="cat_id" id="categoryID">
                                    <option value="">Select Category</option>
                                </select>
                                <label class="form-label">Amount *</label>
                                <input type="number" class="form-control" id="amount">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="" id="description" cols="30" rows="3"></textarea>

                                <input type="text" class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button class="btn btn-sm  btn-success" >Update</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>

    async function getCategory(){
        let res = await axios.get("/list-category")
        res.data.forEach(function (item,i) {
            let option=`<option value="${item['id']}">${item['cat_name']}</option>`
            $("#categoryID").append(option);
        })
    }

    async function FillUpUpdateForm(id){
        $('#updateID').val(id);
        showLoader();
        await getCategory();
        let res=await axios.post("/edit-expense",{id:id});
        hideLoader();
console.log(res.data);
        $('#entryDate').val(res.data['entryDate']);
        $('#categoryID').val(res.data['cat_id']);
        $('#amount').val(res.data['amount']);
        $('#description').val(res.data['description']);
    }

    $("#updateForm").on('submit',async function (e) {
        e.preventDefault();

        let entryDate = $('#entryDate').val();
        let categoryID = $('#categoryID').val();
        let amount = $('#amount').val();
        let description = $('#description').val();
        let updateID = $('#updateID').val();

        if (entryDate.length === 0) {
            errorToast("Date Field Required !");
        }
        else if(categoryID.length===0){
            errorToast("Category Field Required !");
        }
        else if(amount.length===0){
            errorToast("Amount Field Required !");
        }
        else {

            $('#update-modal').modal('hide');
            showLoader();
            let res = await axios.post("/update-expense",{entryDate:entryDate,cat_id:categoryID,amount:amount,description:description,id:updateID})
            hideLoader();

            if(res.status===200 && res.data===1){
                successToast('Expense Updated Successfully!');
                $("#updateForm").trigger("reset");
                await getList();
            }
            else{
                errorToast("Request fail !");
            }
        }

    });

</script>

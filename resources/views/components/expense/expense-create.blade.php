<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form id="insertData">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Expense</h5>
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button class="btn btn-sm  btn-success" >Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>

    getCategory();

    async function getCategory(){
        let res = await axios.get("/list-category")
        res.data.forEach(function (item,i) {
            let option=`<option value="${item['id']}">${item['cat_name']}</option>`
            $("#categoryID").append(option);
        })
    }

    $("#insertData").on('submit',async function (e) {
        e.preventDefault();

        let entryDate = $('#entryDate').val();
        let categoryID = $('#categoryID').val();
        let amount = $('#amount').val();
        let description = $('#description').val();
        if (entryDate.length === 0) {
            errorToast("Date Field Required !")
        }
        else if(categoryID.length===0){
            errorToast("Category Field Required !")
        }
        else if(amount.length===0){
            errorToast("Amount Field Required !")
        } else {
            $('#create-modal').modal('hide');
            showLoader();
            let res = await axios.post("/create-expense",{entryDate:entryDate,cat_id:categoryID,amount:amount,description:description})
            hideLoader();
            if(res.status===201){
                successToast('Expense Created Successfully!');
                $("#insertData").trigger("reset");
                await getList();
            }
            else{
                errorToast("Request fail !")
            }

        }

    });


</script>

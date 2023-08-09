<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Expenditure Report</h4>
                    </div>
                </div>
                <hr class="bg-dark"/>
                <table class="table" id="tableData">
                    <thead>
                    <tr class="bg-light">
                        <th>No</th>
                        <th>Total Income</th>
                        <th>Total Expense</th>
                        <th>Current Balance</th>
                    </tr>
                    </thead>
                    <tbody id="tableList">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

getList();


async function getList() {

    showLoader();
    let res=await axios.get("/list-expenditure");
    hideLoader();

    let tableList=$("#tableList");
    let tableData=$("#tableData");

    tableData.DataTable().destroy();
    tableList.empty();
    console.log(res.data);


    res.data.forEach(function (item,index) {
        let row=`<tr>
                    <td>${index+1}</td>
                    <td>${item['totalIncome']}</td>
                    <td>${item['totalExpenses']}</td>
                    <td>${item['netIncome']}</td>
                 </tr>`;
        tableList.append(row);
    });

    tableData.DataTable({
        lengthMenu: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50],
        language: {
            paginate: {
                next: '&#8594;', // or '→'
                previous: '&#8592;' // or '←'
            }
        }
    });

}

</script>


<?php 
    $headerName = "- Book List";
    include("layout/topbar.php");
    include("layout/sidebar.php");
?>

<style>
    .odd {
        background-color: #99ff99;
    }

    .even {
        background-color: #aa80ff;
    }
    .custom{
        text-align: center;
    }
</style>

<div class="row">
    <div class = "col-md-12">
        <div class="card">
            <div id="headingTwo" class="card-header bg-blue1">
                <button type="button" data-toggle="collapse" data-target="#" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                    <h5 class="m-0 p-0" style="color: #fff;">Book List</h5>
                </button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered" id="bookList" >
                    <thead style = "background-color: #ffd9b3;"> 
                        <tr>
                            <th>Name</th>
                            <th>Warning Quantity</th>
                            <th>Photo</th>
                            <th>Author Name</th>
                            <th>Category</th>
                            <th>Sub-Category</th>
                            <th>Publisher</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include("layout/footer.php"); ?>

<script>

(function(){
    let ajaxOperation = new AjaxOperation();
    let modalOperation = new ModalOperation();

    let selector = {
        tableInformation: '',
        edit: ".editBookInformation",
        delete: ".deleteBookInformation",
        Id : '',
        bookList: $("#bookList"),

        bookEditBtn: "#informationModal #bookEditBtn",
        bookEditCreateForm: $("#informationModal #bookEditCreateForm"),
        photo : $("#informationModal #Photo"),
    };

    let modal = {
        modalId : "#informationModal",
        modalHeading : $("#modalHeading"),
        modalDiv: "#informationModalDiv",
    }

    class Book {
        Delete(id){
            let response = ajaxOperation.GetAjaxByValue("../controller/Book.php", id);
            
            if(JSON.parse(response) === true){
                toastr.success("Successfully Deleted Book!", "Success");
            }
            else{
                toastr.error("Something went wrong", "Error");
            }
        }
        BookDetail(id){
            let response = ajaxOperation.GetAjaxHtmlByValue("htmlHelper/bookDetail.php", id);
            
            modalOperation.ModalStatic(modal.modalId);
            modal.modalHeading.text("Edit Book");
            modalOperation.ModalOpenWithHtml(modal.modalId, modal.modalDiv, response);
        }
    }
    
    

    
    function PopulateData(){
        var bookList = selector.bookList.dataTable({
                "processing": true,
                "serverSide": true,
                "filter": true,
                "pageLength": 10,
                "autoWidth": false,
                'dom': "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                "lengthMenu": [[10, 50, 100, 150, 200, 500], [10, 50, 100, 150, 200, 500]],
                "order": [[0, "desc"]],
                    "ajax": {
                        "url": "../controller/BookList.php",
                        "type": "POST",
                        "data": function (data) {

                        },
                        "complete": function (json) {

                        }
                    },
                    "columnDefs": [
                        { "className": "custom", "targets": [0, 1, 2, 3,4,5,6,7] },
                    ],
                    "columns": [
                        { "data": "Name", "name": "Name", "autowidth": true, "orderable": true },
                        
                        { "data": "WarningQuantity", "name": "WarningQuantity", "autowidth": true, "orderable": true },
                        {
                            "render": function (data, type, full, meta) {
                                return `<img src = "${full.PhotoUrl}" height = "50" width = "50" alt = "No" />`;
                            }
                        },
                        { "data": "AuthorName", "name": "AuthorId", "autowidth": true, "orderable": true },
                        { "data": "CategoryName", "name": "CategoryId", "autowidth": true, "orderable": true },
                        { "data": "SubCategoryName", "name": "SubCategoryId", "autowidth": true, "orderable": true },
                        { "data": "PublicationName", "name": "PublicationId", "autowidth": true, "orderable": true },
                        {
                            "render": function (data, type, full, meta) {
                                return `
                                <div class="btn-group">
                                    <i class="fa fa-ellipsis-h" title = 'Actions' style = 'cursor:pointer;' data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                <div class="dropdown-menu" >
                                    <a href = "bookEdit.php?search=${full.Id}" style="font-size: inherit;" class="dropdown-item btn-rx" 
                                         id = "${full.Id}"
                                    ><i class="fa fa-check-circle" aria-hidden="true"></i>Edit</a>
                                    <button style="font-size: inherit;" class="dropdown-item btn-rx deleteBookInformation" id = "${full.Id}" > <i class="fa fa-times" aria-hidden="true"></i>Delete</button >
                                </div>
                                </div>`;
                            }
                        },
                    ]
                });
        selector.tableInformation = bookList;
    
    }

    window.onload = PopulateData();

    let process = new Book();

    $(document).on("click", selector.delete, function(){
        Swal.fire({
            title: 'Are You Sure to Delete?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            showConfirmButton: true,
            allowEscapeKey: false,
            allowOutsideClick: false,
        }).then((result) => {
            if (result.value) {
                process.Delete($(this).attr("id"));
                selector.tableInformation.fnFilter();
            }
        });
        
    });
    $(document).on("click", selector.edit, function(){
        selector.Id = $(this).attr("id");
        process.BookDetail($(this).attr("id"));
    });
})();

</script>
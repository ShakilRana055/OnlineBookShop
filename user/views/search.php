<?php
    $headerName = "Search";
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
    li{
        font-size: 12px !important;
    }
</style>
<div class="shop_sidebar_area" style = "background-color: white;">
    <div class="widget catagory mb-10">
        <h6 class="widget-title mb-30"></h6>

        <div class="catagories-menu">
            <img src = "../public/orderNow.gif" />
            <img src = "../public/orderNow1.gif" />
            <img src = "../public/orderNow2.gif" />
        </div>
    </div>

    <div class="widget catagory mb-10">
        <h6 class="widget-title mb-30"></h6>

        <div class="catagories-menu">
            <img src = "../public/orderNow.gif" />
            <img src = "../public/orderNow1.gif" />
            <img src = "../public/orderNow2.gif" />
        </div>
    </div>
    <div class="widget catagory mb-10">
        <h6 class="widget-title mb-30"></h6>

        <div class="catagories-menu">
            <img src = "../public/orderNow.gif" />
            <img src = "../public/orderNow1.gif" />
            <img src = "../public/orderNow2.gif" />
        </div>
    </div>
    <div class="widget catagory mb-10">
        <h6 class="widget-title mb-30"></h6>

        <div class="catagories-menu">
            <img src = "../public/orderNow.gif" />
            <img src = "../public/orderNow1.gif" />
            <img src = "../public/orderNow2.gif" />
        </div>
    </div>

</div>


<div class="amado_product_area">
<div class="container-fluid">
        <div class="cart-title mt-50">
            <h2>Search</h2>
        </div>
    <div class="table-responsive" style = "width: 100% !important;">
        <table class="table table-bordered table-hover" id = "searchList">
            <thead>
                <tr style = "background-color: #d9b3ff !important;">
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Info</th>
                    <th style = "background-color: #d9b3ff !important;">Status</th>
                    <th style = "background-color: #d9b3ff !important;" >Action</th>
                </tr>
            </thead>
            <tbody id="">
                
            </tbody>

            <tfoot>
            </tfoot>

        </table> 
    </div>
</div>
</div>



<?php include("layout/footer.php");?>
<script>
    (function(){
        
        let ajaxOperation = new AjaxOperation();
        let selector = {
            searchList: $("#searchList"),
            tableInformation: '',
            addToCart: ".addToCart",
        }
        function PopulateData(){
            var searchList = selector.searchList.dataTable({
                "processing": true,
                "serverSide": true,
                "filter": true,
                "pageLength": 10,
                "autoWidth": false,
                "lengthMenu": [[10, 50, 100, 150, 200, 500], [10, 50, 100, 150, 200, 500]],
                "order": [[0, "desc"]],
                    "ajax": {
                        "url": "../controller/Search.php",
                        "type": "POST",
                        "data": function (data) {

                        },
                        "complete": function (json) {

                        }
                    },
                    "columnDefs": [
                        { "className": "custom", "targets": [0, 1, 2, 3, 4] },
                    ],
                    "columns": [
                        {
                            "render": function (data, type, full, meta) {
                                return `<img src = "${full.PhotoUrl}" width = "50" height = "50">`;
                            }
                        },
                        { "data": "Name", "name": "Name", "autowidth": true, "orderable": true },
                        {
                            "render": function (data, type, full, meta) {
                                return `<ul>
                                            <li>${full.AuthorName}</li>
                                            <li>${full.PublicationName}</li>
                                            <li>${full.CategoryName}</li>
                                            <li>${full.SubCategoryName}</li>
                                        </ul>`;
                            }
                        },
                        {
                            "render": function (data, type, full, meta) {
                                let available = 'Not Available';
                                let className = 'badge badge-pill badge-danger';
                                if(full.IsAvailable == 1){
                                    available = 'Available';
                                    className = "badge badge-pill badge-success";
                                }
                                return `<span class="${className}">${available}</span>`;
                            }
                        },
                        {
                            "render": function (data, type, full, meta) {
                                let addToCart = '';
                                if(full.Ordered == 0){
                                    addToCart = `<button type = "button" class = "addToCart btn" bookId = "${full.Id}" title="Add to Cart">
                                            <img src="../public/img/core-img/cart.jpg" height = "30" width = "30" alt="">Add To Cart</button>`
                                }
                                return `
                                <div class="btn-group">
                                    <i class="fa fa-ellipsis-h" title = 'Actions' style = 'cursor:pointer;' data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                <div class="dropdown-menu" >
                                    <a href="bookDetail.php?bookId=${full.Id}" class = "btn" data-toggle="tooltip"title="Detail">
                                    <img src="../public/img/core-img/info.png" height = "30" width = "30" alt="">Info</a>
                                     ${addToCart}
                                   </div>
                                </div>`;
                            }
                        },
                    ]
                });
            selector.tableInformation = searchList;
        }
        window.onload = PopulateData();

        
        function AddToCart(bookId)
        {
            let response = ajaxOperation.GetAjaxByValue("../controller/Shop.php", bookId);
            
            if(response == "login"){
                toastr.error("Please Login First", "Error!");
            }
            else if(response == "exist"){
                toastr.error("Already Added into Cart", "Error");
            }
            else if( response == "success"){
                toastr.success("Added to the Cart", "Success!");
            }
            else if(response == "error"){
                toastr.error("Something went wrong", "Error!");
            }  
        }
        $(document).on("click", selector.addToCart, function(){
            let bookId = $(this).attr("bookId");
            Swal.fire({
                    title: 'Are You Sure to Order?',
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
                        AddToCart(bookId);
                        selector.tableInformation.fnFilter();
                    }
                });
        });
    })();

</script>
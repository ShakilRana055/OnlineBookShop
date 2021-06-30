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
        let selector = {
            searchList: $("#searchList"),
            tableInformation: '',
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
            selector.tableInformation = searchList;
        }
        window.onload = PopulateData();
    })();

</script>
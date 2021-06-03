<?php 
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
                    <h5 class="m-0 p-0" style="color: #fff;">Admin List</h5>
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
                        <?php
                            $sql = "SELECT b.*, auth.Name AuthorName, ct.Name CategoryName, sb.Name SubCategoryName, pb.Name PublicationName
                                    FROM books b 
                                    INNER JOIN authors auth ON auth.Id = b.AuthorId 
                                    INNER JOIN category ct ON ct.Id = b.CategoryId 
                                    INNER JOIN subcategory sb ON sb.Id = b.SubCategoryId 
                                    INNER JOIN publications pb ON pb.Id = b.PublicationId";
                            $result = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                $id = $row['Id'];
                                $photoUrl = $row['PhotoUrl'];
                                echo '<tr>
                                        <td>'.$row['Name'].'</td>
                                        <td>'.$row['WarningQuantity'].'</td>'.
                                        "<td><img src = '$photoUrl' height = 50 width = 50 /></td>".
                                        '<td>'.$row['AuthorName'].'</td>
                                        <td>'.$row['CategoryName'].'</td>
                                        <td>'.$row['SubCategoryName'].'</td>
                                        <td>'.$row['PublicationName'].'</td>'.
                                        "<td>
                                            <div class='btn-group'>
                                            <i class='fa fa-ellipsis-h' title = 'Actions' style = 'cursor:pointer;' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'></i>
                                                <div class='dropdown-menu' >
                                                    <button style='font-size: inherit;' class='dropdown-item btn-rx editBookInformation' 
                                                        id = '$id'
                                                    >
                                                    <i class='fa fa-check-circle' aria-hidden='true'></i>Edit
                                                    </button >
                                                    <button style='font-size: inherit;' class='dropdown-item btn-rx deleteBookInformation' 
                                                        id = '$id' 
                                                        > 
                                                        <i class='fa fa-times' aria-hidden='true'></i>Delete
                                                    </button >
                                                </div>
                                            </div>
                                        </td>
                                        </tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include("layout/footer.php"); ?>

<script>

(function(){
    let selector = {
        tableInformation: '',
        edit: ".editSupplierInformation",
        delete: ".deleteSupplierInformation",
        id : '',
        bookList: $("#bookList"),
    };

    function GenerateTable(){
        var bookList = selector.bookList.dataTable({
                "processing": true,
                "serverSide": false,
                "filter": true,
                "pageLength": 10,
                "autoWidth": false,
                'dom': "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                "lengthMenu": [[10, 50, 100, 150, 200, 500], [10, 50, 100, 150, 200, 500]],
                "order": [[0, "desc"]],
                "columnDefs": [
                        { "className": "custom", "targets": [0, 1, 2, 3, 4, 5, 6, 7] },
                    ],
                });
        selector.tableInformation = bookList;
    }

    window.onload = GenerateTable();
})();

</script>
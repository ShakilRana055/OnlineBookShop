<?php 
    $headerName = '- Purchase';
    include("layout/topbar.php");
    include("layout/sidebar.php");
?>

<style>
    
    #purchaseProductTable tbody, tr:nth-child(2n+1) {
        background-color: #ccffcc;
    }
    #purchaseProductTable tbody, tr:nth-child(2n+2) {
        background-color: #e6ccff;
    }
    
    .rightAlign {
        text-align: right;
    }
    .redColor{
        border-color:red;
    }

</style>

<div class="row">
    <div class="col-md-12">
        <form id="purchaseCreateForm" enctype="multipart/form-data">
            <div class="card">
                <div id="headingOne" class="card-header bg-blue1">
                    <button type="button" data-toggle="collapse" data-target="#Collapse" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                        <h5 class="m-0 p-0" style="color: #fff;">Purchase Book</h5>
                    </button>
                </div>
                <div class="card-body">
                    <div id="Collapse" class="collapse show">
                        <h3 style="text-align:center;">Invoice No.# <span id="invoiceNumber"></span></h3>
                        <h5 style="text-align:center;">Date: <?php echo date('d-M-Y');?></h5>
                        
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="SupplierId" class="control-label">Supplier Name</label>
                                    <select id="SupplierId" name = "SupplierId" class="form-control select2">
                                        <option value="">----------------Select------------------</option>
                                        <?php 
                                            $sqlQuery = "SELECT Id, Name, Phone FROM supplier ORDER BY Id DESC";
                                            $queryResult = mysqli_query($con, $sqlQuery);
                                            while($row = mysqli_fetch_assoc($queryResult)){
                                                $id = $row['Id']; $name = $row['Name']; $phone = $row['Phone'];
                                                echo "<option value = '$id'>$name ( $phone ) </option>";
                                            } 
                                        ?>
                                    </select>
                                    <span validation-for="SupplierId" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="BookId" class="control-label">Book Name</label>
                                    <select id="BookId" name = "ProductId" class="form-control select2">
                                        <option value="">----------------Select------------------</option>
                                        <?php 
                                            $sqlQuery = "SELECT Id, Name FROM books ORDER BY Id DESC";
                                            $queryResult = mysqli_query($con, $sqlQuery);
                                            while($row = mysqli_fetch_assoc($queryResult)){
                                                $id = $row['Id']; $name = $row['Name'];
                                                echo "<option value = '$id'>$name</option>";
                                            } 
                                        ?>
                                    </select>
                                    <span validation-for="BookId" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group" style="margin-top: 22px;">
                                    <button type="button" id="bookAddBtn" class="btn btn-success btn-sm">Add</button>
                                </div>
                            </div>
                        </div>
                        <div class="row table-responsive">
                            <table class="table table-bordered table-hover" id="purchaseProductTable">
                                <thead>
                                    <tr style="background-color: #9999ff; font-weight:900; color:black; text-align:center;">
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Vat&Tax</th>
                                        <th>Price</th>
                                        <th>Sell Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="purchaseBookTBody">
                                </tbody>
                                <tfoot>
                                    <tr style="background-color: #9999ff;font-weight: 900;color: black;">
                                        <td colspan="4" align="right">Sub total</td>
                                        <td id="subTotal" align="right"></td>
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr style="font-weight: 900;color: black;">
                                        <td colspan="4" align="right">Discount</td>
                                        <td id="discount">
                                            <input type="number" style="width:90% !important; float: left;" class="form-control rightAlign" id="discountAmount" />
                                            <span  style="width: 10% !important;float: left; margin-top:7px;">%</span>
                                        </td>
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr style="font-weight: 900;color: black;">
                                        <td colspan="4" align="right">Grand total</td>
                                        <td id="grandTotal" align="right"></td>
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr style="font-weight: 900;color: black;">
                                        <td colspan="4" align="right">Paid Amount</td>
                                        <td><input type="number" class="form-control rightAlign" id="paidAmount" readonly /></td>
                                        <td>Payment Mode</td>
                                        <td>
                                            <select class="form-control" id="paymentMode">
                                                <option value="Cash">Cash</option>
                                                <option value="Card">Card</option>
                                                <option value="Mobile Banking">Mobile Banking</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr style="font-weight: 900; color: black;">
                                        <td colspan="4" align="right">Dues</td>
                                        <td id="dues" align="right"></td>
                                        <td colspan="2"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-right" id="bookResetBtn">Reset</button>
                    <button type="button" id="bookCreateBtn" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


<?php include("layout/footer.php"); ?>

<script>
    (function(){
        let ajaxOperation = new AjaxOperation();
        let modalOperation = new ModalOperation();

        let selector = {
            invoiceNumber: $("#invoiceNumber"),
            bookAddBtn: $("#bookAddBtn"),
            bookId: $("#BookId"),
            purchaseBookTBody: $("#purchaseBookTBody"),
            subTotal: $("#subTotal"),
            grandTotal: $("#grandTotal"),
            discountAmount: $("#discountAmount"),
            paidAmount: $("#paidAmount"),
            paymentMode: $("#paymentMode"),
            dues: $("#dues"),
            bookCreateBtn: $("#bookCreateBtn"),
            bookResetBtn: $("#bookResetBtn"),
            supplierId: $("#SupplierId"),

            productIdInfo: ".productIdInfo",
            quantityInfo: ".quantityInfo",
            purchasePriceInfo: ".purchasePriceInfo",
            vatAndTaxInfo: ".vatAndTaxInfo",
            priceInfo: ".priceInfo",
            sellPriceInfo: ".sellPriceInfo",
            deleteInfo: ".deleteInfo",
            incrementQuantity: ".incrementQuantity",
            decrementQuantity: ".decrementQuantity",
            unitPriceInfo: ".unitPriceInfo",
            rowId: 1,
            serialNumber: 1,
            selectedBook: [],
        }
        
        function InvoiceNumber(){
            let operation = new AjaxOperation();
            let response = operation.GetAjaxByValue("../controller/Purchase.php", "Purchase");
            selector.invoiceNumber.text(response);
        }

        class PurchaseDetail{
            constructor(bookId, quantity, purchaseUnitPrice, sellUnitPrice, purchaseTax, totalPrice){
                this.bookId = bookId;
                this.purchaseUnitPrice = purchaseUnitPrice;
                this.sellUnitPrice = sellUnitPrice;
                this.purchaseTax = purchaseTax;
                this.totalPrice = totalPrice;
            }
        }

        class HtmlProcess{
            AddEntryColumn(productId, productName, quantity, unitPrice, vatAndTax, purchasePrice, sellPrice )
            {
                let data = `<tr id = "rowId${selector.rowId}">
                            <td> <a class="productInfo" productId="${productId}" serialNumber="${selector.serialNumber}">${productName}</a> </td>
                            
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-danger btn-sm decrementQuantity" tittle = "Decrement" productId="${productId}" unitPrice = "${unitPrice}" serialNumber="${selector.serialNumber}" type="button"><i class="fa fa-minus-circle"></i></button>
                                    </div>
                                    <input type="number" class="form-control quantityInfo" style = "text-align: center;" min = "1" unitPrice = "${unitPrice}" productId="${productId}" serialNumber="${selector.serialNumber}" value="${quantity}">
                                    <div class="input-group-append">
                                        <button class="btn btn-success btn-sm incrementQuantity" tittle = "Increment" productId="${productId}" unitPrice = "${unitPrice}" serialNumber="${selector.serialNumber}" type="button"><i class="fa fa-plus-circle"></i></button>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="input-group">
                                    <input type="text" class="form-control unitPriceInfo rightAlign" style = "border:none;" serialNumber="${selector.serialNumber}" value="${unitPrice}">
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" class="form-control vatAndTaxInfo rightAlign" min = "0" max = "20" style = "border:none;" serialNumber="${selector.serialNumber}" value="${vatAndTax}">
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" class="form-control purchasePriceInfo rightAlign" style = "border:none;" serialNumber="${selector.serialNumber}" value="${purchasePrice}" readonly>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" class="form-control sellPriceInfo rightAlign" style = "border:none;" serialNumber="${selector.serialNumber}" value="${sellPrice}">
                                </div>
                            </td>
                            <td>
                                <div class="input-group" style = "align:center;">
                                    <button class="btn btn-danger btn-sm deleteRow" rowId="rowId${selector.rowId}" serialNumber="${selector.serialNumber}"><i class="fa fa-trash-alt"></i></button>
                                </div>
                            </td>
                    </tr>`;
                selector.serialNumber ++;
                selector.rowId++;
                return data;
            }
        }

        class PurchaseProcess{
            IsExist(array, bookId){
                let index = array.findIndex(item => item === bookId);
                return index;
            }
            Summation(className){
                let sum = 0;
                $(className).each(function(){
                    sum += Number($(this).val());
                });
                return sum;
            }

            GetRowWiseValue(className, serialNumber){
                let value = 0;
                $(className).each(function(){
                    if($(this).attr("serialNumber") === serialNumber)
                        value = $(this).val();
                });
                return value;
            }
            SetRowWiseValue(className, serialNumber, value){
                $(className).each(function(){
                    if($(this).attr("serialNumber") === serialNumber)
                        $(this).val(value);
                });
            }
            SpecificRowWisePurchase(serialNumber){
                let unitPrice = this.GetRowWiseValue(selector.unitPriceInfo, serialNumber);
                let quantity = this.GetRowWiseValue(selector.quantityInfo, serialNumber);
                let vatAndTax = this.GetRowWiseValue(selector.vatAndTaxInfo, serialNumber);
                let purchasePrice =(( unitPrice * quantity) + ( unitPrice * quantity * vatAndTax / 100 )).toFixed(2);
                
                this.SetRowWiseValue(selector.purchasePriceInfo, serialNumber, purchasePrice);
                this.CalculatePrice();
            }
            CalculatePrice(){
                let subTotal = this.Summation(selector.purchasePriceInfo);
                selector.subTotal.text(subTotal.toFixed(2));
                let discount = selector.discountAmount.val() === null ? 0 :  selector.discountAmount.val();
                let grandTotal = (subTotal - ( subTotal * discount / 100 )).toFixed(2);
                selector.grandTotal.text(grandTotal);
                selector.paidAmount.val(grandTotal);
                selector.dues.text(0.00);
            }
        }

        window.onload = InvoiceNumber();

        let htmlProcess = new HtmlProcess();
        let process = new PurchaseProcess();


        selector.bookAddBtn.click(function(){
            if(selector.bookId.val() !== ""){
                if(selector.selectedBook.length === 0 || process.IsExist(selector.selectedBook, selector.bookId.val()) === -1){
                    selector.selectedBook.push(selector.bookId.val()); // pushing into selected array
                    let data = htmlProcess.AddEntryColumn(selector.bookId.val(), $("#BookId option:selected").text(), '10.00','200.00', '0', '200.00',250.00);
                    let rowCount = selector.purchaseBookTBody.find("tr").length;
                    rowCount > 0 ? $("#purchaseBookTBody tr:first").before(data) : selector.purchaseBookTBody.append(data);
                }
                else
                    toastr.error("Book is already taken!", "Error!");
             }
            else{
                toastr.error("Please Select a Book first!", "Error!");
            }               
        });

        $(document).on("keyup", selector.unitPriceInfo, function(){
            let serialNumber = $(this).attr("serialNumber");
            process.SpecificRowWisePurchase(serialNumber);
        });

        $(document).on("keyup", selector.quantityInfo, function(){
            let serialNumber = $(this).attr("serialNumber");
            process.SpecificRowWisePurchase(serialNumber);
        });

        $(document).on("keyup", selector.vatAndTaxInfo, function(){
            let serialNumber = $(this).attr("serialNumber");
            if($(this).val() >= 0 && $(this).val() <= 20)
                process.SpecificRowWisePurchase(serialNumber);
            else{
                toastr.error("Invalid VAT & TAX", "Error!");
                $(this).val(0); 
                process.SpecificRowWisePurchase(serialNumber);
            }
                
        });

        $(document).on("click", selector.incrementQuantity, function(){
            let serialNumber = $(this).attr("serialNumber");
            let quantity = Number(process.GetRowWiseValue(selector.quantityInfo, serialNumber)) + 1;
            process.SetRowWiseValue(selector.quantityInfo, serialNumber, quantity);
            process.SpecificRowWisePurchase(serialNumber);
        });

        $(document).on("click", selector.decrementQuantity, function(){
            let serialNumber = $(this).attr("serialNumber");
            let quantity = Number(process.GetRowWiseValue(selector.quantityInfo, serialNumber)) - 1;
            if(quantity >= 1 ){
                process.SetRowWiseValue(selector.quantityInfo, serialNumber, quantity);
                process.SpecificRowWisePurchase(serialNumber);
            }
            else{
                process.SetRowWiseValue(selector.quantityInfo, serialNumber, 1);
                toastr.error("Quantity Can't Zero or Negative", "Error");
            }
        });

        selector.discountAmount.keyup(function(){
            if($(this).val() < 0 && $(this).val() > 20)
                process.CalculatePrice();
            else{
                toastr.error("Discount amount can't negative or upper than 20%", "Error!");
                $(this).val(0);
                process.CalculatePrice();
            }
        });

    })();
</script>
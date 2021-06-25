<?php
    $headerName = "Cart";
    include("layout/topbar.php");
    include("layout/sidebar.php");
?>

<?php 
    $userId = $_SESSION['customer']['Id'];
    $sql = "SELECT 
                CASE WHEN OutsideCity = 1 THEN (SELECT InsideDhakaCity FROM companyinformation)
    	             WHEN OutsideCity = 0 THEN (SELECT OutsideDhakaCity FROM companyinformation)
                     ELSE 0
                 END DeliveryCharge
            FROM users
            WHERE Id = '$userId'";
    $charge = mysqli_fetch_assoc(mysqli_query($con, $sql));
?>

<style>
    table thead th, tbody td{
        text-align:center;
    }
    table tfoot td{
        text-align:right;
    }
</style>

<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="cart-title mt-50">
            <h2>Shopping Cart</h2>
        </div>
        
        <div class="row" id = "shoppingCartTable">
                <div class="">
                    <table class="table">
                        <thead>
                            <tr style = "background-color: #d9b3ff;">
                                <th></th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th style = "background-color: #d9b3ff;">Total Price</th>
                                <th style = "background-color: #d9b3ff;"></th>
                            </tr>
                        </thead>
                        <tbody id="shoppingCart">
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan = "4">Sub Total</td>
                                <td>৳<span id = "subTotal"></span>/-</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan = "4">Delivery Charge</td>
                                <td>৳<span id = "deliveryCharge"><?php echo $charge['DeliveryCharge'];?></span>/-</td>
                                 <td></td>
                            </tr>
                            <tr>
                                <td colspan = "4">Grand Total</td>
                                <td>৳<span id = "grandTotal"></span>/-</td>
                                 <td></td>
                            </tr>
                            <tr>
                                <td colspan = "4">Payment Mode</td>
                                 <td><select class = "form-control" id = 'paymentMode'>
                                        <option value = "Cash on Delivery">Cash on Delivery</option>
                                        <option value = "Mobile Banking">Mobile Banking</option>
                                        <option value = "Card">Card</option>
                                    </select>
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>   
        </div>
        <div class="row" id = "shoppingCartButton">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <button type = "button" id = "confirmOrder" class="btn btn-success">Confirm</button>
            </div>
        </div>
    </div>
</div>


<?php include("layout/footer.php");?>

<script>
    (function(){
        let ajaxOperation = new AjaxOperation();
        let serialNumber = 1;
        let selector = {
            stock:[],
            shoppingCart: $("#shoppingCart"),
            subTotal: $("#subTotal"),
            grandTotal: $("#grandTotal"),
            deliveryCharge: $("#deliveryCharge"),
            confirmOrder: $("#confirmOrder"),
            paymentMode: $("#paymentMode"),
            shoppingCartTable: $("#shoppingCartTable"),
            shoppingCartButton: $("#shoppingCartButton"),

            quantityMinus: ".qty-minus",
            quantityPlus: ".qty-plus",
            deleteCart: ".deleteCart",
            quantity: ".qty-text",
            totalPrice: ".totalPrice",
        }

        class Stock {
            constructor(id, quantity){
                this.id = id;
                this.quantity = quantity;
            }
        }

        class OnloadProcess{

            ColumnEntry(photoUrl, bookName,quantity, cartId, bookId, unitPrice, availableQuantity){
                let data = `<tr>
                                <td>
                                    <a href="bookDetail.php?bookId=${bookId}"><img src="${photoUrl}" height = "50" width = "50" alt="Book"></a>
                                </td>
                                <td>
                                    ${bookName}
                                </td>
                                <td>
                                    ৳${unitPrice}
                                </td>
                                <td>
                                    <div class="qty-btn d-flex">
                                        <p>Qty</p>
                                        <div class="quantity">
                                            <span class="qty-minus" cartId = "${cartId}" bookId = "${bookId}" unitPrice = "${unitPrice}" serialNumber = "${serialNumber}" ><i class="fa fa-minus" aria-hidden="true"></i></span>
                                            <input type="number" class="qty-text" bookId = "${bookId}"  unitPrice = "${unitPrice}" serialNumber = "${serialNumber}" min="1" max="${availableQuantity}" name="quantity" value="${quantity}">
                                            <span class="qty-plus" cartId = "${cartId}" bookId = "${bookId}" unitPrice = "${unitPrice}" serialNumber = "${serialNumber}"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </td>
                                <td> ৳ <span class = "totalPrice" unitPrice = "${unitPrice}" serialNumber = "${serialNumber}"> ${unitPrice * quantity}</span> </td>
                                <td><button class = "btn btn-danger deleteCart" title = "Remove from Cart" cartId = ${cartId}><i class="fa fa-trash"></i></button></td>
                            </tr>`;
                serialNumber++;
                return data;
            }

            BuildHtml(response){
                let data = "";
                for(let  i = 0; i < response.length; i ++)
                {
                    let photoUrl = response[i].PhotoUrl;
                    let bookName = response[i].BookName;
                    let bookId = response[i].BookId;
                    let cartId = response[i].Id;
                    let quantity = response[i].Quantity;
                    let unitPrice = response[i].UnitPrice;
                    let availableQuantity = response[i].StockQuantity;
                    let obj = new Stock(bookId, availableQuantity);
                    selector.stock.push(obj);
                    data += this.ColumnEntry(photoUrl, bookName, quantity, cartId, bookId, unitPrice, availableQuantity);
                }
                selector.shoppingCart.html(data);
            }

            GetShoppingCart()
            {
                let response = ajaxOperation.GetAjaxByValue("../controller/ShoppingCart.php", "shoppingCart");
                if(JSON.parse(response).length == 0){
                    selector.shoppingCartTable.hide();
                    selector.shoppingCartButton.hide();
                }
                this.BuildHtml(JSON.parse(response));
            }
        }
        class Process{
            
            GetAvailableQuantity(bookId, quantity)
            {
                let index = selector.stock.findIndex(item => item.id == bookId);
                return selector.stock[index].quantity;
            }
            PurchaseConfirmed(){
                let jsonData = {
                    confirmPurchase: "confirmPurchase",
                    DeliveryCharge : Number(selector.deliveryCharge.text()),
                    GrandTotal : Number(selector.grandTotal.text()),
                    SubTotal: Number(selector.subTotal.text()),
                    PaymentMode: selector.paymentMode.val(),
                };
                let response = ajaxOperation.SavePostAjax("../controller/ShoppingCart.php", jsonData);
                if(JSON.parse(response) === true){
                    toastr.success("Order done Successfully!", "Success!");
                }
                else{
                    toastr.error("Something went wrong!", "Error");
                }
            }
            UpdateQuantity(bookId, quantity)
            {
                let jsonData = {
                    updateQuantity: "updateQuantity",
                    bookId: bookId,
                    quantity: quantity
                };

                let response = ajaxOperation.SavePostAjax("../controller/ShoppingCart.php", jsonData);
            }
            DeleteFromCart(cartId)
            {
                let response = ajaxOperation.GetAjaxByValue("../controller/ShoppingCart.php", cartId);
                if(JSON.parse(response) === true){
                    toastr.success("Removed from cart", "Success!");
                }
                else{
                    toastr.error("Something went wrong", "Error!");
                }
                
            }
            SumByClassName(className, byWhich)
            {
                let sum = 0;
                if(byWhich === "val"){
                    $(className).each(function(){
                        sum += Number($(this).val());
                    });
                }
                else{
                    $(className).each(function(){
                        sum += Number($(this).text());
                    });
                }
                return sum;
            }
            GetValueByClass(className, serialNumber)
            {
                let value=0;
                $(className).each(function(){
                    if($(this).attr("serialNumber") == serialNumber){
                        value=$(this).val();
                    }
                });
                return value;
            }
            SetValueByClass(className, serialNumber, value)
            {
                $(className).each(function(){
                    if($(this).attr("serialNumber") == serialNumber){
                        $(this).val(value);
                    }
                });
            }

            SetTextByClass(className, serialNumber, value)
            {
                $(className).each(function(){
                    if($(this).attr("serialNumber") == serialNumber){
                        $(this).text(value);
                    }
                });
            }
            Calculation()
            {
                let subTotal = this.SumByClassName(selector.totalPrice, "text");
                let grandTotal = Number(subTotal) + Number(selector.deliveryCharge.text());
                selector.subTotal.text(subTotal);
                selector.grandTotal.text(grandTotal);
            }
            IncrementProcess(bookId, serialNumber, unitPrice){
                let currentQuantity = Number(this.GetValueByClass(selector.quantity, serialNumber));
                let availableQuantity = Number(this.GetAvailableQuantity(bookId));
                if(currentQuantity < availableQuantity && currentQuantity >= 1){
                    this.SetValueByClass(selector.quantity, serialNumber, currentQuantity + 1);
                    this.SetTextByClass(selector.totalPrice, serialNumber, (currentQuantity + 1) * unitPrice);
                    this.UpdateQuantity(bookId, currentQuantity + 1);
                }
                else{
                    toastr.error("Exceeded Available Quantity", "Error!");
                    this.SetValueByClass(selector.quantity, serialNumber, 1);
                    this.SetTextByClass(selector.totalPrice, serialNumber, unitPrice);
                    this.UpdateQuantity(bookId, 1);
                }
            }
            DecrementProcess(bookId, serialNumber, unitPrice)
            {
                let currentQuantity = Number(this.GetValueByClass(selector.quantity, serialNumber));
                let availableQuantity = Number(this.GetAvailableQuantity(bookId));
                if(currentQuantity < availableQuantity && currentQuantity > 1){
                    this.SetValueByClass(selector.quantity, serialNumber, currentQuantity - 1);
                    this.SetTextByClass(selector.totalPrice, serialNumber, (currentQuantity - 1) * unitPrice);
                    this.UpdateQuantity(bookId, currentQuantity - 1);
                }
                else{
                    toastr.error("Quantity Can't Negative", "Error!");
                    this.SetValueByClass(selector.quantity, serialNumber, 1);
                    this.SetTextByClass(selector.totalPrice,serialNumber, unitPrice);
                    this.UpdateQuantity(bookId, 1);
                }
            }
            QuantityChange(bookId, serialNumber, currentQuantity, unitPrice)
            {
                let availableQuantity = Number(this.GetAvailableQuantity(bookId));
                if(currentQuantity < 0){
                    toastr.error("Quantity Can't Negative", "Error!");
                    this.SetValueByClass(selector.quantity, serialNumber, 1);
                    this.SetTextByClass(selector.totalPrice, serialNumber, unitPrice);
                    this.UpdateQuantity(bookId, 1);
                }
                else if(currentQuantity > availableQuantity){
                    toastr.error("Exceeded Available Quantity", "Error!");
                    this.SetValueByClass(selector.quantity, serialNumber, 1);
                    this.SetTextByClass(selector.totalPrice, serialNumber, unitPrice);
                    this.UpdateQuantity(bookId, 1);
                }
                else{
                    this.SetTextByClass(selector.totalPrice, serialNumber, currentQuantity * unitPrice);
                    this.UpdateQuantity(bookId, currentQuantity);
                }
            }
        }

        
        let onloadProcess = new OnloadProcess();
        let process = new Process();

        window.onload = function(){
            onloadProcess.GetShoppingCart();
            process.Calculation();
        }

        $(document).on("click", selector.quantityPlus, function(){
            let bookId = $(this).attr("bookId");
            let serialNumber = $(this).attr("serialNumber");
            let unitPrice = $(this).attr("unitPrice");

            process.IncrementProcess(bookId, serialNumber, unitPrice);
            process.Calculation();
        });

        $(document).on("click", selector.quantityMinus, function(){
            let bookId = $(this).attr("bookId");
            let serialNumber = $(this).attr("serialNumber");
            let unitPrice = $(this).attr("unitPrice");
            process.DecrementProcess(bookId, serialNumber, unitPrice);
            process.Calculation();
        });

        $(document).on("change", selector.quantity, function(){
            let bookId = $(this).attr("bookId");
            let serialNumber = $(this).attr("serialNumber");
            let currentQuantity = Number($(this).val());
            let unitPrice = $(this).attr("unitPrice");
            if(currentQuantity == 0) {
                process.SetValueByClass(selector.quantity, serialNumber, 1);
                process.QuantityChange(bookId, serialNumber, 1, unitPrice);
                process.UpdateQuantity(bookId, 1);
            }
            else{
                process.QuantityChange(bookId, serialNumber, currentQuantity, unitPrice);
            }
            process.Calculation();
        });
        $(document).on("keyup", selector.quantity, function(){
            let bookId = $(this).attr("bookId");
            let serialNumber = $(this).attr("serialNumber");
            let currentQuantity = Number($(this).val());
            let unitPrice = $(this).attr("unitPrice");
            process.QuantityChange(bookId, serialNumber, currentQuantity, unitPrice);
            process.Calculation();
        });

        $(document).on("click", selector.deleteCart, function(){
            let cartId = $(this).attr("cartId");
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
                        process.DeleteFromCart(cartId);
                        onloadProcess.GetShoppingCart();
                        process.Calculation();
                    }
                });
        });
        
        selector.confirmOrder.click(function(){
            let rowCount = $("#shoppingCart tr").length;
            if(rowCount > 0){
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
                        process.PurchaseConfirmed();
                        onloadProcess.GetShoppingCart();
                        process.Calculation();
                    }
                });
            }
            else{
                toastr.error("Nothing to Order!", "Error!");
            }
        });

    })();
</script>
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
        
        <div class="row">
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
                                <td style = "text-align:right !important;">5000</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan = "4">Delivery Charge</td>
                                <td style = "text-align:right !important;"> ৳ <?php echo $charge['DeliveryCharge'];?>/-</td>
                                 <td></td>
                            </tr>
                            <tr>
                                <td colspan = "4">Grand Total</td>
                                <td style = "text-align:right !important;"></td>
                                 <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>


            <div class="col-12 col-lg-12">
                <div class="cart-summary">
                    <h5>Cart Total</h5>
                    <ul class="summary-table">
                        <li><span>subtotal:</span> <span>$140.00</span></li>
                        <li><span>delivery:</span> <span>Free</span></li>
                        <li><span>total:</span> <span>$140.00</span></li>
                    </ul>
                    <div class="cart-btn mt-100">
                        <a href="cart.html" class="btn amado-btn w-100">Checkout</a>
                    </div>
                </div>
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
                                            <span class="qty-minus" onclick="var effect = document.getElementById('qty2'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                            <input type="number" class="qty-text" id="qty2" step="1" min="1" max="${availableQuantity}" name="quantity" value="${quantity}">
                                            <span class="qty-plus" onclick="var effect = document.getElementById('qty2'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </td>
                                <td> ৳ ${unitPrice * quantity}</td>
                                <td><button class = "btn btn-danger"><i class="fa fa-trash"></i></button></td>
                            </tr>`;
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
                    selector.stock.push(availableQuantity);
                    data += this.ColumnEntry(photoUrl, bookName, quantity, cartId, bookId, unitPrice, availableQuantity);
                }
                selector.shoppingCart.html(data);
            }

            GetShoppingCart()
            {
                let response = ajaxOperation.GetAjaxByValue("../controller/ShoppingCart.php", "shoppingCart");
                this.BuildHtml(JSON.parse(response));
            }
        }

        window.onload = function(){
            let onloadProcess = new OnloadProcess();
            onloadProcess.GetShoppingCart();
        }

    })();
</script>
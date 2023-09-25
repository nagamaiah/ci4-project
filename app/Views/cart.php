
<?= $this->extend('layouts/base') ?>

<?= $this->section('content') ?>

        <h3 class="mb-3 mt-2">Cart Page</h3>

        <?= $this->include('validation_messages') ?>

        <?php if(count($products) > 0): ?>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">SL No.</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Tax</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Delivery Charge</th>
                        <th scope="col">Actual Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1?>
                    <?php foreach($products as $product):?>
                        <tr data-id="<?= $product['id'];?>" class="product-row">
                            <th scope="row"><?= $count++ ?></th>
                            <td class="product-name"><?= $product['product-name'];?></td>
                            <td>
                                <img height="140px" width="180px" src="<?= base_url('images/'.$product['image'])?>" /><br>
                                <?= substr_replace($product['discription'], "...", 15)?>
                                <a href="<?= base_url('products/show/'.$product['id']) ?>">View More</a>
                            </td>
                            <td>
                                <div class="d-flex mb-4" style="max-width: 300px">
                                    <button class="btn btn-primary px-3 me-2" onclick="decQty(this)">
                                        <i class="fa fa-minus"></i>
                                    </button>

                                    <div class="form-outline">
                                        <input class="quantity" id="form1" min="1" name="quantity" value="1" type="number" class="form-control" />
                                    </div>

                                    <button class="btn btn-primary px-3 ms-2" onclick="incQty(this)">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </td>
                            <td class="price"><?= $product['price']?></td>
                            <td class="taxable"><?= $product['taxable'] ? '<span>12</span>%' : '<span>No</span>'?></td>
                            <td class="discount"><?= $product['discount'] ? '<span>600</span>' : '<span>No</span>'?></td>
                            <td class="delvry-charge"><?= $product['delivery-charge'] ? '<span>100</span>' : '<span>No</span>'?></td>
                            <td class="actual-price"></td>
                        </tr>
                    <?php endforeach;?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                            <b>Total Amount</b>: <span id="total-amount"></span><br>
                            <b>Delivery Charge</b>: <span id="delivery-charge"></span><br>
                            <b>Grand Total</b>: <span id="grand-total"></span><br>
                            </td>
                        </tr>
                </tbody>
            </table>

            <button onclick="placeOrder(event)" class="btn btn-warning mb-4">Place Order</button>
        <?php else: ?>
            <h5>No Data Found. Please add products.</h5>
        <?php endif?>

<?= $this->endSection() ?>


<?= $this->section('javascript-code') ?>

    <script type="text/javascript">
        (function(){
            getPriceDetails();
        })();

        function getPriceDetails()
        {
            $('.product-row').each(function(index,ele){
                let price = $(this).find('.price').text();
                let taxable = $(this).find('.taxable span').text();
                let discount = $(this).find('.discount').text();
                let quantity = $(this).find('.quantity').val();
                let actualPrice  = 0.0;
                let amount = 0.0;

                amount += parseFloat(price * quantity);
                if(taxable != 'No'){
                    actualPrice += parseFloat(amount + amount*(taxable/100));
                    if(discount != 'No'){
                        let finalPrice = (actualPrice - parseFloat(discount));
                        $(this).find('.actual-price').text(finalPrice);
                    } else {
                        $(this).find('.actual-price').text(actualPrice);
                    }
                } else {
                    actualPrice += amount;
                    if(discount != 'No'){
                        let finalPrice = (actualPrice - parseFloat(discount))
                        $(this).find('.actual-price').text(finalPrice);
                    } else {
                        $(this).find('.actual-price').text(actualPrice);
                    }
                }
            });
            getTotalAmount();
            getDeliveryCharge();
            getGrandTotal();

        }

        function getTotalAmount()
        {
            let totalAmount = 0.0;
            $('.actual-price').each(function(){
                totalAmount += parseFloat($(this).text());
            });
            $('#total-amount').text(totalAmount);

        }

        function getDeliveryCharge()
        {
            let deliveryCharge = 0.0;
            $('.delvry-charge span').each(function(){
                if($(this).text() != 'No'){
                    deliveryCharge += parseFloat($(this).text());
                }
            });
            $('#delivery-charge').text(deliveryCharge);

        }

        function getGrandTotal()
        {
            let grandTotal = 0.0;
            grandTotal += parseFloat($('#total-amount').text()) + parseFloat($('#delivery-charge').text())
            $('#grand-total').text(grandTotal);
        }

        function decQty(ele)
        {
            ele.parentNode.querySelector('input[type=number]').stepDown();
            getPriceDetails();
        }

        function incQty(ele)
        {
            ele.parentNode.querySelector('input[type=number]').stepUp();
            getPriceDetails();
        }

        function placeOrder(e){
            let prodArr = [];
            $('.product-row').each(function(index,ele){
                let prodObj = {};
                let productId = $(this).attr('data-id');
                let productName = $(this).find('.product-name').text();
                let productQty = $(this).find('.quantity').val();
                let productUnitPrice = $(this).find('.price').text();

                prodObj['product_id'] = productId;
                prodObj['product-name'] = productName;
                prodObj['quantity'] = productQty;
                prodObj['product_unit_price'] = productUnitPrice;
                prodArr.push(prodObj);
            });

            $.ajax({  
                url: `<?= base_url('orders/store'); ?>`,
                type: 'post',
                dataType:'json',
                data:{data:prodArr},
                success : function(res){
                    if(res.success){
                        window.location.href = `<?= base_url("orders")?>`;
                    }
                }  
            });
        }
            
    </script>

<?= $this->endSection() ?>
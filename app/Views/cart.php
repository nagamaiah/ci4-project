
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
                        <th scope="col">Actual Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1?>
                    <?php foreach($products as $product):?>
                        <tr class="product-row">
                            <th scope="row"><?= $count++ ?></th>
                            <td><?= $product['product-name'];?></td>
                            <td>
                                <img height="140px" width="180px" src="<?= base_url('images/'.$product['image'])?>" /><br>
                                <?= substr_replace($product['discription'], "...", 15)?>
                                <a href="<?= base_url('products/show/'.$product['id']) ?>">View More</a>
                            </td>
                            <td>
                                <div class="d-flex mb-4" style="max-width: 300px">
                                    <button class="btn btn-primary px-3 me-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                        <i class="fa fa-minus"></i>
                                    </button>

                                    <div class="form-outline">
                                        <input class="quantity" id="form1" min="0" name="quantity" value="1" type="number" class="form-control" />
                                    </div>

                                    <button class="btn btn-primary px-3 ms-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </td>
                            <td class="price"><?= $product['price']?></td>
                            <td class="taxable"><?= $product['taxable'] ? '<span>12</span>%' : '<span>No</span>'?></td>
                            <td class="discount"><?= $product['discount'] ? '<span>600</span>' : '<span>No</span>'?></td>
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
                            <td></td>
                            <td>
                                <span>Total Amount</span> : 333 <br>
                                <span>Tax</span> : 234 <br>
                                <span>Delivery Charge</span> : 600 <br>
                                <span>Grand Total</span> : 3453 <br>
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
            getActualPrice();
            console.log();
        })();

        function getActualPrice()
        {
            $('.product-row').each(function(index,ele){
                let price = $(this).find('.price').text();
                let taxable = $(this).find('.taxable span').text();
                let discount = $(this).find('.discount').text();
                let quantity = $(this).find('.quantity').val();
                let actualPrice  = 0.0;
                let amount = 0.0;

                if(taxable != 'No'){
                    amount += parseFloat(price * quantity);
                    actualPrice += parseFloat(amount + amount*(taxable/100));
                    if(discount != 'No'){
                        let finalPrice = (actualPrice - parseFloat(discount));
                        $(this).find('.actual-price').text(finalPrice);
                    } else {
                        $(this).find('.actual-price').text(actualPrice);
                    }
                } else {
                    amount += parseFloat(price * quantity);
                    actualPrice += amount;
                    if(discount != 'No'){
                        let finalPrice = (actualPrice - parseFloat(discount))
                        $(this).find('.actual-price').text(finalPrice);
                    } else {
                        $(this).find('.actual-price').text(actualPrice);
                    }
                }
            })
        }

        function placeOrder(e){
            console.log(e.target);
        }
            
    </script>

<?= $this->endSection() ?>
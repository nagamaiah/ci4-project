
<?= $this->extend('layouts/base') ?>

<?= $this->section('content') ?>
<h3 class="mb-3 mt-2">Orders Page</h3>

<?= $this->include('validation_messages') ?>

<?php if(count($orders) > 0): ?>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product ID</th>
                <th scope="col">Product Unit Price</th>
                <th scope="col">Order Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($orders as $order):?>
                <tr class="order-row">
                    <td class="order-id"><?= $order['id'];?></td>
                    <td class="product-name">
                        <a href="<?= base_url('products/show/'.$order['product_id']) ?>"><?= $order['product-name'];?></a>
                    </td>
                    <td class="product-id"><?= $order['product_id'];?></td>
                    <td class="product-unit-price"><?= $order['product_unit_price']?></td>
                    <td class="order-date"><?= $order['order_date']?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <?php else: ?>
            <h5>No Data Found.</h5>
    <?php endif?>
<?= $this->endSection() ?>

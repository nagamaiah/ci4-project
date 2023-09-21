
<?= $this->extend('layouts/base') ?>

<?= $this->section('content') ?>
    <h3 class="mt-2">Create product</h3>

    <?= $this->include('validation_messages') ?>

    <form action="<?= base_url('products/store') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="productName">Product Name : </label>
            <input type="text" class="form-control" name="product-name">
        </div>
        <div class="form-group">
            <label for="category">Category : </label>
            <input type="text" class="form-control" name="category">
        </div>
        <div class="form-group">
            <label for="price">Price : </label>
            <input type="number" class="form-control" name="price">
        </div>
        <div class="form-group">
            <label for="description">Description : </label>
            <textarea class="form-control" name="discription"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image : </label>
            <input type="file" class="form-control" name="image">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="taxable">
            <label class="form-check-label">Is Taxable</label>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="delivery-charge">
            <label class="form-check-label">Apply Delivery Charges</label>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="discount">
            <label class="form-check-label">Apply Discount (in %)</label>
        </div>
        <button class="btn btn-success">Insert</button>
    </form>

    
<?= $this->endSection() ?>
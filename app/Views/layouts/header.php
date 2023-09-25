<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="<?= base_url() ?>">Home Page</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="<?= base_url('products/add') ?>">Add Product</span></a>
            <a class="nav-item nav-link" href="<?= base_url('cart') ?>">Cart Page</a>
            <a class="nav-item nav-link" href="<?= base_url('orders') ?>">Orders Page</a> 
        </div>
    </div>
</nav>
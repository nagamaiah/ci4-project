<?= $this->extend('layouts/base') ?>

<?= $this->section('content') ?>
    <h3><?= $product['product-name'];?></h3>
    <p><?= $product['discription'];?></p>
    <img height="140px" width="180px" src="<?= base_url('images/'.$product['image'])?>" />
<?= $this->endSection() ?>
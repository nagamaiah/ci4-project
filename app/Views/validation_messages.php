
<?php if(session()->has('success')): ?>
    <p class="alert alert-success"><?= session('success') ?></p>
<?php endif; ?>

<?php if(session()->has('error')): ?>
    <p class="alert alert-danger"><?= session('error') ?></p>
<?php endif; ?>

<?php if(session()->has('errors')): ?>
    <ul class="alert alert-danger">
        <?php foreach(session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<?php defined('APP_PATH') or exit(header('Location: /', true, 301)); ?>
<?php include component('/Top'); ?>
<div class='container-fluid'>
    <div class='row justify-content-center'>
        <div class='col-sm-6 p-4 mt-4'>
            <h1 class='font-weight-light'><?php echo $params['title']; ?></h1>
            <hr>
            <p class='text-primary'><?php echo host(APP_URI); ?></p>
            <p class='text-muted'><?php echo $params['description']; ?></p>
            <a class='btn btn-dark btn-sm float-right text-uppercase' href='<?php echo host('/'); ?>'>Go to Home</a>
        </div>
    </div>
</div>
<?php include component('/Bottom'); ?>

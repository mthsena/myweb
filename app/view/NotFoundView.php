<?php

namespace app;

require_once dirname(__DIR__, 2) . '/core/Checker.php';

?>
<div class='container-fluid'>
    <div class='row justify-content-center'>
        <div class='col-sm-6 p-4 mt-4'>
            <h1 class='fw-light'><?php echo $title; ?></h1>
            <hr>
            <p class='text-primary'><?php echo Path::url(); ?></p>
            <p class='text-muted'><?php echo $description; ?></p>
            <a class='btn btn-dark btn-sm float-end text-uppercase' href='<?php echo Path::host('/'); ?>'>Go to Home</a>
        </div>
    </div>
</div>
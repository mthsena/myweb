<?php defined('APP_PATH') or exit(header('Location: /', true, 301)); ?>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js'></script>
<script>
    <?php echo minify(asset('/App.js')); ?>
</script>
</body>
</html>

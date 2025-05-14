<?php

namespace app;

require_once dirname(__DIR__, 2) . '/core/Checker.php';

?>
<!DOCTYPE html>
<html lang='<?php echo Config::$lang; ?>' prefix='og: http://ogp.me/ns#'>

<head>
    <meta charset='<?php echo Config::$charset; ?>'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no'>
    <meta name='description' content='<?php echo $description . ' - ' . Config::$description; ?>'>
    <meta name='keywords' content='<?php echo $keywords . ',' . Config::$keyword; ?>'>
    <meta name='robots' content='<?php echo $robots; ?>'>
    <meta name='twitter:card' content='summary'>
    <meta name='twitter:title' content='<?php echo $title . ' - ' . Config::$title; ?>'>
    <meta name='twitter:description' content='<?php echo $description . ' - ' . Config::$description; ?>'>
    <meta name='twitter:image' content='<?php echo Path::host('/favicon.ico'); ?>'>
    <meta name='twitter:url' content='<?php echo Path::url(); ?>'>
    <meta property='og:locale' content='<?php echo Config::$lang; ?>'>
    <meta property='og:type' content='website'>
    <meta property='og:site_name' content='<?php echo $title . ' - ' . Config::$title; ?>'>
    <meta property='og:title' content='<?php echo $title . ' - ' . Config::$title; ?>'>
    <meta property='og:description' content='<?php echo $description . ' - ' . Config::$description; ?>'>
    <meta property='og:image' content='<?php echo Path::host('/favicon.ico'); ?>'>
    <meta property='og:url' content='<?php echo Path::url(); ?>'>
    <link rel='canonical' href='<?php echo Path::url(); ?>'>
    <link rel='icon' type='image/x-icon' href='<?php echo Path::host('/favicon.ico'); ?>'>
    <title><?php echo $title . ' - ' . Config::$title; ?></title>
    <style>
        <?php echo Asset::css('/App.css'); ?>
    </style>
</head>

<body>
    <?php echo $view; ?>
    <script src='https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js'></script>
    <script>
        <?php echo Asset::js('/App.js'); ?>
    </script>
</body>

</html>
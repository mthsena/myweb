<?php defined('APP_PATH') or exit(header('Location: /', true, 301)); ?>
<!DOCTYPE html>
<html lang='pt-BR' prefix='og: http://ogp.me/ns#'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no'>
    <meta name='description' content='<?php echo $params['description'] . ' ' . APP_DESCRIPTION; ?>'>
    <meta name='keywords' content='<?php echo APP_KEYWORDS; ?>'>
    <meta name='robots' content='<?php echo $params['robots']; ?>'>
    <meta name='twitter:card' content='summary'>
    <meta name='twitter:title' content='<?php echo APP_TITLE . ' - ' . $params['title']; ?>'>
    <meta name='twitter:description' content='<?php echo $params['description'] . ' ' . APP_DESCRIPTION; ?>'>
    <meta name='twitter:image' content='<?php echo host('/favicon.ico'); ?>'>
    <meta name='twitter:url' content='<?php echo host(APP_URI); ?>'>
    <meta property='og:locale' content='pt-BR'>
    <meta property='og:type' content='website'>
    <meta property='og:site_name' content='<?php echo APP_TITLE; ?>'>
    <meta property='og:title' content='<?php echo APP_TITLE . ' - ' . $params['title']; ?>'>
    <meta property='og:description' content='<?php echo $params['description'] . APP_DESCRIPTION; ?>'>
    <meta property='og:image' content='<?php echo host('/favicon.ico'); ?>'>
    <meta property='og:url' content='<?php echo host(APP_URI); ?>'>
    <link rel='canonical' href='<?php echo host(APP_URI); ?>'>
    <link rel='ico' type='image/x-icon' href='<?php echo host('/favicon.ico'); ?>'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500&display=swap'>
    <title><?php echo APP_TITLE . ' - ' . $params['title']; ?></title>
    <style>
        <?php echo minify(path('/App.css')); ?>
    </style>
</head>
<body>

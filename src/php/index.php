<?php // phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols

if (!defined('ROOTPROJECT')) {
    define('ROOTPROJECT', 'D:\SOFT\PROGRAM\OpenServer\domains\iwa_formbuilder');
}

require_once(ROOTPROJECT . '/src/php/config.php');

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <?php if (empty($_GET['page'])) : ?>
        <title>Demo</title>
    <?php else : ?>
        <title><?= (string)$_GET['page']; ?></title>
    <?php endif; ?>
    <script defer src="js/app.js?<?= md5((string)time()); ?>"></script>
    <link href="css/app.css?<?= md5((string)time()); ?>" rel="stylesheet">
</head>
<body>

<div class="container-fluid py-md-3">
    <?php if (empty($_GET['page'])) : ?>
        <div class="demo_container">
            <h1>Demo <?= 'PHP:'; ?> <?= IWA_FormBuilder\App::appDemo(); ?></h1>
        </div>
    <?php else :
        $pathinfo = pathinfo((string)$_GET['page']);
        /** @psalm-suppress UnresolvableInclude */
        require_once(ROOTPROJECT . '/src/php/pages/' . $pathinfo['basename'] . '/page.php');
    endif; ?>
</div>
</body>
</html>
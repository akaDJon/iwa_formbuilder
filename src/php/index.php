<?php // phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols

if (!defined('ROOTPROJECT')) {
    define('ROOTPROJECT', 'D:\SOFT\PROGRAM\OpenServer\domains\iwa_formbuilder');
}

require_once(ROOTPROJECT . '/src/php/config.php');

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Demo</title>
    <script defer src="js/app.js?<?= md5((string)time()); ?>"></script>
    <link href="css/app.css?<?= md5((string)time()); ?>" rel="stylesheet">
</head>
<body>

<?php if (empty($_GET['page'])) : ?>
    <div class="demo_container">
        <h1>Demo <?= 'PHP:'; ?> <?= IWA_FormBuilder\App::appDemo(); ?></h1>
    </div>
<?php else :
    $pathinfo = pathinfo((string)$_GET['page']);
    /** @psalm-suppress UnresolvableInclude */
    require_once(ROOTPROJECT . '/src/php/pages/' . $pathinfo['basename'] . '/page.php');
endif; ?>

</body>
</html>
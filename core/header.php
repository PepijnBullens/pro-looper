<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>placeholder</title>

    <?php
        foreach($css as $cssFile) {
    ?>
    <link rel="stylesheet" href="<?= $env['BASE_URL'] . 'assets/css/' . $cssFile ?>">
    <?php
        }

        foreach($js as $jsFile) {
    ?>
    <script src="<?= $env['BASE_URL'] . 'assets/js/' . $jsFile ?>" defer></script>
    <?php
        }
    ?>
    <script src="<?= $env['BASE_URL'] ?>assets/js/global.js" defer></script>
</head>

<body>
<?php
$data = json_decode(file_get_contents('admin/data.json'), true);

$route = (!$_GET['page'] || $_GET['page'] === "/") ? $data['config']['defaultPage'] : $_GET['page'];

if (!isset($data['routes'][$route])) {
    http_response_code(404);
    die('Page introuvable');
}

$page = $data['routes'][$route];
$config = $data['config'];

?>
<!DOCTYPE html>

<html lang="<?= $config['lang'] ?>">

<head>

    <meta charset="<?= $config['charset'] ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($config['siteName']) ?> - <?= htmlspecialchars($page['seo']['title']) ?></title>

    <meta name="description" content="<?= htmlspecialchars($page['seo']['description']) ?>">

    <meta name="author" content="<?= htmlspecialchars($config['author']) ?>">

    <base href="<?= htmlspecialchars($config['siteUrl']) ?>">

    <link rel="icon" href="<?= htmlspecialchars($config['favicon']) ?>">

    <link rel="stylesheet" href="assets/style.css">
</head>

<body class="severin">

    <?php

    $Menu = "Composants/Menu/index.php";
        require_once $Menu;
        $function = 'renderMenu';
            $function($config['menu']);

foreach ($page['components'] as $section) {

    $componentName = $section['component'];

    $componentPath = "Composants/$componentName/index.php";

    if (file_exists($componentPath)) {

        require_once $componentPath;

        $function = 'render' . $componentName;

        if (function_exists($function)) {

            $function($section['data']);
        }
    }
}

?>

    <script type="module" src="assets/app.js"></script>

</body>

</html>
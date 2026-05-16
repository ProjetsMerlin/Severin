<?php
$data = json_decode(file_get_contents('admin/data.json'), true);
$route = (!$_GET['page'] || $_GET['page'] === "/") ? $data['config']['defaultPage'] : $_GET['page'];

if (!isset($data['routes'][$route])) {
    header('location: 404');
    exit;
}

$page = $data['routes'][$route];
$config = $data['config'];

$siteUrl = htmlspecialchars($config['siteUrl']);
if ($_SERVER['SERVER_NAME'] !== "localhost") {
    $siteUrl = htmlspecialchars($config['siteUrlOnline']);
}
?>
<!DOCTYPE html>
<html lang="<?= $config['lang'] ?>">

<head>
    <meta charset="<?= $config['charset'] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($config['siteName']) ?> - <?= htmlspecialchars($page['seo']['title']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($page['seo']['description']) ?>">

    <meta name="author" content="<?= $siteUrl ?>">

    <base href="<?= htmlspecialchars($config['siteUrl']) ?>">

    <!-- generate by https://realfavicongenerator.net/  -->
    <link rel="icon" type="image/png" href="assets/images/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="assets/images/favicon.svg" />
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png" />
    <link rel="manifest" href="assets/images/site.webmanifest" />

    <link rel="icon" href="<?= htmlspecialchars($config['favicon']) ?>">
    <link rel="stylesheet" href="assets/style.css?v=<?= filemtime('assets/style.css') ?>">
</head>

<body class="severin">
    <?php
        require_once "Composants/Menu/index.php";
        renderMenu($config['Menu']);

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

        require_once "Composants/Footer/index.php";
        renderFooter($config['Footer']);
?>

    <script type="module" src="assets/app.js?v=<?= filemtime('assets/app.js') ?>"></script>

</body>

</html>
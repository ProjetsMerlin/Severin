<?php
/* LOGS ERREUR */
function custom_error_handler($errno, $errstr, $errfile, $errline) { $error_message = "[" . date("Y-m-d H:i:s") . "] "; $error_message .= "Erreur : [$errno] $errstr - Fichier : $errfile - Ligne : $errline\n"; $log_file = __DIR__ . '/error_log.txt'; error_log($error_message, 3, $log_file); if (ini_get("display_errors")) { echo $error_message; } return false; } set_error_handler("custom_error_handler"); register_shutdown_function(function () { $error = error_get_last(); if ($error !== null && ($error['type'] === E_ERROR || $error['type'] === E_PARSE)) { custom_error_handler($error['type'], $error['message'], $error['file'], $error['line']); } }); error_reporting(E_ALL);
/* SLUG FONCTION */
function slugify($string){ $string = trim($string); $string = iconv( 'UTF-8', 'ASCII//TRANSLIT', $string ); $string = strtolower($string); $string = preg_replace( '/[^a-z0-9]+/', '-', $string ); $string = trim($string, '-'); return $string; }
/* READ DATA JSON */
$data = json_decode(file_get_contents('admin/data.json'), true);
if ($data === null) : http_response_code(500); die('Erreur : le fichier de configuration est invalide ou corrompu. (JSON malformé)'); endif;
/* ROUTING */
$config = $data['config'];
$routes = array_keys($data['routes']);
$route = isset( $_GET['page'] ) && $_GET['page'] !== "index.php" ? $_GET['page'] : $config['defaultPage'];
$page = $data['routes'][$route] ?? null;
if (!in_array($route, $routes) || empty($page)) : header('location: 404'); exit; endif;
$siteUrl = htmlspecialchars($config['siteUrl']);
$titleSeo = htmlspecialchars($config['siteName']) . " - " . htmlspecialchars($page['seo']['title']);
if ($_SERVER['SERVER_NAME'] !== "localhost") : $siteUrl = htmlspecialchars($config['siteUrlOnline']); endif;
/* ROBOTS.TXT*/
if( isset($_GET['page']) && $_GET['page'] === "robots.txt") {
    header('Content-Type: text/plain;charset=utf-8');
    $robots_txt = "User-agent: *\n";
    $robots_txt .= "Disallow: " . $page["hideFolder"] ?? "" . "\n";
    $robots_txt .= "\n";
    $robots_txt .= "Sitemap: ";
    $robots_txt .= $siteUrl;
    $robots_txt .= "sitemap.xml\n";
    echo $robots_txt;
    exit;
}
/* SITEMAP.XML*/
if( isset($_GET['page']) && $_GET['page'] === "sitemap.xml") {
    header('Content-Type: application/xml; charset=utf-8');
    $sitemap_xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    $sitemap_xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
    foreach ($data['routes'] as $route => $page) {
    if( $page["seo"] && $page["seo"]["priority"]) {
    $sitemap_xml .= " <url>\n";
        $sitemap_xml .= " <loc>" . $siteUrl . htmlspecialchars($route) . "</loc>\n";
        $sitemap_xml .= " <lastmod>" . date('Y-m-d', filemtime('admin/data.json')) . "</lastmod>\n";
        $sitemap_xml .= " <priority>" . $page["seo"]["priority"] . "</priority>\n";
        $sitemap_xml .= " </url>\n";
    }
    }
    $sitemap_xml .= "</urlset>";
    echo $sitemap_xml;
    exit;
}
/* ASSETS */
$assets = [ 'scripts' => [], 'styles' => [] ];
foreach ($page['components'] as $component) {
    $dependenciesPath = __DIR__ . '/Components/' . $component['component'] . '/dependencies.php';
    if (!file_exists($dependenciesPath)) {
        continue;
    }
    $dependencies = require $dependenciesPath;
    $assets['scripts'] = array_merge($assets['scripts'], $dependencies['scripts'] ?? []);
    $assets['styles'] = array_merge($assets['styles'], $dependencies['styles'] ?? []);
}
$assets['scripts'] = array_unique($assets['scripts']);
$assets['styles'] = array_unique($assets['styles']);
?>
<!DOCTYPE html>
<html lang="<?= $config['lang'] ?>">
<head>
    <meta charset="<?= $config['charset'] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titleSeo ?></title>
    <meta name="description" content="<?= htmlspecialchars($page['seo']['description']) ?>">
    <meta name="author" content="<?= $siteUrl ?>">
    <base href="<?= $siteUrl ?>">
    <!-- Open Graph -->
    <?php
    $balisesOgg = '
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="' . $titleSeo. '">
    <meta property="og:title" content="' . $titleSeo. '" />
    <meta property="og:description" content="' . htmlspecialchars($page['seo']['description']) . '" />
    <meta property="og:image" content="' . htmlspecialchars($config['siteImageShare']) . '" />
    <meta property="og:url" content="' . $siteUrl . '" />
    <meta property="og:type" content="website">
    <meta property="og:locale" content="' . $config['lang'] . '" />
    <meta name="twitter:title" content="' . $titleSeo. '" />
    <meta name="twitter:description" content="' . htmlspecialchars($page['seo']['description']) . '" />
    <meta name="twitter:image" content="' . htmlspecialchars($config['siteImageShare']) . '" />
    <meta name="twitter:url" content="' . $siteUrl . '" />';
    echo $balisesOgg;
    ?>
    <!-- favicons | generate by https://realfavicongenerator.net/  -->
    <link rel="icon" type="image/png" href="assets/images/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="assets/images/favicon.svg" />
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png" />
    <link rel="manifest" href="assets/images/site.webmanifest" />
    <link rel="icon" href="assets/images/favicon.ico">
    <!-- Styles -->
    <?php foreach ($assets['styles'] as $style) : ?>
    <link rel="stylesheet" href="<?= $style ?>">
    <?php endforeach; ?>
    <link rel="stylesheet" href="assets/style.css?v=<?= filemtime('assets/style.css') ?>">
</head>
<body data-baseurl="<?= $siteUrl ?? "" ?>" class="severin">
   <?php
        require_once "Components/".$config["fixedContent"][0]."/index.php";
        $function = 'render' . $config["fixedContent"][0];
        $function($config[ $config["fixedContent"][0] ]);
    ?>
    <main>
        <?php
        foreach ($page['components'] as $section) {
            $componentName = $section['component'];
            $componentPath = "Components/$componentName/index.php";

            if (file_exists($componentPath)) {
                require_once $componentPath;
                $function = 'render' . $componentName;

                if (function_exists($function)) {
                    $function($section['data']);
                }
            }
        }
        ?>
    </main>
    <?php
        require_once "Components/".$config["fixedContent"][1]."/index.php";
        $function = 'render' . $config["fixedContent"][1];
        $function($config[ $config["fixedContent"][1] ]);
    ?>
    <?php foreach ($assets['scripts'] as $script) : ?>
    <script src="<?= $script ?>"></script>
    <?php endforeach; ?>
    <script type="module" src="assets/app.js?v=<?= filemtime('assets/app.js') ?>"></script>
</body>

</html>
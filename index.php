<?php
/* LOGS ERREUR */
function custom_error_handler($errno, $errstr, $errfile, $errline) { $error_message = "[" . date("Y-m-d H:i:s") . "] "; $error_message .= "Erreur : [$errno] $errstr - Fichier : $errfile - Ligne : $errline\n"; $log_file = __DIR__ . '/error_log.txt'; error_log($error_message, 3, $log_file); if (ini_get("display_errors")) { echo $error_message; } return false; } set_error_handler("custom_error_handler"); register_shutdown_function(function () { $error = error_get_last(); if ($error !== null && ($error['type'] === E_ERROR || $error['type'] === E_PARSE)) { custom_error_handler($error['type'], $error['message'], $error['file'], $error['line']); } }); error_reporting(E_ALL);
/* SLUG FONCTION */
function slugify($string){ $string = trim($string); $string = iconv( 'UTF-8', 'ASCII//TRANSLIT', $string ); $string = strtolower($string); $string = preg_replace( '/[^a-z0-9]+/', '-', $string ); $string = trim($string, '-'); return $string; }
/* API WORDPRESS */
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$apiEndpoint = '/projets/lintermediaire/en_cours/Severina/wordpress/wp-json/severin/v1/severin';
$jsonFile = $protocol . '://' . $host . $apiEndpoint;
$response = file_get_contents($jsonFile);
if ($response === false) :  http_response_code(500); exit('API Severin inaccessible'); endif;
/* READ DATA JSON */
$data = json_decode($response, true);
if (!is_array($data)) : http_response_code(500); exit('Réponse API Severin invalide'); endif;
$config = $data['config'];
$locale = $data['locale'];
$meta = $data['meta'];
/* ROUTING */
$lang = isset($_GET['lang']) ? htmlspecialchars($_GET['lang']) : $locale['langDefault'];
$lang = in_array($lang, $locale['languages']) ? $lang : $locale['langDefault'];
$route = empty($_GET['page']) ? $config['defaultPage'] : $lang . '/' . htmlspecialchars($_GET['page']);
$route = preg_match('/^[a-zA-Z0-9\-_.\/]+$/', $route) ? $route : $config['defaultPage'][$lang];
$route === 'index.php' && $route = $config['defaultPage'];
$page = $data['routes'][$route] ?? null;
if (!$page) : http_response_code(404); $page = $data['routes'][$lang . '/404'] ?? $data['routes'][$locale['langDefault'] . '/404'] ?? null;endif;
/* SEO */
$siteUrl  = ($_SERVER['SERVER_NAME'] !== 'localhost') ? htmlspecialchars($config['siteUrlOnline']) : htmlspecialchars($config['siteUrl']);
$titleSeo = htmlspecialchars($meta['siteName']) . ' - ' . htmlspecialchars($page['seo']['title']);
$canonical = !empty($page['seo']['canonical']) ? $siteUrl . $page['seo']['canonical'] : $siteUrl . $route;
/* ROBOTS.TXT */
if ($route === 'robots.txt') {
    header('Content-Type: text/plain; charset=utf-8');
    $disallow = !empty($page['hideFolder']) ? $page['hideFolder'] : '';
    echo implode("\n", [
        "User-agent: *",
        "Disallow: $disallow",
        "",
        "Sitemap: {$siteUrl}sitemap.xml",
    ]);
    exit;
}
/* SITEMAP.XML */
if ($route === 'sitemap.xml') {
    header('Content-Type: application/xml; charset=utf-8');
    $lastmod = date('Y-m-d', filemtime('admin/data.json'));
    $items = '';
    foreach ($data['routes'] as $slug => $routeData) {
        $priority = $routeData['seo']['priority'] ?? 0.5;
        $items .= "  <url>\n";
        $items .= "    <loc>" . $siteUrl . htmlspecialchars($slug) . "</loc>\n";
        $items .= "    <lastmod>{$lastmod}</lastmod>\n";
        $items .= "    <priority>{$priority}</priority>\n";
        $items .= "  </url>\n";
    }
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
    echo $items;
    echo "</urlset>";
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
/* FIXED CONTENT */
function fixedContent($name) {
    global $config, $lang;
    $name = $name . "_" . $lang;
    if ( empty($config['fixedContent'][$name])) {
        return;
    }
    require_once "Components/".$config["fixedContent"][$name]."/index.php";
    $function = 'render' . $config["fixedContent"][$name];
    $function($config[ $config["fixedContent"][$name] ]);
}
?>
<!DOCTYPE html>
<html lang="<?= $locale['langCode'][$locale['langDefault']] ?? $locale['langDefault'] ?>">
<head>
    <meta charset="<?= $meta['charset'] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titleSeo ?></title>
    <meta name="description" content="<?= htmlspecialchars($page['seo']['description']) ?? htmlspecialchars($meta['description']) ?>">
    <meta name="author" content="<?= htmlspecialchars($meta['author']) ?>">
    <base href="<?= $siteUrl ?>">
    <!-- Open Graph -->
    <?php
    $balisesOgg = '
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="' . $titleSeo. '">
    <meta property="og:title" content="' . $titleSeo. '" />
    <meta property="og:description" content="' . htmlspecialchars($page['seo']['description']) ?? htmlspecialchars($meta['description']) . '" />
    <meta property="og:image" content="' . htmlspecialchars($page['seo']['siteImageShare']) ?? htmlspecialchars($meta['siteImageShare']) . '" />
    <meta property="og:url" content="' . $siteUrl . '" />
    <meta property="og:type" content="website">
    <meta property="og:locale" content="' . $locale['langCode'][$locale['langDefault']] ?? $locale['langDefault'] . '" />
    <meta name="twitter:title" content="' . $titleSeo. '" />
    <meta name="twitter:description" content="' . htmlspecialchars($page['seo']['description']) ?? htmlspecialchars($meta['description']) . '" />
    <meta name="twitter:image" content="' . htmlspecialchars($page['seo']['siteImageShare']) ?? htmlspecialchars($meta['siteImageShare']) . '" />
    <meta name="twitter:url" content="' . $siteUrl . '" />';
    echo $balisesOgg;
    ?>
    <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
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
    <!-- theme -->
    <style>
:root {
<?php foreach ($config['theme'] as $key => $value) : ?>
    --<?= $key ?>: <?= htmlspecialchars($value) ?>;
<?php endforeach; ?>
}
</style>
</head>
<body data-baseurl="<?= $siteUrl ?? "" ?>" class="severin" data-lang="<?= htmlspecialchars($lang) ?>" data-route="<?= htmlspecialchars($route) ?>">
    <?php fixedContent("header") ?>
    <main>
        <?php
        foreach ($page['components'] as $section) {
            $componentName = $section['component'];
            $componentPath = "Components/$componentName/index.php";
            if (file_exists($componentPath)) {
                require_once $componentPath;
                $function = 'render' . $componentName;
                if (is_callable($function)) {
                    $function($section['data']);
                }
            }
        }
        ?>
    </main>
    <aside><?php fixedContent("aside"); ?></aside>
    <?php fixedContent("footer"); ?>
    <?php foreach ($assets['scripts'] as $script) : ?>
    <script src="<?= $script ?>"></script>
    <?php endforeach; ?>
    <script type="module" src="assets/app.js?v=<?= filemtime('assets/app.js') ?>"></script>
</body>

</html>
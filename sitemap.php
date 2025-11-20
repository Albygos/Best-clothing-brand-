<?php
ini_set('memory_limit', '512M');
ini_set('max_execution_time', '300');
ini_set('output_buffering', 'off');

header("Content-Type: application/xml; charset=utf-8");

$domain = "https://best-clothing-brand.onrender.com";
$keywordsFile = __DIR__ . '/keywords.txt';

echo "<?xml version='1.0' encoding='UTF-8'?>\n";
echo "<urlset 
    xmlns='http://www.sitemaps.org/schemas/sitemap/0.9' 
    xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'
    xsi:schemaLocation='http://www.sitemaps.org/schemas/sitemap/0.9 
    http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd'>\n";

$today = date('Y-m-d');

// If keywords.txt doesn't exist → only homepage
if (!file_exists($keywordsFile)) {
    echo "<url><loc>{$domain}</loc><lastmod>{$today}</lastmod></url>\n";
    echo "</urlset>";
    exit;
}

$handle = fopen($keywordsFile, "r");
if ($handle) {
    while (($kw = fgets($handle)) !== false) {
        $kw = trim($kw);
        if ($kw === '') continue;

        // Proper encoding + clean URL formatting
        $encodedKw = urlencode($kw);
        $url = "{$domain}/?q={$encodedKw}";

        echo "  <url>\n";
        echo "    <loc>" . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . "</loc>\n";
        echo "    <lastmod>{$today}</lastmod>\n";
        echo "    <changefreq>weekly</changefreq>\n";
        echo "    <priority>0.8</priority>\n";
        echo "  </url>\n";
    }
    fclose($handle);
}

echo "</urlset>";
?>

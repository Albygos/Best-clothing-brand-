<?php
header("Content-Type: application/xml; charset=UTF-8");
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php
$domain = "https://best-clothing-brand.onrender.com";
$keywordsFile = __DIR__ . '/keywords.txt';
$today = date('Y-m-d');

echo "<url><loc>{$domain}/</loc><lastmod>$today</lastmod><changefreq>daily</changefreq><priority>1.0</priority></url>";

if (file_exists($keywordsFile)) {
    $handle = fopen($keywordsFile, "r");
    while (($kw = fgets($handle)) !== false) {
        $kw = trim($kw);
        if ($kw === '') continue;
        echo "<url><loc>{$domain}/?q=" . urlencode($kw) . "</loc><lastmod>$today</lastmod><changefreq>weekly</changefreq><priority>0.8</priority></url>";
    }
    fclose($handle);
}
?>
</urlset>

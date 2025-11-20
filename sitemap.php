<?php
// 🚨 MUST be the first line (no spaces or blank lines above!)
header("Content-Type: application/xml; charset=UTF-8");
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 
                            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<?php
$domain = "https://best-clothing-brand.onrender.com";
$keywordsFile = __DIR__ . "/keywords.txt";
$today = date("Y-m-d");

// Homepage entry
echo "\n<url>
    <loc>{$domain}/</loc>
    <lastmod>{$today}</lastmod>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
</url>";

// Dynamic keyword URLs
if (file_exists($keywordsFile)) {
    $handle = fopen($keywordsFile, "r");
    while (($kw = fgets($handle)) !== false) {
        $kw = trim($kw);
        if ($kw === '') continue;

        // Clean & encode keyword for XML safety
        $safeKw = htmlspecialchars($kw, ENT_QUOTES, 'UTF-8');
        $url = "{$domain}/?q=" . urlencode($safeKw);

        echo "\n<url>
    <loc>{$url}</loc>
    <lastmod>{$today}</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
</url>";
    }
    fclose($handle);
}
?>
</urlset>

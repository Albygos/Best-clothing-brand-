<?php
// Force XML output header
header("Content-Type: application/xml; charset=UTF-8");

// Start XML declaration (must be first output, no spaces above!)
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 
                            http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd">

<?php
$domain = "https://best-clothing-brand.onrender.com";
$keywordsFile = __DIR__ . '/keywords.txt';
$today = date('Y-m-d');

// Output Homepage Always
echo "<url>
    <loc>{$domain}</loc>
    <lastmod>{$today}</lastmod>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
</url>\n";

// If keyword file does not exist, stop
if (!file_exists($keywordsFile)) {
    echo "</urlset>";
    exit;
}

// Read keywords one by one and generate URLs
$handle = fopen($keywordsFile, "r");
if ($handle) {
    while (($kw = fgets($handle)) !== false) {
        $kw = trim($kw);
        if ($kw === '') continue;

        // Create clean Google-safe URL
        $slug = urlencode($kw);
        $url = "{$domain}/?q={$slug}";

        echo "<url>
    <loc>{$url}</loc>
    <lastmod>{$today}</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
</url>\n";
    }
    fclose($handle);
}
?>

</urlset>

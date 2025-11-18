<?php
ini_set('max_execution_time', '600');
ini_set('memory_limit', '512M');

$keywords = array_map('str_getcsv', file('luxeloom_49999_keywords.csv'));
$headers = array_shift($keywords);

foreach ($keywords as $row) {
    $data = array_combine($headers, $row);

    // Create URL slug
    $slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $data['keyword']), '-'));
    $filename = "pages/{$slug}.php";

    // Load template
    $template = file_get_contents("template.php");

    // Replace placeholders
    foreach ($data as $key => $value) {
        $template = str_replace("{{" . $key . "}}", htmlspecialchars($value), $template);
    }

    // Save page
    file_put_contents($filename, $template);
}

echo "<h3></h3>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{title}} | LuxeLoom Fashion India</title>
    <meta name="description" content="{{description}} Shop premium {{category}} for women in {{location}} with free shipping.">
    <link rel="canonical" href="https://luxeloom.in/{{keyword}}">
    <meta charset="UTF-8">
</head>

<body>

<header>
  <h1>{{title}}</h1>
  <p>{{description}} Explore trending ethnic wear for women in {{location}}.</p>
</header>

<section>
  <h2>Top {{category}} Styles in {{location}}</h2>
  <ul>
    <li>Latest 2025 {{category}} Designs</li>
    <li>Handcrafted Ethnic Wear</li>
    <li>Comfortable Fabrics: Cotton, Rayon, Silk</li>
    <li>Try Before Delivery (COD available)</li>
  </ul>
</section>

<section>
  <h2>People Also Ask</h2>
  <ul>
    <li>Which fabric is best for {{category}} in summer?</li>
    <li>How to style {{keyword}} for weddings?</li>
    <li>Best affordable {{category}} under 999 in {{location}}?</li>
    <li>Which kurti is trending in 2025?</li>
  </ul>
</section>

<section>
  <h2>Buy {{keyword}} Online</h2>
  <p>Shop premium ethnic wear online with LuxeLoom. Free delivery, COD, sizes up to 3XL, easy returns.</p>
</section>

<footer>
  <p>© LuxeLoom India - Ethnic Wear | Delivery in {{location}}</p>
</footer>

</body>
</html>

RewriteEngine On

# 🚫 1) Do NOT force HTTPS - Render already handles it

# 🚫 2) Do NOT redirect "/" or index.php

############################################
# 3️⃣ Allow direct loading of sitemap & robots
############################################
RewriteRule ^sitemap\.xml$ sitemap.xml [L]
RewriteRule ^robots\.txt$ robots.txt [L]

############################################
# 4️⃣ Remove .php from URLs but ONLY if file exists
############################################
RewriteCond %{REQUEST_FILENAME}.php -f
RewriteRule ^(.+?)/?$ $1.php [L]

############################################
# 5️⃣ Block sensitive system folders
############################################
RedirectMatch 403 ^/(config|admin|includes|private|cgi-bin|scripts|vendor)/

############################################
# 6️⃣ Allow Google to load JS, CSS, and Images
############################################
<IfModule mod_headers.c>
  <FilesMatch "\.(css|js|jpg|jpeg|png|gif|svg|webp)$">
    Header set Access-Control-Allow-Origin "*"
  </FilesMatch>
</IfModule>

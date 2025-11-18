RewriteEngine On

####################################
# 1️⃣ Remove HTTPS redirect (Render auto handles)
####################################

####################################
# 2️⃣ Remove trailing slash (Optional)
####################################
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.+)/$ /$1 [L,R=301]

#############################################
# 3️⃣ Redirect sitemap and XML files properly
#############################################
RewriteRule ^sitemap/?$ /sitemap.xml [L,R=301]

#############################################
# 4️⃣ Remove .php extension
#############################################
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^([^\.]+)$ $1.php [NC,L]

#############################################
# 5️⃣ Protect sensitive folders
#############################################
RedirectMatch 403 ^/(config|admin|includes|cgi-bin|scripts)/

#############################################
# 6️⃣ Optional - enable headers if module exists
#############################################
<IfModule mod_headers.c>
    Header set Access-Control-Allow-Origin "*"
</IfModule>

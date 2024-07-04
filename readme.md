If application don't run then make sure to do the following:\
    1. Add and configure **Composer** to work with Xampp's PHP binary, then run "composer dump-autoload && composer run-script init_script"\
    2. PHP 8.2.12   
    3. Most installations have output buffering enabled. If not, then enable it. \
    Optional **Enabling Virtual Host** \
    Step 1: Stop Xampp \
    Step 2: Enable virtual host by modifying **INSTALLATION_DIR/etc/httpd.conf** uncomment the line with the Include under Virtual Host section \
    Step 3: Add the following lines below to your **INSTALLATION_DIR/etc/extra/httpd-vhost.conf** \
    Step 4: Make sure to add 127.0.0.1 prototype.local to your host file. You might need to restart windows. \
    Step 5: Start xampp \
    Step 6: Access prototype.local on your browser

        
```
<VirtualHost *:79>
    # ServerAdmin webmaster@dummy-host1.example.com
    DocumentRoot "/opt/lampp/htdocs/prototype/public/"
    ServerName prototype.local
    # ErrorLog "logs/dummy-host1.example.com-error_log"
    # CustomLog "logs/dummy-host1.example.com-access_log" common
    <Directory "/opt/lampp/htdocs/prototype/public/">
        RewriteEngine On
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteRule ^ /index.php [L]
    </Directory>
</VirtualHost>
```


    

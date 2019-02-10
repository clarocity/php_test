

PHP_TEST APP DIRECTIONS

1. Set up database in 'src/Config'

2. Create 2 tables by runing 'http://<hostname>/Realestate/createproperties' and 'http://<hostname>/Sales/createsales'

Here is the Apache config I used

<VirtualHost *:80>
    ServerAdmin jin91706@yahoo.com
    DocumentRoot "/Users/myname/Sites/james/php_test/public"
    ServerName james.local
    ErrorLog "/var/log/apache2/james.local-error_log"
    CustomLog "/var/log/apache2/james.local-access_log" common
    <Directory "/Users/myname/Sites/james/php_test/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

3. Doc root is php_test/public
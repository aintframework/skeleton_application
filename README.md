aint framework skeleton_application
===================================

Introduction
------------
This is a simple, skeleton application using the aint framework.

Installation Using Git & Composer
---------------------------------
Clone the repository and manually invoke `composer` using the shipped
`composer.phar`:

    cd my/projects/dir
    git clone git://github.com/aintframework/skeleton_application.git
    cd skeleton_application
    php composer.phar self-update
    php composer.phar install

Virtual Host
------------
For development purposes, use the PHP's built-in web server with `dev-router.php` provided:

`php -S localhost:8080 dev-router.php`

Alternatively, there's also `.htaccess` provided for an Apache setup. Point your virtual host configuration
to server to server the `/www` directory as the document root.
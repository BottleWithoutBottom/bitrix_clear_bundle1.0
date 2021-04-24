<?php
/**
 * Чтобы редиректы начали работать
 * RewriteRule ^(.*)ajax-virtual(.*)$ /local/app/Router/bootstrap.php?$1 [QSA,L] - на апаче
 * rewrite ^(.*)ajax-virtual(.*)$ /local/app/Router/bootstrap.php?$1; - на Nginx
 */
require('../vendor/autoload.php');

use App\Router\FastRouter;
$router = FastRouter::getInstance();
$router->handle();

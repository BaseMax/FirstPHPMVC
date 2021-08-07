<?php

use Core\Router;

require __DIR__.'/../vendor/autoload.php';

include __DIR__.'/../app/routes.php';

return Router::dispatch($_SERVER['REQUEST_URI']);

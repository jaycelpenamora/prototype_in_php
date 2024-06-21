<?php 

declare(strict_types=1);

namespace App;

require __DIR__."/../../vendor/autoload.php";

use Framework\App;

$app = new App();

$app->get('/',['App\Controllers\HomeController',''home']);

dd($app);

return $app; 

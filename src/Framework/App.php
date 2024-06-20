<?php

declare(strict_types=1);

namespace Framework;

class App
{

    private Router $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    public function run()
    {
        echo "Running App";
    }

    public function add(string $path)
    {
        $this->router->add($path);
    }

}

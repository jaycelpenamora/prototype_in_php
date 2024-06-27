<?php

declare(strict_types=1);

namespace Framework;

class TemplateEngine
{
    private array $globals = [];
    public function __construct(private string $basePath)
    {
    }
    /**
     * @param array<mixed> $data
     */
    public function render(string $template, array $data = []): mixed
    {
        extract($data, EXTR_SKIP);
        extract($this->globals, EXTR_SKIP);
        ob_start();
        include $this->resolve($template);
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function resolve(string $path): string
    {
        return "{$this->basePath}/{$path}";
    }

    public function addGlobal(string $key, mixed $value): void
    {
        $this->globals[$key] = $value;
    }
}

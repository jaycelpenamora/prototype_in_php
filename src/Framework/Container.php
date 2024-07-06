<?php

declare(strict_types=1);

namespace Framework;

use ReflectionClass, ReflectionNamedType;
use Framework\Exceptions\ContainerException;

class Container
{

    private array $definitions = [];
    private array $resolved = [];

    public function addDefinitions(array $newDefinitions): void
    {
        // Merging definitions with new definitions
        $this->definitions = [...$this->definitions, ...$newDefinitions];
        // dd($this->definitions);
    }

    public function resolve(string $className): mixed
    {
        $reflectionClass = new ReflectionClass($className);

        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerException("Class {$className} is not instantiable");
        }

        $constructor = $reflectionClass->getConstructor();

        if (!$constructor) {
            return new $className;
        }

        $params = $constructor->getParameters();

        if (count($params) === 0) {
            return new $className;
        }

        $dependencies = [];

        foreach ($params as $param) {
            $name = $param->getName();
            $type = $param->getType();

            if (!$type) {
                throw new ContainerException("Failed to resolve class {$className}. Missing type hint for {$name}.");
            }

            if (!$type instanceof ReflectionNamedType || $type->isBuiltin()) {
                throw new ContainerException("Failed to resolve class {$className}. Invalid type hint for param {$name}.");
            }
            $dependencies[] = $this->get($type->getName());
        }
        // dd($dependencies);
        return $reflectionClass->newInstanceArgs($dependencies);
    }

    public function get(string $id): mixed
    {
        if (!array_key_exists($id, $this->definitions)) {
            throw new ContainerException("No such class: {$id}");
        }

        if (array_key_exists($id, $this->resolved)) {
            return $this->resolved[$id];
        }

        $factory = $this->definitions[$id];

        $dependency = $factory();

        $this->resolved[$id] = $dependency;

        return $dependency;
    }
}

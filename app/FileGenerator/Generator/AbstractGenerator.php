<?php

namespace App\FileGenerator\Generator;

use App\FileGenerator\Prototypes\AbstractPrototype;
use App\FileGenerator\Stubs\AbstractStub;
use Illuminate\Filesystem\Filesystem;

class AbstractGenerator implements GeneratorInterface
{
    protected AbstractStub $stub;
    protected AbstractPrototype $prototype;
    protected string $stubString;
    protected $files;

    public function __construct()
    {
        $this->files = new Filesystem();
    }

    public function getStub() {
        return $this->stub;
    }

    public function getStubString(): string
    {
        return $this->stubString;
    }

    public function generate(): bool
    {
        $this->stubString = $this->stub->generateStub();
        return true;
    }

    public function setStub($stub): void
    {
        $this->stub = $stub;
    }

    public function getPrototype()
    {
        return $this->prototype;
    }

    public function setPrototype($prototype): void
    {
        $this->prototype = $prototype;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path): void
    {
        $this->path = $path;
    }
}
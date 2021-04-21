<?php

namespace App\FileGenerator\Generator;

use App\FileGenerator\Prototypes\AbstractPrototype;
use App\FileGenerator\Stubs\AbstractStub;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;

class AbstractGenerator implements GeneratorInterface
{
    protected AbstractStub $stub;
    protected AbstractPrototype $prototype;
    protected string $stubString;
    protected Filesystem $files;
    protected $path;
    protected $fileName;
    protected $ext = '.php';

    public function __construct()
    {
        $this->files = new Filesystem();
    }

    public function placeFile($path, $content): bool
    {
        if (empty($path)) throw new FileNotFoundException('Filename is not correct');

        $this->files->put($path, $content);
        return true;
    }

    public function setFileName(string $fileName): bool
    {
        if (empty($fileName)) return false;

        $this->fileName = $fileName;
        return true;
    }

    public function getFileName()
    {
        return $this->fileName;
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

    public function getFullFilePath()
    {
        if (empty($this->getFileName()) || empty($this->getPath())) return false;

        return $this->getPath() . $this->getFileName() . $this->ext;
    }
}
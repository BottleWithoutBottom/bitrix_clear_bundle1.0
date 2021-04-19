<?php

namespace App\FileGenerator\Generator;

interface GeneratorInterface
{
    /** method generates all the file content */
    public function generate();

    /** method return final file structure */
    public function getStubString();
}
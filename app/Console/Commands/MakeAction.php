<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeAction extends GeneratorCommand
{
    protected $name = 'make:action';

    protected $description = 'Create a new Action class';

    protected $type = 'Action';

    protected function getStub(): string
    {
        return __DIR__.'/stubs/action.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Actions';
    }
}

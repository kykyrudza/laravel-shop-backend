<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeService extends GeneratorCommand
{
    protected $name = 'make:service';

    protected $description = 'Create a new Service class';

    protected $type = 'Service';

    protected function getStub(): string
    {
        return __DIR__.'/stubs/service.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Services';
    }
}

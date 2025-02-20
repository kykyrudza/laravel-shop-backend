<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeRepository extends GeneratorCommand
{
    protected $name = 'make:repository';

    protected $description = 'Create a new Repository class';

    protected $type = 'Repository';

    protected function getStub(): string
    {
        return __DIR__.'/stubs/repository.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Repositories';
    }
}

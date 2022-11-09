<?php

namespace App\Commands;

use Illuminate\Filesystem\Filesystem;
use Surgiie\Console\Command as ConsoleCommand;
use Surgiie\Console\Concerns\LoadsEnvFiles;
use Surgiie\Console\Concerns\LoadsJsonFiles;
use Surgiie\Console\Concerns\WithTransformers;
use Surgiie\Console\Concerns\WithValidation;

class ClearCommand extends ConsoleCommand
{
    use WithValidation, WithTransformers, LoadsJsonFiles, LoadsEnvFiles;

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'clear';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Clear the cached compiled files directory.';

    public function handle()
    {
        $dir = config('app.compiled_path');
        $this->runTask("Clear $dir directory", function () use ($dir) {
            $fs = new Filesystem;

            $fs->deleteDirectory($dir, preserve: true);

            $this->clearTerminalLine();

            return true;
        });
    }
}
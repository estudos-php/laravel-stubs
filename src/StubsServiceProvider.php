<?php

declare(strict_types=1);

namespace JustSteveKing\Stubs;

use Illuminate\Support\ServiceProvider;
use JustSteveKing\Stubs\Console\Commands\StubsPublishCommand;

class StubsServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands(
                commands: [StubsPublishCommand::class],
            );
        }
    }
}

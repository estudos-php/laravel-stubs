<?php

declare(strict_types=1);

namespace JustSteveKing\Stubs\Test;

use Illuminate\Foundation\Application;
use JustSteveKing\Stubs\StubsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    /**
     * @param Application $app
     * @return array<int,class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [
            StubsServiceProvider::class,
        ];
    }
}

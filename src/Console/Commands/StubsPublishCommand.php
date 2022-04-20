<?php

declare(strict_types=1);

namespace JustSteveKing\Stubs\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Finder\SplFileInfo;

class StubsPublishCommand extends Command
{
    use ConfirmableTrait;

    /**
     * @var string
     */
    protected $signature = 'publish:stubs {--force : Overwrite any existing pubilshed stubs}';

    /**
     * @var string
     */
    protected $description = 'Publish all of the opinionated stubs that are available.';

    public function handle(Filesystem $filesystem): int
    {
        if (! $this->confirmToProceed()) {
            $this->output->warning(
                message: 'Cannot publish stubs without a confirmation.',
            );

            return BaseCommand::FAILURE;
        }

        if (! is_dir($stubsPath = $this->laravel->basePath(path: 'stubs'))) {
            $filesystem->makeDirectory(
                path: $stubsPath,
            );
        }

        $stubs = collect(File::files(
            directory: __DIR__ . '/../../../stubs',
        ))->unless(
            value: $this->option(
                key: 'force',
            ),
            callback: fn (Collection $files): Collection => $this->unpublished(
                files: $files,
            ),
        );

        $published = $this->publish(
            files: $stubs,
        );

        $this->output->success(
            message: "Published {$published} / {$stubs->count()} stubs.",
        );

        return BaseCommand::SUCCESS;
    }

    public function unpublished(Collection $files): Collection
    {
        return $files->reject(
            callback: function (SplFileInfo $file) {
                return file_exists(filename: $this->targetPath(file: $file));
            },
        );
    }

    /**
     * @param Collection $files
     * @return int
     */
    public function publish(Collection $files): int
    {
        return $files->reduce(
            callback: function (int $published, SplFileInfo $file) {
                file_put_contents(
                    filename: $this->targetPath(file: $file),
                    data: file_get_contents(filename: $file->getPathname()),
                );

                return $published + 1;
            },
            initial: 0,
        );
    }

    /**
     * @param SplFileInfo $file
     * @return string
     */
    public function targetPath(SplFileInfo $file): string
    {
        return "{$this->laravel->basePath('stubs')}/{$file->getFilename()}";
    }
}

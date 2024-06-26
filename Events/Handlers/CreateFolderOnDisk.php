<?php

namespace Modules\Media\Events\Handlers;

use Illuminate\Contracts\Filesystem\Factory;
use Modules\Media\Events\FolderWasCreated;

class CreateFolderOnDisk
{
    /**
     * @var Factory
     */
    private $filesystem;

    public function __construct(Factory $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function handle(FolderWasCreated $event)
    {
        $disk = is_null($event->folder->disk) ? $this->getConfiguredFilesystem() : $event->folder->disk;

        $organizationPrefix = mediaOrganizationPrefix($event->folder, '/');

        $this->filesystem->disk($disk)->makeDirectory(($organizationPrefix).$this->getDestinationPath($event->folder->path->getRelativeUrl()));
    }

    private function getDestinationPath($path)
    {
        if ($this->getConfiguredFilesystem() === 'local') {
            return basename(public_path()).$path;
        }

        return $path;
    }

    private function getConfiguredFilesystem(): string
    {
        return setting('media::filesystem', null, config('asgard.media.config.filesystem'));
    }
}

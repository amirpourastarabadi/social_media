<?php

namespace App\Utilities\FileSystem;

use App\Utilities\FileSystem\Components\GarbageCollectorTrait;
use App\Utilities\FileSystem\Components\InspectorTrait;
use App\Utilities\FileSystem\Components\UploaderTrait;
use Symfony\Component\HttpFoundation\File\File;

class FileSystem
{
    use UploaderTrait;
    use InspectorTrait;
    use GarbageCollectorTrait;

    private null|File $uploadingFile = null;

    private null|string $disk = null;

    private string $folder = '';

    private string $filePath = '';
}

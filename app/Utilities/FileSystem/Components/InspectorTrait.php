<?php

namespace App\Utilities\FileSystem\Components;

use Illuminate\Support\Facades\Storage;

trait InspectorTrait
{
    public function isExists(string $path)
    {
        $this->filePath = $path;
        
        return $this;
    }

    public function in(string $disk)
    {
        $this->disk = $disk;

        return $this;
    }

    public function inspect()
    {
        return Storage::disk($this->disk)->exists($this->filePath);
    }
}
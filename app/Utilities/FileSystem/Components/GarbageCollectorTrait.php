<?php

namespace App\Utilities\FileSystem\Components;

use Illuminate\Support\Facades\Storage;

trait GarbageCollectorTrait
{
    public function deleteFile(string $path)
    {
        Storage::disk($this->disk)->delete($path);
    }
    
    public function from(string $disk)
    {
        $this->disk = $disk;
        
        return $this;
    }
}
<?php

namespace App\Utilities\FileSystem;

use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Upload
{
    private null|File $uploadingFile = null;

    private null|string $disk = null;

    private string $folder = '';

    public function uploadFile(File $file)
    {
        $this->uploadingFile = $file;

        return $this;
    }

    public function to(string $disk)
    {
        $this->disk = $disk;

        return $this;
    }

    public function organizeByDate()
    {
        $this->folder = now()->toDateString();

        return $this;
    }

    public function save()
    {
        $fileName = $this->generateFileName();

        Storage::disk($this->disk)->putFileAs($this->folder, $this->uploadingFile, $fileName);  
        
        return $fileName;
    }

    private function generateFileName()
    {
        $prefix = Str::random(5);
        $timestamp = now()->timestamp;
        $extension = $this->uploadingFile->getClientOriginalExtension();

        return $prefix . '_' . $timestamp . '.' . $extension;
    }
}

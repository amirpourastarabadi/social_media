<?php

namespace App\Utilities\FileSystem\Components;

use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploaderTrait
{
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

    public function organizeByDate()
    {
        $this->folder = now()->toDateString();

        return $this;
    }

}
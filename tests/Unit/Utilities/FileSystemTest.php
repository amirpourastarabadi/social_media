<?php

namespace Tests\Unit\Utilities;

use App\Utilities\FileSystem\FileSystem;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileSystemTest extends TestCase
{
    private FileSystem $fileSystem;
    private string $filename = '';

    public function setUp(): void
    {
        parent::setUp();

        $this->fileSystem = resolve(FileSystem::class);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        if ($this->filename) {
            $this->fileSystem->from('test')->deleteFile($this->filename);
        }
    }

    public function test_file_upload_in_correct_place(): void
    {
        $file = UploadedFile::fake()->image('test.jpg');

        $this->filename = $this->fileSystem->uploadFile($file)->to('test')->save();

        $this->assertTrue($this->fileSystem->isExists($this->filename)->in('test')->inspect());
    }
}

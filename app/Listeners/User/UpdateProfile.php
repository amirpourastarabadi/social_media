<?php

namespace App\Listeners\User;


use Symfony\Component\HttpFoundation\File\File;
use App\Utilities\FileSystem\Upload;

class UpdateProfile
{
    /**
     * Create the event listener.
     */
    public function __construct(private Upload $fileUploader)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $profileData = $event->getProfileData();

        if (isset($profileData['image'])) {
            $profileData['image'] = $this->uploadProfileImage($profileData['image']);
        }

        $event->user->profile->update($profileData);
    }

    private function uploadProfileImage(File $image): string
    {
        return $this->fileUploader->uploadFile($image)->to('user_profiles')->organizeByDate()->save();
    }
}

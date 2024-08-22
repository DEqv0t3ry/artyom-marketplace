<?php

namespace App\Services;

use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoService
{
    public function deletePhoto(Photo $photo)
    {
        Storage::disk('public')->delete($photo->photo);
        return $photo->delete();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function delete(Photo $photo)
    {
        Storage::disk('public')->delete($photo->photo);

        $photo->delete();
    }
}

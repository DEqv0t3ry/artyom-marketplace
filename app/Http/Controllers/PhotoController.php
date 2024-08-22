<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Services\PhotoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function __construct(
        private readonly PhotoService $photoService,
    ){}
    public function delete(Photo $photo)
    {
        return $this->photoService->deletePhoto($photo);
    }
}

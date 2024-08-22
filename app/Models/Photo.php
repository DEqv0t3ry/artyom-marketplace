<?php

namespace App\Models;

use App\Enums\DefaultImagesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'photo',
        'product_id',
    ];

    public function getPhotoUrl()
    {
        if ($this->photo) {
            return url('storage/' . $this->photo);
        }

        return url(DefaultImagesEnum::PRODUCT_PHOTO->value);
    }
}

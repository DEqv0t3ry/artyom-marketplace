<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'price',
        'unit',
        'short_description',
        'photo',
        'main_description',
    ];

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }
}

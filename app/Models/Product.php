<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'unit_id',
        'user_id',
        'short_description',
        'photo',
        'main_description',
        'on_sale'
    ];

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function orders():HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getThumbnailUrl()
    {
        if ($this->photo) {
            return url('storage/' . $this->photo);
        }
    }
}

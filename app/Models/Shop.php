<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'inn',
        'address',
        'phone',
        'logo',
        'user_id',
    ];
    public function getLogoUrl()
    {
        if ($this->logo) {
            return url('storage/' . $this->logo);
        }
    }
}

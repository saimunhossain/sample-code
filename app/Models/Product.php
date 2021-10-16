<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function families()
    {
        return $this->belongsToMany(Family::class)->withTimestamps();
    }

    public function festivals()
    {
        return $this->belongsToMany(Festival::class)->withTimestamps();
    }

    public function others()
    {
        return $this->belongsToMany(Other::class)->withTimestamps();
    }
    public function personalization()
    {
        return $this->hasMany(Personalization::class);
    }

}

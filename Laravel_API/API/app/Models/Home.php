<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;

    protected $fillable = ['home_location', 'owner'];

    public function floors()
    {
        return $this->hasMany(Floor::class);
    }
}

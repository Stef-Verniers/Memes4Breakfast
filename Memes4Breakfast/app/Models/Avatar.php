<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'is_premium',
        'is_exclusive',
        'is_admin'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

}

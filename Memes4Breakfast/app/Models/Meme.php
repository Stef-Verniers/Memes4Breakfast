<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meme extends Model
{
    use HasFactory;
    protected $fillable = ['caption', 'meme', 'user_id'];

    // declare many-to-one-relationship
    public function user() {
        return $this->belongsTo(User::class);
    }
}

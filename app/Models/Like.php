<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    public function gangas() {
        return $this->belongsTo(Ganga::class,'ganga_id');
    }

    public function users() {
        return $this->belongsTo(User::class,'user_id');
    }

}

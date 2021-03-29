<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function profileImage() 
    {
        $imagePath = ($this->image) ? $this->image : "profile/Vf60Mt43gy3CsIHxEreOSOSfnXRniOjUK40EGXHg.png";
        return "/storage/" . $imagePath;
    }

    public function followers() 
    {
        return $this->belongsToMany(User::class);
    }

    /**
     *  To establish connection to User model
     *  belongsTo( related, foreginkey, owerKey, ...)
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}

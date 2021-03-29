<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   use HasFactory;

   // to overcome fillable property : MassAssignment issue
   protected $guarded = [];

   /**
   *  To establish connection to User model
   *  
   */
   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function comments()
   {
      return $this->hasMany(Comment::class)->latest();
   }

   public function likes()
   {
      return $this->belongsToMany(Like::class);
   }

}

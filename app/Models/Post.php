<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = ['subject','content','user_id'];
    
    

    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function is_liked_by_user(){
        return $this->likes()->where('user_id',auth()->id())->exists();
    }


    public function likedUsers()
        {
            return $this->belongsToMany(User::class, 'likes');
        }

        public function toSearchableArray(){
            return [
                'subject' => $this->subject,
                'content' => $this->content
            ];
        }
}

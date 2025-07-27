<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model {

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function likes(){
        return $this->morphMany(Like::class, 'likeable');
    }

    public function views(){
        return $this->morphMany(View::class, 'viewable');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Post extends Model
{
    use HasFactory;

    // solve mass assignment
    protected $fillable =[
        'title',
        'description',
        'user_id'
    ];

    public function user()
    {
        // elequant relationship -> populating in node.js
        return $this->belongsTo(User::class);
    }
    // polymorphic relationship
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}

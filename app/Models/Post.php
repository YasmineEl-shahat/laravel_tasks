<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

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

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}

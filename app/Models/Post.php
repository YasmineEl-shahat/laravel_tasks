<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\File;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    // solve mass assignment
    protected $fillable =[
        'title',
        'description',
        'user_id',
        'image'
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
    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $destination_path = public_path('/uploads/posts');
        $profileImage = $value;
        $profileImageSaveAsName = time() . "-{$attribute_name}." . $profileImage->getClientOriginalExtension();
        $profile_image_url = $destination_path . $profileImageSaveAsName;
        $profileImage->move($destination_path, $profileImageSaveAsName);

        $this->attributes[$attribute_name] = $profileImageSaveAsName;
        return $profileImageSaveAsName;
    }
    public function setUpdatedImageAttribute($value)
    {
        if ($value) {
            // delete old image
            $this->deleteImage();

            $name = $this->setImageAttribute($value);
            return $name;
        }
    }
    public function deleteImage()
    {
        if ($this->image) {
            $imagePath = "uploads/posts/". $this->image;
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }
    }
}

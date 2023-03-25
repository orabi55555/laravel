<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Tags\HasTags;
class Post extends Model
{
    use HasFactory;
    use Sluggable;
    use HasTags;
    protected $fillable=[
        'title',
        'description',
        'user_id',
        'image',
        
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments() {
        return $this->morphMany(Comment::class,'commentable');
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
    protected function image():Attribute{
        return Attribute::make(
            get:fn ($value)=>asset("storage/".$value)
        );
    }
}

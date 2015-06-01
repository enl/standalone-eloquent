<?php


namespace Enl\HelloBlog\Entity;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Illuminate\ArtificialLegs\Eloquent\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model implements SluggableInterface
{
    use SoftDeletes, SluggableTrait;

    protected $dates = ['deleted_at'];

    protected $table = 'posts';

    protected $sluggable = ['build_from' => 'title', 'save_to' => 'slug', 'unique' => true, ];

    protected $fillable = ['text', 'title'];

    public function comments() {
        return $this->hasMany('Enl\HelloBlog\Entity\Comment');
    }
}

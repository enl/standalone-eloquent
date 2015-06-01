<?php


namespace Enl\HelloBlog\Entity;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    public $timestamps = false;

    public function posts()
    {
        return $this->hasMany('Enl\HelloBlog\Entity\Post');
    }

    public function comments()
    {
        return $this->hasMany('Enl\HelloBlog\Entity\Comment');
    }

    public function setPasswordAttribute($value)
    {
        return md5($value);
    }
}

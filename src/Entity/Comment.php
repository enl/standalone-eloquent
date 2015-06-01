<?php


namespace Enl\HelloBlog\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $table = 'comments';

    protected $dates = ['deleted_at'];

    public function post() {
        return $this->belongsTo('Enl\HelloBlog\Entity\Post');
    }

    public function author() {
        return $this->belongsTo('Enl\HelloBlog\Entity\User');
    }
}

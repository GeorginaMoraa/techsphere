<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'is_active',
        'created_at',
        'updated_at',
        'image'
    ];
    //
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

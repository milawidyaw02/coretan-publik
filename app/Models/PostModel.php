<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    //
    protected $primary_key = 'id';
    protected $table = 'trs_posts';
    protected $fillable = [
        'id_user',
        'judul',
        'content',
        'filepath',
        'user_id',
        'post_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function views()
    {
        return $this->hasMany(PostView::class, 'post_id');
    }
}

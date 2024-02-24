<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = [
        'name',
        'content',
        'created_at',
        'active',
        'metaKey',
        'metaDescription',
        'active',
        'url',
        'user_id'
    ];
    public $timestamps = false;
    protected $casts = ['created_at'=>'datetime:Y-m-d H:i:s+00:00'];

    public function user(){
        return $this->belongsTo("App/Models/User");
    }
}

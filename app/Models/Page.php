<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = 'pages';

    protected $fillable = [
        'name',
        'content',
        'metaKey',
        'metaDescription',
        'created_at',
        'url',
        'active',
        'home',
        'user_id'
    ];

    public $timestamps = false;
    protected $casts = ['created_at'=>'datetime:Y-m-d H:i:s+00:00'];

    public function user(){
        return $this->belongsTo("App/Models/User");
    }
}

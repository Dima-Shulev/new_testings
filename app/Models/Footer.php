<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $table = 'footers';

    protected $fillable = [
        'link',
        'content',
        'metaKey',
        'metaDescription',
        'created_at',
        'position',
        'url',
        'active',
        'user_id'
    ];

    public $timestamps = false;
    protected $casts = ['created_at'=>'datetime:Y-m-d H:i:s+00:00'];

    public function user(){
        return $this->belongsTo("App/Models/User");
    }
}

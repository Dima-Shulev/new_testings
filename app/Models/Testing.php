<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testing extends Model
{
    use HasFactory;

    public $table = 'testings';
    public $fillable = [
        'name_test',
        'content',
        'passing_score',
        'metaKey',
        'metaDescription',
        'time',
        'created_at',
        'active',
        'categories_id',
        'user_id'
        ];

    public $timestamps = false;

    public function users(){
        return $this->hasOne('App/Models/User');
    }

    public function question(){
        return $this->hasMany('App/Models/Question');
    }
}

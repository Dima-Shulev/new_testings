<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'title',
        'metaKey',
        'metaDescription',
        'trueAnswers',
        'falseAnswers',
        'allAnswers',
        'description',
        'testing_id'
    ];

    public $timestamps = false;

    public function testing(){
        return $this->hasOne('App/Models/Testing');
    }
}

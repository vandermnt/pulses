<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionModel extends Model {

    protected $table = 'question';
    protected $primaryKey = 'id';
    public $timestamps = false;
}

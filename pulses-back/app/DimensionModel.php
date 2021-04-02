<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DimensionModel extends Model {

    protected $table = 'dimension';
    protected $primaryKey = 'id';
    public $timestamps = false;
}

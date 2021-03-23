<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $table = "classification";
    public $timestamps = true;
    protected $primaryKey = "classification_id";
    protected $guarded = [];
}

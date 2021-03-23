<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    protected $table = "commodity";
    public $timestamps = true;
    protected $primaryKey = "commodity_id";
    protected $guarded = [];
}

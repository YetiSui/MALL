<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = "store";
    public $timestamps = true;
    protected $primaryKey = "store_id";
    protected $guarded = [];
}

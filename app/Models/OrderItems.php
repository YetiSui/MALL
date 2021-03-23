<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $table = "orderitems";
    public $timestamps = true;
    protected $primaryKey = "orderitems_id";
    protected $guarded = [];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    protected $table = "coupons";
    public $timestamps = true;
    protected $primaryKey = "coupons_id";
    protected $guarded = [];
}

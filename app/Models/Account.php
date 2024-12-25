<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'account';
    protected $primaryKey = 'account';
    public $incrementing = false;
    protected $keyType = 'string';
}

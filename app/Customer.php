<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = array(
        'id',
        'name',
        'email',
        'phone',
        'photo',
    );
}

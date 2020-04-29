<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usermeta extends Model
{
    protected $table = "usermetas";

    protected $fillable = [
        'user_id', 'designation_id',
    ];
}

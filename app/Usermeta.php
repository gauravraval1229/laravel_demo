<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usermeta extends Model
{
    protected $table = "usermetas";

    protected $fillable = [
        'user_id', 'designation_id', 'status',
    ];

    public function designation(){
        return $this->belongsTo(Designation::class,'designation_id')->select('id','designation_name');   
    }
}

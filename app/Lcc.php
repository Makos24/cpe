<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lcc extends Model
{
    protected $table = 'lccs';
    protected $guarded = ['id'];

    public function users()
    {
        $this->hasMany('App\User', 'lcc_id');
    }
}

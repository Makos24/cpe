<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
    protected $guarded = ['id'];

    public function users()
    {
        $this->hasMany('App\User', 'group_id');
    }

}


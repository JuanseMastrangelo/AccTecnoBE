<?php

namespace ArgentinaBE;

use Illuminate\Database\Eloquent\Model;

class ArgentinaBE extends Model
{
    protected $table = 'users';
    protected $fillable = array('userId', 'urlFile');
}

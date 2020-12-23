<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComprasModel extends Model
{
    use HasFactory;
    protected $table = 'buys';
    protected $fillable = [ 'status', 'userData', 'items', 'collectorId' ];
}

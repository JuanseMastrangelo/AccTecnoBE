<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [ 'id', 'title', 'description', 'count', 'purchaseValue', 'saleValue', 'categorieId', 'subCategorieId', 'high', 'width', 'colour', 'warranty', 'model', 'weight', 'RAM', 'files' ];
}

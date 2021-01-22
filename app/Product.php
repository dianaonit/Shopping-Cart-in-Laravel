<?php

namespace App;
use HasFactory;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['imagePath','title','description','price'];
}

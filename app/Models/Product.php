<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ["id","manufacturer_id","name","price","quantity","image","description"];
    public  function manufacturers()
    {
        return $this->belongsTo(Manufacturers::class);
    }
}

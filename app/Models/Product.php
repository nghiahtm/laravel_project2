<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ["id","manufacturer_id","name","selling_price","image",
        "ram","display","processor","original_price","display","storage"];
    public  function manufacturers()
    {
        return $this->belongsTo(Manufacturers::class);
    }
}

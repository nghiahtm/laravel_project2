<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturers extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected  $fillable = ["id",'name','web_image'];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

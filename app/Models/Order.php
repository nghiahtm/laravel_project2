<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ["full_name","phone_number","products_cart","address","status_orders","created_at","updated_at","id_user"];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

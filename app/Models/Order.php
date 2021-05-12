<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restautant;

class Order extends Model
{
    use HasFactory;
    protected $guraded = [];
    protected $fillable = ['resto_id', 'user_id', 'amount'];

    protected $casts = [
        'order_details' => 'array',
    ];

    public function restaurant(){
        return $this->belongsTo(Restaurant::class, 'resto_id');
    }
}

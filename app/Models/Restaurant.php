<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['slug', 'ordersSlug'];

    public function owner(){
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function orders(){
        return $this->hasMany(Order::class,'resto_id'); 
    }

    public function getSlugAttribute(){
        return route('restos.menu', $this->id);
    }

    public function getOrdersSlugAttribute(){
        return route('restos.orders', $this->id);
    }
}

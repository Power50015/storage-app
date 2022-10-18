<?php

namespace App\Models\Product;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestructibleGoodsAction extends Model
{
    use HasFactory;
    protected $guarded = [];
     /**
     * Get the users for the DestructibleGoods.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the users for the DestructibleGoods.
     */
    public function destructible_goods()
    {
        return $this->belongsTo(DestructibleGoods::class);
    }
}

<?php

namespace App\Models\Product;

use App\Models\User;
use App\Models\Warehouse\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestructibleGoods extends Model
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
     * Get the product for the DestructibleGoods.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the product for the DestructibleGoods.
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
     /**
     * Get the DestructibleGoodsAction for the DestructibleGoods.
     */
    public function destructible_goods_action()
    {
        return $this->hasMany(DestructibleGoodsAction::class);
    }
}

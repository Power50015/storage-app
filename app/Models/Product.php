<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the category for the Product.
     */
    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    /**
     * Get the type for the Product.
     */
    public function product_type()
    {
        return $this->belongsTo(ProductType::class);
    }

    /**
     * Get the brand for the Product.
     */
    public function product_brand()
    {
        return $this->belongsTo(ProductBrand::class);
    }

    /**
     * Get the collection for the Product.
     */
    public function product_collection()
    {
        return $this->belongsTo(ProductCollection::class);
    }

    /**
     * Get the model for the Product.
     */
    public function product_model()
    {
        return $this->belongsTo(ProductModel::class);
    }

    /**
     * Get the color for the Product.
     */
    public function product_color()
    {
        return $this->belongsTo(ProductColor::class);
    }

    /**
     * Get the material for the Product.
     */
    public function product_material()
    {
        return $this->belongsTo(ProductMaterial::class);
    }

    /**
     * Get the country for the Product.
     */
    public function product_country()
    {
        return $this->belongsTo(ProductCountry::class);
    }

    /**
     * Get the users for the Product.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the IncomingInvoiceContent for the Product.
     */
    public function incoming_invoice_contents()
    {
        return $this->hasMany(IncomingInvoiceContent::class);
    }

    /**
     * Get the OutgoingInvoiceContent for the Product.
     */
    public function outgoing_invoice_contents()
    {
        return $this->hasMany(OutgoingInvoiceContent::class);
    }

    /**
     * Get the WarehouseStockContent for the Product.
     */
    public function warehouse_stock_contents()
    {
        return $this->hasMany(WarehouseStockContent::class);
    }

    /**
     * Get the TransferContent for the Product.
     */
    public function transfer_contents()
    {
        return $this->hasMany(TransferContent::class);
    }

    /**
     * Get the kit for the product.
     */
    public function kits()
    {
        return $this->hasMany(Kit::class);
    }

    /**
     * Get the Total Number Product.
     */
    public function totalNumberOfProduct()
    {
        //
    }
    /**
     * Get the Total Number Product.
     */
    public function totalNumberOfProductWarehouse($warehouse)
    {
        //
    }

    protected $appends = ['readable_created_at'];


    public function getReadableCreatedAtAttribute()
    {
        return $this->user; //or however you want to manipulate it
    }
}

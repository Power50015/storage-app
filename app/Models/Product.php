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
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category');
    }

    /**
     * Get the type for the Product.
     */
    public function type()
    {
        return $this->belongsTo(ProductType::class, 'type');
    }

    /**
     * Get the brand for the Product.
     */
    public function brand()
    {
        return $this->belongsTo(ProductBrand::class, 'brand');
    }

    /**
     * Get the collection for the Product.
     */
    public function collection()
    {
        return $this->belongsTo(ProductCollection::class, 'collection');
    }

    /**
     * Get the model for the Product.
     */
    public function model()
    {
        return $this->belongsTo(ProductModel::class, 'model');
    }

    /**
     * Get the color for the Product.
     */
    public function color()
    {
        return $this->belongsTo(ProductColor::class, 'color');
    }

    /**
     * Get the material for the Product.
     */
    public function material()
    {
        return $this->belongsTo(ProductMaterial::class, 'material');
    }

    /**
     * Get the country for the Product.
     */
    public function country()
    {
        return $this->belongsTo(ProductCountry::class, 'country');
    }

    /**
     * Get the users for the Product.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user');
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
}

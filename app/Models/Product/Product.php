<?php

namespace App\Models\Product;

use App\Models\Kit\Kit;
use App\Models\OutgoingInvoice\OutgoingInvoiceContent;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoiceContent;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoiceContent;
use App\Models\Transfer\TransferContent;
use App\Models\User;
use App\Models\Warehouse\WarehouseStockContent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['total_sales'];
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
     * Get the IncomingInvoiceContent for the user.
     */
    public function incoming_invoice_contents()
    {
        return $this->hasMany(IncomingInvoiceContent::class);
    }
    /**
     * Get the ReturnedOutgoingInvoice for the user.
     */
    public function returned_outgoing_invoices()
    {
        return $this->hasMany(ReturnedOutgoingInvoiceContent::class);
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
     * Get the ProductNote for the product.
     */
    public function product_notes()
    {
        return $this->hasMany(ProductNote::class);
    }

    /**
     * Get the ProductImage for the product.
     */
    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get the ProductAttachment for the product.
     */
    public function product_attachments()
    {
        return $this->hasMany(ProductAttachment::class);
    }
    /**
     * Get the ReturnedIncomingInvoiceContent for the IncomingInvoice.
     */
    public function returned_incoming_invoice_contents()
    {
        return $this->hasMany(ReturnedIncomingInvoiceContent::class);
    }

    /**
     * Get the totla sales Number Product.
     */
    public function getTotalSalesAttribute()
    {
        return (OutgoingInvoiceContent::where('product_id', $this->id)->sum('quantity') - ReturnedOutgoingInvoiceContent::where('product_id', $this->id)->sum('quantity'));
        return 0;
    }
}

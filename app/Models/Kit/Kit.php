<?php

namespace App\Models\Kit;

use App\Models\IncomingInvoice\IncomingInvoiceKit;
use App\Models\Product\Product;
use App\Models\IncomingInvoice\ReturnedIncomingInvoiceKit;
use App\Models\OutgoingInvoice\OutgoingInvoiceKit;
use App\Models\OutgoingInvoice\ReturnedOutgoingInvoiceKit;
use App\Models\Product\ProductBrand;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductCollection;
use App\Models\Product\ProductColor;
use App\Models\Product\ProductCountry;
use App\Models\Product\ProductMaterial;
use App\Models\Product\ProductModel;
use App\Models\Product\ProductType;
use App\Models\Transfer\TransferKit;
use App\Models\User;
use App\Models\Warehouse\KitStock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the users for the Kit.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the Products for the Kit.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the kitAttachment for the Kit.
     */
    public function kit_attachments()
    {
        return $this->hasMany(KitAttachment::class);
    }

    /**
     * Get the KitOperation for the kit.
     */
    public function kit_stocks()
    {
        return $this->hasMany(KitStock::class);
    }

    /**
     * Get the KitOperation for the kit.
     */
    public function kit_operations()
    {
        return $this->hasMany(KitOperation::class);
    }
    /**
     * Get the KitImage for the kit.
     */
    public function kit_images()
    {
        return $this->hasMany(KitImage::class);
    }
    /**
     * Get the KitNote for the kit.
     */
    public function kit_notes()
    {
        return $this->hasMany(KitNote::class);
    }
    /**
     * Get the Transfer To for the Transfer Kit.
     */
    public function transfer_kits()
    {
        return $this->hasMany(TransferKit::class);
    }
    /**
     * Get the IncomingInvoiceKit for the IncomingInvoice.
     */
    public function incoming_invoice_kits()
    {
        return $this->hasMany(IncomingInvoiceKit::class);
    }
    /**
     * Get the OutgoingInvoiceKit for the OutgoingInvoice.
    **/
    public function outgoing_invoice_kits()
    {
        return $this->hasMany(OutgoingInvoiceKit::class);
    }
    /**
     * Get the ReturnedIncomingInvoiceKit for the user.
     */
    public function returned_incoming_invoice_kits()
    {
        return $this->hasMany(ReturnedIncomingInvoiceKit::class);
    }
    /**
     * Get the ReturnedIncomingInvoiceKit for the user.
     */
    public function returned_outgoing_invoice_kits()
    {
        return $this->hasMany(ReturnedOutgoingInvoiceKit::class);
    }

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
}

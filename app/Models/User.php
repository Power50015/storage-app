<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    /**
     * Get the cash for the user.
     */
    public function cashs()
    {
        return $this->hasMany(Cash::class);
    }
    /**
     * Get the expense for the user.
     */
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
    /**
     * Get the IncomingInvoice for the user.
     */
    public function incoming_invoices()
    {
        return $this->hasMany(IncomingInvoice::class);
    }
    /**
     * Get the IncomingInvoiceAttachment for the user.
     */
    public function incoming_invoice_attachments()
    {
        return $this->hasMany(IncomingInvoiceAttachment::class);
    }
    /**
     * Get the IncomingInvoiceContent for the user.
     */
    public function incoming_invoice_contents()
    {
        return $this->hasMany(IncomingInvoiceContent::class);
    }
    /**
     * Get the OutgoingInvoice for the user.
     */
    public function outgoing_invoices()
    {
        return $this->hasMany(OutgoingInvoice::class);
    }
    /**
     * Get the OutgoingInvoiceAttachment for the user.
     */
    public function outgoing_invoice_attachments()
    {
        return $this->hasMany(OutgoingInvoiceAttachment::class);
    }
    /**
     * Get the OutgoingInvoiceContent for the user.
     */
    public function outgoing_invoice_contents()
    {
        return $this->hasMany(OutgoingInvoiceContent::class);
    }
    /**
     * Get the People for the user.
     */
    public function peoples()
    {
        return $this->hasMany(People::class);
    }
    /**
     * Get the Product for the user.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    /**
     * Get the ProductBrand for the user.
     */
    public function product_brands()
    {
        return $this->hasMany(ProductBrand::class);
    }
    /**
     * Get the ProductCategory for the user.
     */
    public function product_categorys()
    {
        return $this->hasMany(ProductCategory::class);
    }
    /**
     * Get the ProductCollection for the user.
     */
    public function product_collections()
    {
        return $this->hasMany(ProductCollection::class);
    }
    /**
     * Get the ProductColor for the user.
     */
    public function product_colors()
    {
        return $this->hasMany(ProductColor::class);
    }
    /**
     * Get the ProductCountry for the user.
     */
    public function product_countrys()
    {
        return $this->hasMany(ProductCountry::class);
    }
    /**
     * Get the ProductMaterial for the user.
     */
    public function product_materials()
    {
        return $this->hasMany(ProductMaterial::class);
    }
    /**
     * Get the ProductModel for the user.
     */
    public function product_models()
    {
        return $this->hasMany(ProductModel::class);
    }
    /**
     * Get the ProductType for the user.
     */
    public function product_types()
    {
        return $this->hasMany(ProductType::class);
    }
    /**
     * Get the Warehouse for the user.
     */
    public function warehouses()
    {
        return $this->hasMany(Warehouse::class);
    }
    /**
     * Get the WarehouseStock for the user.
     */
    public function warehouse_stocks()
    {
        return $this->hasMany(WarehouseStock::class);
    }
    /**
     * Get the WarehouseStockAttachment for the user.
     */
    public function warehouse_stock_attachments()
    {
        return $this->hasMany(WarehouseStockAttachment::class);
    }
    /**
     * Get the WarehouseStockContent for the user.
     */
    public function warehouse_stock_contents()
    {
        return $this->hasMany(WarehouseStockContent::class);
    }

    /**
     * Get the Debtor for the user.
     */
    public function debtors()
    {
        return $this->hasMany(Debtor::class);
    }
    /**
     * Get the DebtorAttachment for the user.
     */
    public function debtor_attachments()
    {
        return $this->hasMany(DebtorAttachment::class);
    }
    /**
     * Get the DebtorPay for the user.
     */
    public function debtor_pays()
    {
        return $this->hasMany(DebtorPay::class);
    }
    /**
     * Get the DebtorPayAttachment for the user.
     */
    public function debtor_pay_attachments()
    {
        return $this->hasMany(DebtorPayAttachment::class);
    }
     /**
     * Get the Creditor for the user.
     */
    public function creditors()
    {
        return $this->hasMany(Creditor::class);
    }
    /**
     * Get the CreditorAttachment for the user.
     */
    public function creditor_attachments()
    {
        return $this->hasMany(CreditorAttachment::class);
    }
    /**
     * Get the CreditorPay for the user.
     */
    public function creditor_pays()
    {
        return $this->hasMany(CreditorPay::class);
    }
    /**
     * Get the CreditorPayAttachment for the user.
     */
    public function creditor_pay_attachments()
    {
        return $this->hasMany(CreditorPayAttachment::class);
    }
    /**
     * Get the kit for the user.
     */
    public function kits()
    {
        return $this->hasMany(Kit::class);
    }
    /**
     * Get the KitAttachment for the user.
     */
    public function kit_attachments()
    {
        return $this->hasMany(KitAttachment::class);
    }
    /**
     * Get the KitOperation for the user.
     */
    public function kit_operations()
    {
        return $this->hasMany(KitOperation::class);
    }
}

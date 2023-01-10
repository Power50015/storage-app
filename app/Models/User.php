<?php

namespace App\Models;

use App\Models\Cash\Cash;
use App\Models\Debtor\Debtor;
use App\Models\Debtor\DebtorAttachment;
use App\Models\Debtor\DebtorPay;
use App\Models\Debtor\DebtorPayAttachment;
use App\Models\Driver\Driver;
use App\Models\Expense\ExpenseAttachment;
use App\Models\Expense\ExpenseImage;
use App\Models\Expense\ExpenseNote;
use App\Models\IncomingInvoice\IncomingInvoice;
use App\Models\IncomingInvoice\IncomingInvoiceAttachment;
use App\Models\IncomingInvoice\IncomingInvoiceContent;
use App\Models\IncomingInvoice\IncomingInvoiceImage;
use App\Models\IncomingInvoice\IncomingInvoiceKit;
use App\Models\IncomingInvoice\IncomingInvoiceNote;
use App\Models\Kit\Kit;
use App\Models\Kit\KitAttachment;
use App\Models\Kit\KitImage;
use App\Models\Kit\KitNote;
use App\Models\Kit\KitOperation;
use App\Models\OutgoingInvoice\OutgoingInvoice;
use App\Models\OutgoingInvoice\OutgoingInvoiceAttachment;
use App\Models\OutgoingInvoice\OutgoingInvoiceContent;
use App\Models\OutgoingInvoice\OutgoingInvoiceImage;
use App\Models\People\People;
use App\Models\People\PeopleAttachment;
use App\Models\People\PeopleImage;
use App\Models\People\PeopleNote;
use App\Models\Product\DestructibleGoods;
use App\Models\Product\DestructibleGoodsAction;
use App\Models\Product\Product;
use App\Models\Product\ProductAttachment;
use App\Models\Product\ProductBrand;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductCollection;
use App\Models\Product\ProductColor;
use App\Models\Product\ProductCountry;
use App\Models\Product\ProductImage;
use App\Models\Product\ProductMaterial;
use App\Models\Product\ProductModel;
use App\Models\Product\ProductNote;
use App\Models\Product\ProductType;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoice;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoiceAttachment;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoiceContent;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoiceImage;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoiceKit;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoiceNote;
use App\Models\Transfer\Transfer;
use App\Models\Transfer\TransferAttachment;
use App\Models\Transfer\TransferContent;
use App\Models\Transfer\TransferKit;
use App\Models\Warehouse\Warehouse;
use App\Models\Warehouse\WarehouseAttachment;
use App\Models\Warehouse\WarehouseImage;
use App\Models\Warehouse\WarehouseNote;
use App\Models\Warehouse\WarehouseStock;
use App\Models\Warehouse\WarehouseStockAttachment;
use App\Models\Warehouse\WarehouseStockContent;
use App\Models\Warehouse\WarehouseStockImage;
use App\Models\Warehouse\WarehouseStockNote;
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
     * Get the IncomingInvoiceNote for the user.
     */
    public function incoming_invoice_notes()
    {
        return $this->hasMany(IncomingInvoiceNote::class);
    }
    /**
     * Get the IncomingInvoiceImage for the user.
     */
    public function incoming_invoice_images()
    {
        return $this->hasMany(IncomingInvoiceImage::class);
    }
    /**
     * Get the IncomingInvoiceContent for the user.
     */
    public function incoming_invoice_contents()
    {
        return $this->hasMany(IncomingInvoiceContent::class);
    }
    /**
     * Get the ReturnedIncomingInvoice for the user.
     */
    public function returned_incoming_invoices()
    {
        return $this->hasMany(ReturnedIncomingInvoice::class);
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
     * Get the OutgoingInvoiceImage for the user.
     */
    public function outgoing_invoice_images()
    {
        return $this->hasMany(OutgoingInvoiceImage::class);
    }
    /**
     * Get the OutgoingInvoiceNote for the user.
     */
    public function outgoing_invoice_notes()
    {
        return $this->hasMany(OutgoingInvoiceNote::class);
    }
    /**
     * Get the OutgoingInvoiceContent for the user.
     */
    public function outgoing_invoice_contents()
    {
        return $this->hasMany(OutgoingInvoiceContent::class);
    }
    /**
     * Get the ReturnedOutgoingInvoice for the user.
     */
    public function returned_outgoing_invoices()
    {
        return $this->hasMany(ReturnedOutgoingInvoice::class);
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
     * Get the Warehouse for the user.
     */
    public function warehouses()
    {
        return $this->hasMany(Warehouse::class);
    }
    /**
     * Get the Warehouse for the user.
     */
    public function warehouse_notes()
    {
        return $this->hasMany(WarehouseNote::class);
    }
    /**
     * Get the Warehouse for the user.
     */
    public function warehouse_images()
    {
        return $this->hasMany(WarehouseImage::class);
    }
    /**
     * Get the Warehouse for the user.
     */
    public function warehouse_attachments()
    {
        return $this->hasMany(WarehouseAttachment::class);
    }
    /**
     * Get the WarehouseStock for the user.
     */
    public function warehouse_stocks()
    {
        return $this->hasMany(WarehouseStock::class);
    }
    /**
     * Get the Debtor for the DebtorAttachment.
     */
    public function warehouse_stock_images()
    {
        return $this->hasMany(WarehouseStockImage::class);
    }

    /**
     * Get the Debtor for the DebtorAttachment.
     */
    public function warehouse_stock_notes()
    {
        return $this->hasMany(WarehouseStockNote::class);
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
    /**
     * Get the KitImage for the user.
     */
    public function kit_images()
    {
        return $this->hasMany(KitImage::class);
    }
    /**
     * Get the KitNote for the user.
     */
    public function kit_notes()
    {
        return $this->hasMany(KitNote::class);
    }
    /**
     * Get the Drivers for the user.
     */
    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }

    /**
     * Get the Transfers for the user.
     */
    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }
    /**
     * Get the TransferContent for the user.
     */
    public function transfer_contents()
    {
        return $this->hasMany(TransferContent::class);
    }
    /**
     * Get the TransferAttachment for the user.
     */
    public function transfer_attachments()
    {
        return $this->hasMany(TransferAttachment::class);
    }
    /**
     * Get the Transfer To for the Transfer Kit.
     */
    public function transfer_kits()
    {
        return $this->hasMany(TransferKit::class);
    }
    /**
     * Get the Transfer To for the Transfer Note.
     */
    public function transfer_notes()
    {
        return $this->hasMany(TransferNote::class);
    }
    /**
     * Get the Transfer To for the Transfer Note.
     */
    public function transfer_images()
    {
        return $this->hasMany(TransferImage::class);
    }
    /**
     * Get the IncomingInvoiceKit for the IncomingInvoice.
     */
    public function incoming_invoice_kits()
    {
        return $this->hasMany(IncomingInvoiceKit::class);
    }
    /**
     * Get the ReturnedIncomingInvoiceKit for the user.
     */
    public function returned_incoming_invoice_kits()
    {
        return $this->hasMany(ReturnedIncomingInvoiceKit::class);
    }
    /**
     * Get the ReturnedIncomingInvoiceContent for the user.
     */
    public function returned_incoming_invoice_contents()
    {
        return $this->hasMany(ReturnedIncomingInvoiceContent::class);
    }
    /**
     * Get the ReturnedIncomingInvoiceAttachment for the user.
     */
    public function returned_incoming_invoice_attachments()
    {
        return $this->hasMany(ReturnedIncomingInvoiceAttachment::class);
    }
    /**
     * Get the ReturnedIncomingInvoiceNote for the user.
     */
    public function returned_incoming_invoice_notes()
    {
        return $this->hasMany(ReturnedIncomingInvoiceNote::class);
    }
    /**
     * Get the ReturnedIncomingInvoiceImage for the user.
     */
    public function returned_incoming_invoice_images()
    {
        return $this->hasMany(ReturnedIncomingInvoiceImage::class);
    }

    /**
     * Get the ReturnedIncomingInvoiceKit for the user.
     */
    public function returned_outgoing_invoice_kits()
    {
        return $this->hasMany(ReturnedOutgoingInvoiceKit::class);
    }
    /**
     * Get the DestructibleGoods for the user.
     */
    public function destructible_goods()
    {
        return $this->hasMany(DestructibleGoods::class);
    }
    public function destructible_goods_action()
    {
        return $this->hasMany(DestructibleGoodsAction::class);
    }
    /**
     * Get the Debtor for the DebtorAttachment.
     */
    public function people_notes()
    {
        return $this->hasMany(PeopleNote::class);
    }
    /**
     * Get the Debtor for the PeopleImage.
     */
    public function people_images()
    {
        return $this->hasMany(PeopleImage::class);
    }
    /**
     * Get the Debtor for the PeopleAttachment.
     */
    public function people_attachments()
    {
        return $this->hasMany(PeopleAttachment::class);
    }

    /**
     * Get the users for the ExpenseNote.
     */
    public function expense_notes()
    {
        return $this->hasMany(ExpenseNote::class);
    }
    /**
     * Get the users for the ExpenseImage.
     */
    public function expense_images()
    {
        return $this->hasMany(ExpenseImage::class);
    }
    /**
     * Get the users for the ExpenseAttachment.
     */
    public function expense_attachments()
    {
        return $this->hasMany(ExpenseAttachment::class);
    }
}

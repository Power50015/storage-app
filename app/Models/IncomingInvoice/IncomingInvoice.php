<?php

namespace App\Models\IncomingInvoice;

use App\Models\Cash\Cash;
use App\Models\People\People;

use App\Models\User;
use App\Models\Warehouse\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingInvoice extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['total_before_discount', 'total_after_discount', 'total_before_discount_and_returned', 'total_after_discount_befoure_returned'];

    /**
     * Get the users for the IncomingInvoice.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the People for the IncomingInvoice.
     */
    public function people()
    {
        return $this->belongsTo(People::class);
    }
    /**
     * Get the cash for the IncomingInvoice.
     */
    public function cash()
    {
        return $this->belongsTo(Cash::class);
    }
    /**
     * Get the warehouses for the IncomingInvoice.
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Get the IncomingInvoiceAttachment for the IncomingInvoice.
     */
    public function incoming_invoice_attachments()
    {
        return $this->hasMany(IncomingInvoiceAttachment::class);
    }

    /**
     * Get the IncomingInvoiceContent for the IncomingInvoice.
     */
    public function incoming_invoice_contents()
    {
        return $this->hasMany(IncomingInvoiceContent::class);
    }
    /**
     * Get the IncomingInvoiceKit for the IncomingInvoice.
     */
    public function incoming_invoice_kits()
    {
        return $this->hasMany(IncomingInvoiceKit::class);
    }

    /**
     * Get the ReturnedIncomingInvoice for the IncomingInvoice.
     */
    public function returned_incoming_invoices()
    {
        return $this->hasMany(ReturnedIncomingInvoice::class);
    }
    /**
     * Get the ReturnedIncomingInvoiceKit for the user.
     */
    public function returned_incoming_invoice_kits()
    {
        return $this->hasMany(ReturnedIncomingInvoiceKit::class);
    }
    /**
     * Get The Total Before Discount
     **/
    public function getTotalBeforeDiscountAttribute()
    {
        return 0;
        $items = IncomingInvoiceContent::where('incoming_invoice_id', $this->id)->get();
        $rItem = ReturnedIncomingInvoice::where('incoming_invoice_id', $this->id)->get();
        $kits = IncomingInvoiceKit::where('incoming_invoice_id', $this->id)->get();
        $rkits = ReturnedIncomingInvoiceKit::where('incoming_invoice_id', $this->id)->get();
        $total = 0;
        foreach ($items as $key => $value) {
            $quantity = 0;
            foreach ($rItem as $key2 => $value2) {
                if ($value["product_id"] == $value2["product_id"])
                    $quantity = $value2["quantity"];
            }
            $total += ($value["price"] * ($value["quantity"] - $quantity));
        }

        foreach ($kits as $key => $value) {
            $quantity = 0;
            foreach ($rkits as $key2 => $value2) {
                if ($value["kit_id"] == $value2["kit_id"])
                    $quantity = $value2["quantity"];
            }
            $total += ($value["price"] * ($value["quantity"] - $quantity));
        }
        return floatval($total);
    }
    /**
     * Get The Total After Discount
     **/
    public function getTotalAfterDiscountAttribute()
    {
        return 0;
        $items = IncomingInvoiceContent::where('incoming_invoice_id', $this->id)->get();
        $rItem = ReturnedIncomingInvoice::where('incoming_invoice_id', $this->id)->get();
        $kits = IncomingInvoiceKit::where('incoming_invoice_id', $this->id)->get();
        $rkits = ReturnedIncomingInvoiceKit::where('incoming_invoice_id', $this->id)->get();
        $total = 0;
        foreach ($items as $key => $value) {
            $quantity = 0;
            foreach ($rItem as $key2 => $value2) {
                if ($value["product_id"] == $value2["product_id"])
                    $quantity = $value2["quantity"];
            }
            $total += ($value["price"] * ($value["quantity"] - $quantity));
        }

        foreach ($kits as $key => $value) {
            $quantity = 0;
            foreach ($rkits as $key2 => $value2) {
                if ($value["kit_id"] == $value2["kit_id"])
                    $quantity = $value2["quantity"];
            }
            $total += ($value["price"] * ($value["quantity"] - $quantity));
        }
        return floatval($total - $this->discount);
    }
    /**
     * Get The Total Before Discount And Returned 
     **/
    public function getTotalBeforeDiscountAndReturnedAttribute()
    {
        return 0;
        $items = IncomingInvoiceContent::where('incoming_invoice_id', $this->id)->get();
        $kits = IncomingInvoiceKit::where('incoming_invoice_id', $this->id)->get();
        $total = 0;
        foreach ($items as $key => $value) {
            $quantity = 0;
            $total += ($value["price"] * ($value["quantity"] - $quantity));
        }

        foreach ($kits as $key => $value) {
            $quantity = 0;
            $total += ($value["price"] * ($value["quantity"] - $quantity));
        }
        return floatval($total);
    }
    /**
     * Get The Total After Discount Befour Returned
     **/
    public function getTotalAfterDiscountBefoureReturnedAttribute()
    {
        return 0;
        $items = IncomingInvoiceContent::where('incoming_invoice_id', $this->id)->get();
        $kits = IncomingInvoiceKit::where('incoming_invoice_id', $this->id)->get();
        $total = 0;
        foreach ($items as $key => $value) {
            $quantity = 0;
            $total += ($value["price"] * ($value["quantity"] - $quantity));
        }

        foreach ($kits as $key => $value) {
            $quantity = 0;
            $total += ($value["price"] * ($value["quantity"] - $quantity));
        }
        return floatval($total - $this->discount);
    }
}

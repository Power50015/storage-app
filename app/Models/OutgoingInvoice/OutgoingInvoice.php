<?php

namespace App\Models\OutgoingInvoice;

use App\Models\Cash\Cash;
use App\Models\People\People;
use App\Models\User;
use App\Models\Warehouse\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingInvoice extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['total_before_discount', 'total_after_discount'];

    /**
     * Get the users for the OutgoingInvoice.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the People for the OutgoingInvoice.
     */
    public function people()
    {
        return $this->belongsTo(People::class);
    }
    /**
     * Get the cash for the OutgoingInvoice.
     */
    public function cash()
    {
        return $this->belongsTo(Cash::class);
    }
    /**
     * Get the warehouses for the OutgoingInvoice.
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    /** 
     * Get the OutgoingInvoiceAttachment for the OutgoingInvoice.
     */
    public function outgoing_invoice_attachments()
    {
        return $this->hasMany(OutgoingInvoiceAttachment::class);
    }

    /**
     * Get the OutgoingInvoiceContent for the OutgoingInvoice.
     */
    public function outgoing_invoice_contents()
    {
        return $this->hasMany(OutgoingInvoiceContent::class);
    }
    /**
     * Get the ReturnedOutgoingInvoice for the IncomingInvoice.
     */
    public function returned_outgoing_invoices()
    {
        return $this->hasMany(ReturnedOutgoingInvoice::class);
    }
    /**
     * Get the ReturnedIncomingInvoiceKit for the user.
     */
    public function returned_outgoing_invoice_kits()
    {
        return $this->hasMany(ReturnedOutgoingInvoiceKit::class);
    }
    /**
     * Get The Total Before Discount
     **/
    public function getTotalBeforeDiscountAttribute()
    {
        // $items = OutgoingInvoiceContent::where('outgoing_invoice_id', $this->id)->get();
        // $rItem = ReturnedOutgoingInvoice::where('outgoing_invoice_id', $this->id)->get();
        // $total = 0;
        // foreach ($items as $key => $value) {
        //     $quantity = 0;
        //     foreach ($rItem as $key2 => $value2) {
        //         if ($value["product_id"] == $value2["product_id"])
        //             $quantity = $value2["quantity"];
        //     }
        //     $total += ($value["price"] * ($value["quantity"] - $quantity));
        // }
        // return floatval($total);

        $totalOutgoingInvoice = OutgoingInvoiceContent::query()->where('outgoing_invoice_id', $this->id)->get()->sum(function ($query) {
            return ($query->price * ($query->quantity - ReturnedOutgoingInvoice::where('outgoing_invoice_id', $this->id)->where('product_id', $query->product_id)->sum('quantity')));
        }) + OutgoingInvoiceKit::query()->where('outgoing_invoice_id', $this->id)->get()->sum(function ($query) {
            return ($query->price * ($query->quantity - ReturnedOutgoingInvoiceKit::where('outgoing_invoice_id', $this->id)->where('kit_id', $query->kit_id)->sum('quantity')));
        });
        return floatval($totalOutgoingInvoice);
    }
    /**
     * Get The Total After Discount
     **/
    public function getTotalAfterDiscountAttribute()
    {
        // $items = OutgoingInvoiceContent::where('outgoing_invoice_id', $this->id)->get();
        // $rItem = ReturnedOutgoingInvoice::where('outgoing_invoice_id', $this->id)->get();
        // $total = 0;
        // foreach ($items as $key => $value) {
        //     $quantity = 0;
        //     foreach ($rItem as $key2 => $value2) {
        //         if ($value["product_id"] == $value2["product_id"])
        //             $quantity = $value2["quantity"];
        //     }
        //     $total += ($value["price"] * ($value["quantity"] - $quantity));
        // }
        // return floatval($total - $this->discount);

        $totalOutgoingInvoice = OutgoingInvoiceContent::query()->where('outgoing_invoice_id', $this->id)->get()->sum(function ($query) {
            return ($query->price * ($query->quantity - ReturnedOutgoingInvoice::where('outgoing_invoice_id', $this->id)->where('product_id', $query->product_id)->sum('quantity')));
        }) + OutgoingInvoiceKit::query()->where('outgoing_invoice_id', $this->id)->get()->sum(function ($query) {
            return ($query->price * ($query->quantity - ReturnedOutgoingInvoiceKit::where('outgoing_invoice_id', $this->id)->where('kit_id', $query->kit_id)->sum('quantity')));
        });
        return floatval($totalOutgoingInvoice - $this->discount);
    }
}

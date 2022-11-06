<?php

namespace App\Models\People;

use App\Models\Creditor\Creditor;
use App\Models\Creditor\CreditorPay;
use App\Models\Debtor\Debtor;
use App\Models\Debtor\DebtorPay;
use App\Models\IncomingInvoice\IncomingInvoice;
use App\Models\IncomingInvoice\IncomingInvoiceContent;
use App\Models\IncomingInvoice\IncomingInvoiceKit;
use App\Models\IncomingInvoice\ReturnedIncomingInvoice;
use App\Models\IncomingInvoice\ReturnedIncomingInvoiceKit;
use App\Models\OutgoingInvoice\OutgoingInvoice;
use App\Models\OutgoingInvoice\OutgoingInvoiceContent;
use App\Models\OutgoingInvoice\OutgoingInvoiceKit;
use App\Models\OutgoingInvoice\ReturnedOutgoingInvoice;
use App\Models\OutgoingInvoice\ReturnedOutgoingInvoiceKit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['total_credit'];

    /**
     * Get the users for the People.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the IncomingInvoice for the user.
     */
    public function incoming_invoices()
    {
        return $this->hasMany(IncomingInvoice::class);
    }
    /**
     * Get the IncomingInvoiceContent for the user.
     */
    public function incoming_invoice_contents()
    {
        return $this->hasMany(IncomingInvoiceContent::class);
    }
    /**
     * Get the IncomingInvoiceKit for the user.
     */
    public function incoming_invoice_kits()
    {
        return $this->hasMany(IncomingInvoiceKit::class);
    }

    /**
     * Get the ReturnedIncomingInvoice for the user.
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
     * Get the OutgoingInvoice for the user.
     */
    public function outgoing_invoices()
    {
        return $this->hasMany(OutgoingInvoice::class);
    }
    /**
     * Get the OutgoingInvoiceContent for the user.
     */
    public function outgoing_invoice_contents()
    {
        return $this->hasMany(OutgoingInvoiceContent::class);
    }
    /**
     * Get the OutgoingInvoiceKit for the user.
     */
    public function outgoing_invoice_kits()
    {
        return $this->hasMany(OutgoingInvoiceKit::class);
    }

    /**
     * Get the ReturnedOutgoingInvoice for the user.
     */
    public function returned_outgoing_invoices()
    {
        return $this->hasMany(ReturnedOutgoingInvoice::class);
    }

    /**
     * Get the ReturnedOutgoingInvoiceKit for the user.
     */
    public function returned_outgoing_invoice_kits()
    {
        return $this->hasMany(ReturnedOutgoingInvoiceKit::class);
    }

    /**
     * Get the Debtor for the DebtorAttachment.
     */
    public function debtors()
    {
        return $this->hasMany(Debtor::class);
    }

    /**
     * Get the Debtor for the DebtorPayAttachment.
     */
    public function debtor_pays()
    {
        return $this->hasMany(DebtorPay::class);
    }
    /**
     * Get the totla Credit.
     */
    public function getTotalCreditAttribute()
    {
        $credit = 0;
        $credit -= IncomingInvoice::where('pay_type', 0)->where('people_id', $this->id)->sum('total');
        $credit += OutgoingInvoice::where('pay_type', 0)->where('people_id', $this->id)->sum('total');
        $credit += Debtor::where('people_id', $this->id)->sum('amount');
        $credit -= DebtorPay::where('people_id', $this->id)->sum('amount');
        $credit -= Creditor::where('people_id', $this->id)->sum('amount');
        $credit += CreditorPay::where('people_id', $this->id)->sum('amount');
        return  $credit;

    }
}

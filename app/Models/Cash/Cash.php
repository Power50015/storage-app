<?php

namespace App\Models\Cash;

use App\Models\Creditor\Creditor;
use App\Models\Creditor\CreditorPay;
use App\Models\Debtor\Debtor;
use App\Models\Debtor\DebtorPay;
use App\Models\Expense\Expense;
use App\Models\IncomingInvoice\IncomingInvoice;
use App\Models\OutgoingInvoice\OutgoingInvoice;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoice;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoice;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the users for the Cashs.
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the IncomingInvoice for the Cashs.
     */
    public function incoming_invoices()
    {
        return $this->hasMany(IncomingInvoice::class);
    }

    /**
     * Get the OutgoingInvoice for the Cashs.
     */
    public function outgoing_invoices()
    {
        return $this->hasMany(OutgoingInvoice::class);
    }
    /**
     * Get the Debtor for the Cashs.
     */
    public function debtors()
    {
        return $this->hasMany(Debtor::class);
    }
    /**
     * Get the Debtor for the Cashs.
     */
    public function debtor_pays()
    {
        return $this->hasMany(DebtorPay::class);
    }
    /**
     * Get the Creditor for the Cashs.
     */
    public function creditors()
    {
        return $this->hasMany(Creditor::class);
    }
    /**
     * Get the Creditor for the Cashs.
     */
    public function creditor_pays()
    {
        return $this->hasMany(CreditorPay::class);
    }

    /**
     * Get the Expense for the Cashs.
     */
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
    /**
     * Get the ReturnedIncomingInvoice for the user.
     */
    public function returned_incoming_invoices()
    {
        return $this->hasMany(ReturnedIncomingInvoice::class);
    }

    /**
     * Get the ReturnedOutgoingInvoice for the user.
     */
    public function returned_outgoing_invoices()
    {
        return $this->hasMany(ReturnedOutgoingInvoice::class);
    }

    /**
     * Get the CashAttachment for the Cash.
     */
    public function cash_attachments()
    {
        return $this->hasMany(CashAttachment::class);
    }
    /**
     * Get the CashImage for the Cash.
     */
    public function cash_images()
    {
        return $this->hasMany(CashImage::class);
    }
    /**
     * Get the CashNote for the Cash.
     */
    public function cash_notes()
    {
        return $this->hasMany(CashNote::class);
    }
    /**
     * Get the CashPay for the Cash.
     */
    public function cash_pays()
    {
        return $this->hasMany(CashPay::class);
    }
}

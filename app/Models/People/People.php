<?php

namespace App\Models\People;

use App\Models\Creditor\Creditor;
use App\Models\Creditor\CreditorPay;
use App\Models\Debtor\Debtor;
use App\Models\Debtor\DebtorPay;
use App\Models\IncomingInvoice\IncomingInvoice;
use App\Models\IncomingInvoice\IncomingInvoiceContent;
use App\Models\IncomingInvoice\IncomingInvoiceKit;
use App\Models\OutgoingInvoice\OutgoingInvoice;
use App\Models\OutgoingInvoice\OutgoingInvoiceContent;
use App\Models\OutgoingInvoice\OutgoingInvoiceKit;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoice;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoiceContent;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoiceKit;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoice;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoiceContent;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoiceKit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    protected $guarded = [];

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
     * Get the ReturnedIncomingInvoiceContent for the user.
     */
    public function returned_incoming_invoice_contents()
    {
        return $this->hasMany(ReturnedIncomingInvoiceContent::class);
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
     * Get the ReturnedOutgoingInvoiceContent for the user.
     */
    public function returned_outgoing_invoice_contents()
    {
        return $this->hasMany(ReturnedOutgoingInvoiceContent::class);
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
     * Get the Debtor for the DebtorAttachment.
     */
    public function people_notes()
    {
        return $this->hasMany(PeopleNote::class);
    }
    /**
     * Get the Debtor for the DebtorAttachment.
     */
    public function people_images()
    {
        return $this->hasMany(PeopleImage::class);
    }
    /**
     * Get the Debtor for the DebtorAttachment.
     */
    public function people_attachments()
    {
        return $this->hasMany(PeopleAttachment::class);
    }
}

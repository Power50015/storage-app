<?php

namespace App\Models\Cash;

use App\Models\Debtor\Debtor;
use App\Models\Debtor\DebtorPay;
use App\Models\IncomingInvoice\IncomingInvoice;
use App\Models\OutgoingInvoice\OutgoingInvoice;
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
}

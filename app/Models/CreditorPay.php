<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditorPay extends Model
{
    use HasFactory;
    /**
     * Get the users for the Debtor.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the CreditorPayAttachment for the Creditor.
     */
    public function creditor_pay_attachments()
    {
        return $this->hasMany(CreditorPayAttachment::class);
    }
}

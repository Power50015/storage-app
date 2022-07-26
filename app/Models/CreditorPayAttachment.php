<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditorPayAttachment extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the users for the CreditorPayAttachment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the CreditorPay for the CreditorPayAttachment.
     */
    public function creditor_pay()
    {
        return $this->belongsTo(CreditorPay::class);
    }
}

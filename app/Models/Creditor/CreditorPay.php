<?php

namespace App\Models\Creditor;

use App\Models\Cash\Cash;
use App\Models\People\People;
use App\Models\User;
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
     /**
     * Get the CreditorImage for the Creditor.
     */
    public function creditor_pay_images()
    {
        return $this->hasMany(CreditorPayImage::class);
    }
    /**
     * Get the CreditorImage for the Creditor.
     */
    public function creditor_pay_notes()
    {
        return $this->hasMany(CreditorPayNote::class);
    }
    /**
     * Get the People for the IncomingInvoice.
     */
    public function people()
    {
        return $this->belongsTo(People::class);
    }
    /**
     * Get the Cash for the Debtor.
     */
    public function cash()
    {
        return $this->belongsTo(Cash::class);
    }
}

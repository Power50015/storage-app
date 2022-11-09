<?php

namespace App\Models\Creditor;

use App\Models\Cash\Cash;
use App\Models\People\People;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creditor extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the users for the Creditor.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the CreditorAttachment for the Creditor.
     */
    public function creditor_attachments()
    {
        return $this->hasMany(CreditorAttachment::class);
    }
    /**
     * Get the CreditorImage for the Creditor.
     */
    public function creditor_images()
    {
        return $this->hasMany(CreditorImage::class);
    }
    /**
     * Get the CreditorImage for the Creditor.
     */
    public function creditor_notes()
    {
        return $this->hasMany(CreditorNote::class);
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

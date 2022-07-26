<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditorAttachment extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the users for the DebtorAttachment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the Creditor for the CreditorAttachment.
     */
    public function creditor()
    {
        return $this->belongsTo(Creditor::class);
    }
}

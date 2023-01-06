<?php

namespace App\Models\Transfer;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferImage extends Model
{
    use HasFactory;
    protected $guarded = [];
     /**
     * Get the users for the IncomingInvoiceContent.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the outgoing invoice for the IncomingInvoiceContent.
     */
    public function transfer()
    {
        return $this->belongsTo(Transfer::class);
    }
}

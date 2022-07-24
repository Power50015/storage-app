<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebtorPayAttachment extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the users for the DebtorPayAttachment.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user');
    }

    /**
     * Get the Debtor for the DebtorPayAttachment.
     */
    public function debtor_pay()
    {
        return $this->belongsTo(DebtorPay::class, 'debtor');
    }
}

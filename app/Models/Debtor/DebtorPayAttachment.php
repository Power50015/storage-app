<?php

namespace App\Models\Debtor;

use App\Models\User;
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
        return $this->belongsTo(User::class);
    }

    /**
     * Get the Debtor for the DebtorPayAttachment.
     */
    public function debtor_pay()
    {
        return $this->belongsTo(DebtorPay::class);
    }
}
